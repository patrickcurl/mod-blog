<form role="form" id="form-edit" method="POST" action="{{ route('blog.admin.post.update', $data['post']->id) }}"
      enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    {{ method_field('PUT') }}

    <div class="form-group row my-3">
        <div class="col-lg-12">
            <textarea name="title" class="form-control-lg form-control border-0 pl-0 serif" rows="1"
                      placeholder="{{ __('blog::posts.forms.editor.title') }}" style="font-size: 42px; resize: none;">{{ $data['post']->title }}</textarea>
        </div>
    </div>

    <editor value="{{ $data['post']->body }}"
            :unsplash="'{{ config('blog.unsplash.access_key') }}'"
            :path="'{{ config('blog.path') }}'">
    </editor>

    @include('blog::components.modals.post.edit.settings')
    @include('blog::components.modals.post.edit.publish')
    @include('blog::components.modals.post.edit.image')
    @include('blog::components.modals.post.edit.seo')
</form>
