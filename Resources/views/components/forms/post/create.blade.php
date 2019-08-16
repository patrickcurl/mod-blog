<form role="form" id="form-create" method="POST" action="{{ route('blog.admin.post.store') }}"
      enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" hidden value="{{ $data['id'] }}">

    <div class="form-group row my-3">
        <div class="col-lg-12">
            <textarea name="title" class="form-control-lg form-control border-0 pl-0 serif" rows="1"
                      placeholder="{{ __('blog::posts.forms.editor.title') }}" style="font-size: 42px; resize: none;">{{ old('title') }}</textarea>
        </div>
    </div>

    <editor :unsplash="'{{ config('blog.unsplash.access_key') }}'"
            :path="'{{ config('blog.path') }}'">
    </editor>

    @include('blog::components.modals.post.create.settings')
    @include('blog::components.modals.post.create.publish')
    @include('blog::components.modals.post.create.image')
    @include('blog::components.modals.post.create.seo')
</form>
