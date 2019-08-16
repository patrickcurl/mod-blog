<?php

namespace Modules\Blog\Actions\Posts;

use Illuminate\View\View;
use Lorisleiva\Actions\Action;
use Modules\Blog\Models\Post;
use Modules\Blog\Models\Tag;
use Modules\Blog\Models\Topic;

class Index extends Action
{
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
    public function handle() : View
    {
        $data = [
            'posts'  => Post::published()->orderByDesc('published_at')->simplePaginate(10),
            'topics' => Topic::all(['name', 'slug']),
            'tags'   => Tag::all(['name', 'slug']),
        ];

        return view('blog.index', compact('data'));
    }
}
