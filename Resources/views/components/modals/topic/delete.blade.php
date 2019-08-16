<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="font-weight-bold lead">{{ __('blog::topics.delete.header') }}</p>

                {{ __('blog::topics.delete.warning') }}
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger"
                   onclick="event.preventDefault();document.getElementById('form-delete').submit();"
                   aria-label="Delete">{{ __('blog::buttons.general.delete') }}</a>
                <button type="button" class="btn btn-link text-muted" data-dismiss="modal">
                    {{ __('blog::buttons.general.cancel') }}
                </button>

                <form id="form-delete" action="{{ route('blog.admin.topic.destroy', $topic->id) }}" method="POST" style="display: none">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{ method_field('DELETE') }}
                </form>
            </div>
        </div>
    </div>
</div>
