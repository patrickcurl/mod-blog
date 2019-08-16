@extends('blog::layouts.app')

@section('actions')
    <a href="#" class="btn btn-sm btn-outline-primary my-auto"
       onclick="event.preventDefault();document.getElementById('form-edit').submit();"
       aria-label="Save">
        {{ __('blog::buttons.tags.update') }}
    </a>

    <div class="dropdown">
        <a id="navbarDropdown" class="nav-link px-3 text-secondary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fas fa-sliders-h fa-fw fa-rotate-270"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a href="#" class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete">
                {{ __('blog::buttons.general.delete') }}
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('blog::components.forms.tag.edit')
                @include('blog::components.modals.tag.delete')
            </div>
        </div>
    </div>
@endsection
