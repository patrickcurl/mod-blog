<?php

namespace Modules\Blog\Actions\Admin\Stats;

use Lorisleiva\Actions\Action;
use Modules\Blog\Models\Post;
use Modules\Blog\Models\View;

class Index extends Action
{
    use \Modules\Blog\Traits\Trends;

    /**
     * Determine if the user is authorized to make this action.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the action.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Execute the action and return a result.
     *
     * @return mixed
     */
    public function handle()
    {
        $published = Post::select('id', 'title', 'body', 'published_at', 'created_at')
            ->published()
            ->orderByDesc('created_at')
            ->withCount('views')
            ->get();

        // Append the estimated reading time
        $published->each->append('read_time');

        // Get views for the last [X] days
        $views = View::whereBetween('created_at', [
            now()->subDays(self::$days_prior)->toDateTimeString(),
            now()->toDateTimeString(),
        ])->select('created_at')->get();

        $data = [
            'posts' => [
                'all'             => $published,
                'published_count' => $published->count(),
                'drafts_count'    => Post::draft()->count(),
            ],
            'views' => [
                'count' => $views->count(),
                'trend' => json_encode($this->getViewTrends($views, self::$days_prior)),
            ],
        ];

        return view('blog::admin.stats.index', compact('data'));
    }
}
