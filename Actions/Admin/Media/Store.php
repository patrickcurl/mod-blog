<?php

namespace Modules\Blog\Actions\Admin\Media;

use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Action;

class Store extends Action
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
        $path = request()->image->store(sprintf('%s/%s', config('modules.blog.storage_path'), 'images'), [
            'disk'       => config('modules.blog.storage_disk'),
            'visibility' => 'public',
        ]);

        return Storage::disk(config('modules.blog.storage_disk'))->url($path);
    }
}
