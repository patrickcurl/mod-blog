<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\PostViewed;
use Modules\Blog\Models\Post;

class StoreViewData
{
    /**
     * Handle the event.
     *
     * @param PostViewed $event
     * @return void
     */
    public function handle(PostViewed $event)
    {
        if (! $this->wasRecentlyViewed($event->post)) {
            $view_data = [
                'post_id' => $event->post->id,
                'ip'      => request()->getClientIp(),
                'agent'   => request()->header('user_agent'),
                'referer' => request()->header('referer'),
            ];

            $event->post->views()->create($view_data);

            $this->storeInSession($event->post);
        }
    }

    /**
     * Check if a given post exists in the session.
     *
     * @param Post $post
     * @return bool
     */
    private function wasRecentlyViewed(Post $post): bool
    {
        $viewed = session()->get('viewed_posts', []);

        return array_key_exists($post->id, $viewed);
    }

    /**
     * Add a given post to the session.
     *
     * @param Post $post
     * @return void
     */
    private function storeInSession(Post $post)
    {
        session()->put("viewed_posts.{$post->id}", time());
    }
}
