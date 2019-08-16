<?php

namespace Modules\Blog\Actions\Admin\Posts;

use Lorisleiva\Actions\Action;
use Modules\Blog\Models\Post;

class Destroy extends Action
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
    public function handle(Post $post)
    {
        $post->delete();

        return redirect(route('blog.admin.post.index'));
    }
}
