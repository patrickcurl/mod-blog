@extends('blog::layouts.app')

@section('actions')
    <a href="{{ route('blog.admin.post.create') }}" class="btn btn-sm btn-outline-primary my-auto mx-3">
        {{ __('blog::buttons.posts.create') }}
    </a>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mt-2">{{ __('blog::stats.header') }}</h1>

                @if($data['posts']['all']->isNotEmpty())
                    <p class="mt-3 mb-4">{{ __('blog::stats.subtext') }}</p>

                    <div class="card-deck mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-muted small text-uppercase font-weight-bold">{{ __('blog::stats.cards.views.title') }}</h5>
                                <p class="card-text display-4">{{ \Modules\Blog\Helper::suffixNumber($data['views']['count']) }}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-muted small text-uppercase font-weight-bold">{{ __('blog::stats.cards.posts.title') }}</h5>
                                <p class="card-text display-4">{{ $data['posts']['published_count'] + $data['posts']['drafts_count'] }}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-muted small text-uppercase font-weight-bold">{{ __('blog::stats.cards.publishing.title') }}</h5>
                                <ul>
                                    <li>{{ $data['posts']['published_count'] }} {{ __('blog::stats.cards.publishing.details.published') }}</li>
                                    <li>{{ $data['posts']['drafts_count'] }} {{ __('blog::stats.cards.publishing.details.drafts') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <line-chart :views="{{ $data['views']['trend'] }}"></line-chart>

                    <post-list :models="{{ $data['posts']['all'] }}" inline-template>
                        <div class="mt-4">
                            <div v-cloak>
                                <div class="d-flex border-top py-3 align-items-center" v-for="post in filteredList">
                                    <div class="mr-auto">
                                        <p class="mb-1 mt-2">
                                            <a :href="'/' + '{{ config('blog.path') }}' + '/stats/' + post.id" class="font-weight-bold lead">@{{ post.title }}</a>
                                        </p>
                                        <p class="text-muted mb-2">
                                            @{{ post.read_time }} ―
                                            <a :href="'/' + '{{ config('blog.path') }}' + '/posts/' + post.id + '/edit'">{{ __('blog::buttons.posts.edit') }}</a> ―
                                            <a :href="'/' + '{{ config('blog.path') }}' + '/stats/' + post.id">{{ __('blog::buttons.stats.show') }}</a>
                                        </p>
                                    </div>
                                    <div class="ml-auto d-none d-lg-block">
                                        <span class="text-muted mr-3">@{{ suffixedNumber(post.views_count) }} {{ __('blog::stats.views') }}</span>
                                        {{ __('blog::stats.details.created') }} @{{ moment(post.created_at).fromNow() }}
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <a href="#!" class="btn btn-link" @click="limit += 7" v-if="load">{{ __('blog::buttons.general.load') }} <i class="fa fa-fw fa-angle-down"></i></a>
                                </div>
                            </div>
                        </div>
                    </post-list>
                @else
                    <p class="mt-4">{{ __('blog::stats.empty') }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
