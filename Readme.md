This creates a medium-esque blog modelled after Canvas : https://cnvs.io but using [Nwidart/Laravel-Modules](https://github.com/nwidart/laravel-modules). 

<p align="center">
    <br>
    <center><h2>ModBlog a Modularized Blog Module</h2></center>
</p>

<p align="center">
    <a href="https://travis-ci.org/patrickcurl/mod-blog"><img src="https://travis-ci.org/patrickcurl/mod-blog.svg?branch=master"></a>
    <a href="https://packagist.org/packages/patrickcurl/mod-blog"><img src="https://poser.pugx.org/patrickcurl/mod-blog/downloads"></a>
    <a href="https://packagist.org/packages/patrickcurl/mod-blog"><img src="https://poser.pugx.org/patrickcurl/mod-blog/v/stable"></a>
    <a href="https://packagist.org/packages/patrickcurl/mod-blog"><img src="https://poser.pugx.org/patrickcurl/mod-blog/license"></a>
    <br><br>
</p>

## Introduction

A [Laravel](https://laravel.com) publishing platform. ModBlog is a fully open source package to extend your 
application and get you up-and-running with a blog in just a few minutes. In addition to a distraction-free 
writing experience, you can view monthly trends on your content, get insights into reader traffic and more!

## Installation

> **Note:** ModBlog requires you to have user authentication in place prior to installation. You may run the `make:auth` Artisan command to satisfy this requirement.

You may use composer to install ModBlog into your Laravel project:

```bash
composer require patrickcurl/mod-blog
```

Create a symbolic link to ensure file uploads are publicly accessible from the web using the `storage:link` Artisan command:

```bash
php artisan storage:link
```

## Configuration

> **Note:** The following steps are optional configurations, you are not required to complete them.

If you want to include [Unsplash](https://unsplash.com) images in your post content, set up a new application at [https://unsplash.com/oauth/applications](https://unsplash.com/oauth/applications). Grab your access key and update `config/modules/blog.php`:

```php
'unsplash' => [
    'access_key' => env('MODBLOG_UNSPLASH_ACCESS_KEY'),
],
```

**Want a weekly summary?** ModBlog provides support for a weekly e-mail that gives you quick stats of the content you've authored, delivered straight to your inbox. Once your application is [configured for sending mail](https://laravel.com/docs/5.8/mail), update `config/modules/blog.php`:

```php
'mail' => [
    'enabled' => env('MODBLOG_MAIL_ENABLED', false),
],
```

Since the weekly digest runs on [Laravel's Scheduler](https://laravel.com/docs/5.8/scheduling#introduction), you'll need to add the following cron entry to your server:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## Updates

You may update your ModBlog installation using composer:

```bash
composer update
```

Run any new migrations using the `migrate` Artisan command:

```bash
php artisan migrate
```

## Testing

Run the tests with:

```bash
composer test
```

## License

ModBlog is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits

- [The team](https://github.com/orgs/cnvs/people) that continues to support and develop this project
- Thanks to [Todd Austin](https://cnvs.io/) and his project [Canvas](https://github.com/cnvs/canvas) for inspring much of the design
- Thanks to [Mohamed Said](https://themsaid.com/) and his project [Wink](https://github.com/writingink/wink) for inspring much of the design
- Anyone who has [contributed a patch](https://github.com/patrickcurl/mod-blog/pulls) or [made a helpful suggestion](https://github.com/patrickcurl/mod-blog/issues)
