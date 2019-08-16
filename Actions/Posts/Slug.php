<?php

namespace Modules\Blog\Actions\Posts;

use Illuminate\View\View;
use Lorisleiva\Actions\Action;
use Modules\Blog\Events\PostViewed;
use Modules\Blog\Models\Post;

class Slug extends Action
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
     * Show a post given a slug.
     *
     * @param string $slug
     * @return View
     */
    public function handle($slug) : View
    {
        $posts = Post::with('tags', 'topic')->published()->get();
        $post  = $posts->firstWhere('slug', $slug);

        if (optional($post)->published) {
            $next = $posts->sortBy('published_at')->firstWhere('published_at', '>', optional($post)->published_at);

            $filtered = $posts->filter(function ($value, $key) use ($slug, $next) {
                return $value->slug != $slug && $value->slug != optional($next)->slug;
            });

            if ($post->tags->isNotEmpty()) {
                $related = Post::where('id', '!=', $post->id)
                    ->where('id', '!=', optional($next)->id)
                    ->whereHas('tags', function ($query) use ($post, $next) {
                        return $query->whereIn('name', $post->tags->pluck('slug'));
                    })->get();

                if ($related->isEmpty()) {
                    $random = $filtered->count() > 1 ? $filtered->random() : null;
                } else {
                    $random = $related->random();
                }
            } else {
                if ($filtered->isNotEmpty()) {
                    $filtered->random();
                }
                $random = null;
            }

            $data = [
                'author' => $post->author,
                'post'   => $post,
                'meta'   => $post->meta,
                'next'   => $next,
                'random' => $random,
                'topic'  => $post->topic->first() ?? null,
            ];

            event(new PostViewed($post));

            return view('blog.show', compact('data'));
        } else {
            abort(404);
        }
    }
}
