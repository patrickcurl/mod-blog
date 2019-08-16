<?php

namespace Modules\Blog\Actions\Posts;

use Illuminate\View\View;
use Lorisleiva\Actions\Action;
use Modules\Blog\Events\PostViewed;
use Modules\Blog\Models\Post;
use Modules\Blog\Models\Tag;
use Modules\Blog\Models\Topic;

class Tags extends Action
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
     * Show all posts given a tag.
     *
     * @param string $slug
     * @return View
     */
    public function handle($slug) : View
    {
        if (Tag::where('slug', $slug)->first()) {
            $data = [
                'tag'    => Tag::with('posts')->where('slug', $slug)->first(),
                'tags'   => Tag::all(['name', 'slug']),
                'topics' => Topic::all(['name', 'slug']),
                'posts'  => Post::whereHas('tags', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })->published()->orderByDesc('published_at')->simplePaginate(10),
            ];

            return view('blog.index', compact('data'));
        } else {
            abort(404);
        }
    }
}
