<?php

namespace Modules\Blog\Actions\Admin;

use Lorisleiva\Actions\Action;

class Lang extends Action
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
        $files = glob(module_path('blog').'/Resources/lang/'.config('app.locale').'/*.php');
        $lines = collect();

        foreach ($files as $file) {
            $filename = basename($file, '.php');
            $lines->put($filename, require $file);
        }

        header('Content-Type: text/javascript');
        echo 'window.i18n = '.json_encode($lines->toArray()).';';

        die();
    }
}
