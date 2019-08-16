<?php

namespace Modules\Blog\Actions\Admin\Tags;

use Lorisleiva\Actions\Action;
use Modules\Blog\Models\Tag;

class Update extends Action
{
    use \Modules\Blog\Traits\Validations\ValidatesTags;

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
    public function handle(Tag $tag)
    {
        $data  = $this->validateData();
        $tag->fill($data);
        $tag->save();

        return redirect(route('blog.admin.tag.edit', $tag->id))->with('notify', __('blog::nav.notify.success'));
    }
}
