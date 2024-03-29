<div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" id="featured-image-unsplash-modal" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="font-weight-bold lead">{{ __('blog::posts.forms.image.header') }}</p>

                <featured-image-uploader
                        :post="'{{ $data['id']->toString() }}'"
                        :caption="'{{ old('featured_image_caption') }}'"
                        :unsplash="'{{ config('blog.unsplash.access_key') }}'"
                        :path="'{{ config('blog.path') }}'">
                </featured-image-uploader>
            </div>
            <div class="modal-footer">
                <button class="btn btn-link text-muted" data-dismiss="modal">{{ __('blog::buttons.general.done') }}</button>
            </div>
        </div>
    </div>
</div>
