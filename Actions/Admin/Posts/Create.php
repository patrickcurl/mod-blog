<?php

namespace Modules\Blog\Actions\Admin\Posts;

use Lorisleiva\Actions\Action;
use Modules\Blog\Models\Tag;
use Modules\Blog\Models\Topic;

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
        $data = [
            'id'     => Uuid::uuid4(),
            'tags'   => Tag::all(['name', 'slug']),
            'topics' => Topic::all(['name', 'slug']),
        ];

        return view('blog::admin.posts.create', compact('data'));
    }
}
