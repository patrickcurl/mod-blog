<?php

namespace Modules\Blog\Tests\Listeners;

use Modules\Blog\Listeners\StoreViewData;
use Modules\Blog\Models\Post;
use Modules\Blog\Tests\TestCase;
use Ramsey\Uuid\Uuid;

class StoreViewDataTest extends TestCase
{
    /**
     * The listener instance.
     *
     * @var StoreViewData
     */
    protected $instance;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->instance = new StoreViewData();
    }

    /** @test */
    public function check_if_a_post_was_recently_viewed()
    {
        $post = Post::create([
            'id'      => Uuid::uuid4()->toString(),
            'title'   => 'Example Post',
            'slug'    => 'example-slug',
            'user_id' => 1,
        ]);

        $key = 'viewed_posts.'.$post->id;

        session()->put($key, time());

        $response = $this->invokeMethod($this->instance, 'wasRecentlyViewed', ['post' => $post]);

        $this->assertTrue($response);
        $this->assertArrayHasKey($post->id, session()->get('viewed_posts'));

        session()->flush();

        $response = $this->invokeMethod($this->instance, 'wasRecentlyViewed', ['post' => $post]);

        $this->assertFalse($response);
    }

    /** @test */
    public function store_a_post_id_in_session()
    {
        $post = Post::create([
            'id'      => Uuid::uuid4()->toString(),
            'title'   => 'Example Post',
            'slug'    => 'example-slug',
            'user_id' => 1,
        ]);

        $this->invokeMethod($this->instance, 'storeInSession', ['post' => $post]);

        $this->assertArrayHasKey($post->id, session()->get('viewed_posts'));
    }
}
