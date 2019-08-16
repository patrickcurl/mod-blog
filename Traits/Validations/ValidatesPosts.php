<?php

namespace Modules\Blog\Traits\Validations;

use Illuminate\Validation\Rule;

trait ValidatesPosts
{
    private function getData()
    {
        return [
            'id'                     => request('id'),
            'slug'                   => request('slug'),
            'title'                  => request('title', 'Post Title'),
            'summary'                => request('summary', null),
            'body'                   => request('body', null),
            'published_at'           => Carbon::parse(request('published_at'))->toDateTimeString(),
            'featured_image'         => request('featured_image', null),
            'featured_image_caption' => request('featured_image_caption', null),
            'user_id'                => auth()->user()->id,
            'meta'                   => [
                'meta_description'    => request('meta_description', null),
                'og_title'            => request('og_title', null),
                'og_description'      => request('og_description', null),
                'twitter_title'       => request('twitter_title', null),
                'twitter_description' => request('twitter_description', null),
                'canonical_link'      => request('canonical_link', null),
            ],
        ];
    }

    public function getMessages()
    {
        return [
            'required' => __('blog::validation.required'),
            'unique'   => __('blog::validation.unique'),
        ];
    }

    public function getRules()
    {
        return [
            'title'        => 'required',
            'slug'         => 'required|'.Rule::unique('blog_posts', 'slug')->ignore(request('id')).'|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/i',
            'published_at' => 'required|date',
            'user_id'      => 'required',
        ];
    }

    private function validateData()
    {
        $data = $this->getData();
        validator($data, $this->getRules(), $this->getMessages())->validate();

        return $data;
    }
}
