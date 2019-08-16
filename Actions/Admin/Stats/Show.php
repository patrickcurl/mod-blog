<?php

namespace Modules\Blog\Actions\Admin\Stats;

use Lorisleiva\Actions\Action;
use Modules\Blog\Models\Post;

class Show extends Action
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
    public function handle(Post $post)
    {
        if ($post->published) {
            $data = [
                'post'                  => $post,
                'traffic'               => $post->top_referers,
                'popular_reading_times' => $post->popular_reading_times,
                'views'                 => json_encode($this->getViewTrends($post->views, self::$days_prior)),
            ];

            return view('blog::admin.stats.show', compact('data'));
        } else {
            abort(404);
        }
    }
}
