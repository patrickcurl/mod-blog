<?php

namespace Modules\Blog\Actions\Admin\Topics;

use Lorisleiva\Actions\Action;
use Modules\Blog\Models\Topic;

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
    public function handle(Topic $topic)
    {
        $topic->delete();

        return redirect(route('blog.admin.topic.index'));
    }
}
