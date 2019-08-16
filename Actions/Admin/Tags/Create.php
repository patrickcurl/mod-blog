<?php

namespace Modules\Blog\Actions\Admin\Tags;

use Lorisleiva\Actions\Action;
use Modules\Blog\Models\Tag;

class Create extends Action
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
    public function handle()
    {
        $tag_id = Uuid::uuid4();

        return view('blog::admin.tags.create', compact('tag_id'));
    }
}
