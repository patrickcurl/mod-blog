<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    $config = [
        'middleware' => config('modules.blog.middleware'),
        'namespace'  => 'Modules\Blog\Actions',
        'prefix'     => config('modules.blog.path'),
    ];

    Route::prefix('blog')->as('blog.')->group(function () {
        Route::prefix('admin')->middleware(config('modules.blog.middleware', ['web', 'auth']))->namespace('Admin')->as('admin.')->group(function () {
            Route::namespace('Stats')->prefix('stats')->as('stats.')->group(function () {
                Route::get('/', Index::class)->name('index');
                Route::get('{id}', Show::class)->name('show');
            });

            Route::namespace('Posts')
                ->prefix('posts')
                ->as('post.')
                ->group(function () {
                    Route::get('create', Create::class)->name('create');
                    Route::get('{id}/edit', Edit::class)->name('edit');
                    Route::put('{id}', Update::class)->name('update');
                    Route::delete('{id}', Destroy::class)->name('destroy');
                    Route::get('/', Index::class)->name('index');
                    Route::post('/', Store::class)->name('store');
                });

            Route::namespace('Media')->prefix('media')->as('media.')->group(function () {
                Route::post('media/uploads', Store::class)->name('media.store');
            });
            Route::namespace('Tags')
                ->prefix('tags')
                ->as('tag.')
                ->group(function () {
                    Route::get('/', Index::class)->name('index');
                    Route::get('create', Create::class)->name('create');
                    Route::post('/', Store::class)->name('store');
                    Route::get('{tag}/edit', Edit::class)->name('edit');
                    Route::put('{tag}', Update::class)->name('update');
                    Route::delete('tags/{tag}', Destroy::class)->name('destroy');
                });
            Route::namespace('Topics')
                ->prefix('topics')
                ->as('topic.')
                ->group(function () {
                    Route::get('/', Index::class)->name('index');
                    Route::get('create', Create::class)->name('create');
                    Route::post('/', Store::class)->name('store');
                    Route::get('{topic}/edit', Edit::class)->name('edit');
                    Route::put('{topic}', Update::class)->name('update');
                    Route::delete('{topic}', Destroy::class)->name('destroy');
                });

            Route::get('lang', Lang::class)->name('lang');
        });

        Route::namespace('Posts')->group(function () {
            Route::get('/', Index::class)->name('index');
            Route::middleware('\Modules\Blog\Http\Middleware\ViewThrottle')->get('{slug}', Slug::class)->name('post');
            Route::get('tag/{slug}', Tags::class)->name('tag');
            Route::get('topic/{slug}', Topics::class)->name('topic');
        });
    });
