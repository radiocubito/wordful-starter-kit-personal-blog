<?php

use App\Models\User;
use Radiocubito\Wordful\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'owner' => User::whereEmail(config('site.owner'))->first(),
        'posts' => Post::published()->ofType('post')->orderBy('published_at', 'desc')->get(),
    ]);
})->name('home');

require __DIR__.'/auth.php';

Route::get('/feed', function () {
    $content = view('feed', [
        'owner' => User::whereEmail(config('site.owner'))->first(),
        'posts' => Post::published()->ofType('post')->orderBy('published_at', 'desc')->get(),
    ]);

    return response($content, 200)
        ->header('Content-Type', 'text/xml');
})->name('feed');

Route::get('/{post:slug}', function (Post $post) {
    abort_unless($post->isPublished(), 404);

    return view('post', [
        'owner' => User::whereEmail(config('site.owner'))->first(),
        'post' => $post,
    ]);
})->name('posts.show');
