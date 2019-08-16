<?php

namespace Modules\Blog\Actions\Admin\Topics;

use Illuminate\View\View;
use Lorisleiva\Actions\Action;
use Modules\Blog\Models\Topic;

class Edit extends Action
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
    public function handle(Topic $topic) : View
    {
        return view('blog::admin.topics.edit', compact('topic'));
    }
}
