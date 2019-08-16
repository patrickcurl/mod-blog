<?php

namespace Modules\Blog\Actions\Admin\Topics;

use Lorisleiva\Actions\Action;
use Modules\Blog\Models\Topic;

class Store extends Action
{
    use \Modules\Blog\Traits\Validations\ValidatesTopics;

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
        $data  = $this->validateData();
        $topic = new Topic(['id' => request('id')]);
        $topic->fill($data);
        $topic->save();

        return redirect(route('blog.admin.topic.edit', $topic->id))->with('notify', __('blog::nav.notify.success'));
    }
}
