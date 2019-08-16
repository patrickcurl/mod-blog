<?php

namespace Modules\Blog\Actions\Admin\Posts;

use Lorisleiva\Actions\Action;

use Modules\Blog\Models\Post;

class Store extends Action
{
    use \Modules\Blog\Traits\AttachesTagsOrTopics;
    use \Modules\Blog\Traits\Validations\ValidatesPosts;

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
    public function handle()
    {
        $data = $this->validateData();
        $post = new Post(['id' => request('id')]);
        $post->fill($data);
        $post->save();

        $post->tags()->sync(
            $this->attachOrCreateTags(request('tags') ?? [])
        );

        $post->topic()->sync(
            $this->attachOrCreateTopic(request('topic') ?? [])
        );

        return redirect(route('blog.admin.post.edit', $post->id))->with('notify', __('blog::nav.notify.success'));
    }
}
