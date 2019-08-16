<?php

namespace Modules\Blog\Actions\Posts;

use Illuminate\View\View;
use Lorisleiva\Actions\Action;
use Modules\Blog\Events\PostViewed;
use Modules\Blog\Models\Post;
use Modules\Blog\Models\Tag;
use Modules\Blog\Models\Topic;

class Topics extends Action
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
     * Show all posts given a topic.
     *
     * @param string $slug
     * @return View
     */
    public function handle(string $slug) : View
    {
        if (Topic::where('slug', $slug)->first()) {
            $data = [
                'tags'   => Tag::all(['name', 'slug']),
                'topics' => Topic::all(['name', 'slug']),
                'topic'  => Topic::with('posts')->where('slug', $slug)->first(),
                'posts'  => Post::whereHas('topic', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })->published()->orderByDesc('published_at')->simplePaginate(10),
            ];

            return view('blog.index', compact('data'));
        } else {
            abort(404);
        }
    }
}
