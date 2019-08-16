@extends('blog::layouts.app')

@section('actions')
    <a href="{{ route('blog.admin.post.create') }}" class="btn btn-sm btn-outline-primary my-auto mx-3">
        {{ __('blog::buttons.posts.create') }}
    </a>
@endsection

@section('content')
    <post-list :models="{{ $posts }}" :default-timezone="{{ json_encode(config('app.timezone')) }}" inline-template>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="d-flex justify-content-between">
                        <h1 class="mb-4 mt-2">{{ __('blog::posts.header') }}</h1>
                        <div class="dropdown my-auto">
                            <a href="#" id="navbarDropdown" class="nav-link px-0 text-secondary pt-0" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                               style="margin-top: -8px">
                                <i class="fas fa-search"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right py-0" style="min-width: 15rem;" aria-labelledby="dropdownMenuButton">
                                <form class="pl-2 w-100">
                                    <div class="form-group mb-0">
                                        <input v-model="search"
                                               type="text"
                                               class="form-control border-0 pl-0"
                                               id="search"
                                               placeholder="{{ __('blog::posts.search.input') }}..."
                                               autofocus>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if($posts->isNotEmpty())
                        <div v-cloak>
                            <div class="d-flex border-top py-3 align-items-center" v-for="post in filteredList">
                                <div class="mr-auto py-1">
                                    <p class="mb-1">
                                        <a :href="'/' + '{{ config('blog.path') }}' + '/posts/' + post.id + '/edit'" class="font-weight-bold lead">@{{ post.title }}</a>
                                    </p>
                                    <p class="mb-1" v-if="post.summary">@{{ post.summary }}</p>
                                    <p class="text-muted mb-0">
                                        <span v-if="post.published_at <= moment(new Date()).tz(timezone).format().slice(0, 19).replace('T', ' ')">
                                            {{ __('blog::posts.details.published') }} @{{ moment(post.published_at).fromNow() }}
                                        </span>
                                        <span v-else class="text-danger">
                                            {{ __('blog::posts.details.draft') }}
                                        </span>
                                        ― {{ __('blog::posts.details.updated') }} @{{ moment(post.updated_at).fromNow() }}
                                    </p>
                                </div>
                                <div class="ml-auto d-none d-lg-block">
                                    <a :href="'/' + '{{ config('blog.path') }}' + '/posts/' + post.id + '/edit'">
                                        <div v-if="post.featured_image"
                                             class="mr-2"
                                             :style="{ backgroundImage: 'url(' + post.featured_image + ')' }"
                                             style="background-size: cover;width: 57px; height: 57px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
                                        <span v-else class="fa-stack fa-2x align-middle">
                                        <i class="fas fa-circle fa-stack-2x text-black-50"></i>
                                        <i class="fas fa-fw fa-stack-1x fa-camera fa-inverse"></i>
                                    </span>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <a href="#!" class="btn btn-link" @click="limit += 7" v-if="load">{{ __('blog::buttons.general.load') }} <i class="fa fa-fw fa-angle-down"></i></a>
                            </div>

                            <p class="mt-4" v-if="!filteredList.length">{{ __('blog::posts.search.empty') }}</p>
                        </div>
                    @else
                        <p class="mt-4">{{ __('blog::posts.empty.description') }} <a href="{{ route('blog.admin.post.create') }}">{{ __('blog::posts.empty.action') }}</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </post-list>
@endsection
