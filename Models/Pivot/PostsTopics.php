<?php

namespace Module\Blog\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostsTopics extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_posts_topics';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
