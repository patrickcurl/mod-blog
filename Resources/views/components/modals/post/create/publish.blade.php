<div class="modal fade" id="modal-publish" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-12">
                        <label for="published_at" class="font-weight-bold">{{ __('blog::posts.forms.publish.header') }}</label>
                        <p class="text-muted">{{ __('blog::posts.forms.publish.subtext.details') }} <span class="font-weight-bold">{{ now()->timezoneName }}</span> {{ __('blog::posts.forms.publish.subtext.timezone') }}.</p>

                        <date-time-picker value="{{ now()->format('Y-m-d\TH:i') }}"></date-time-picker>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary"
                   onclick="event.preventDefault();document.getElementById('form-create').submit();"
                   aria-label="Publish this post">{{ __('blog::buttons.posts.update') }}</a>
                <button class="btn btn-link text-muted" data-dismiss="modal">
                    {{ __('blog::buttons.general.cancel') }}
                </button>
            </div>
        </div>
    </div>
</div>
