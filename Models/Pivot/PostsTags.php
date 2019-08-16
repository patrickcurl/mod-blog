<?php

namespace Module\Blog\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PostsTags extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_posts_tags';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
