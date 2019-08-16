<?php

namespace Modules\Blog\Traits\Validations;

use Illuminate\Validation\Rule;

trait ValidatesTopics
{
    private function getData()
    {
        return [
            'id'   => request('id'),
            'name' => request('name'),
            'slug' => request('slug'),
        ];
    }

    private function getMessages()
    {
        return [
            'required' => __('blog::validation.required'),
            'unique'   => __('blog::validation.unique'),
        ];
    }

    private function getRules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|'.Rule::unique('blog_topics', 'slug')->ignore(request('id')).'|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/i',
        ];
    }

    private function validateData()
    {
        $data = $this->getData();
        validator($data, $this->getRules(), $this->getMessages())->validate();

        return $data;
    }
}
