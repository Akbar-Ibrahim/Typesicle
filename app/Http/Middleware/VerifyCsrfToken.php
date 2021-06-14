<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/post-comment',
        '/comment-reply',
        '/category-create',
        '/drafts/create',
        '/drafts/{id}/update',
        '/post-repost',
        'vote',
        'shortie/comment',
        'group/send-chat',
        '/share/{id}/{user_id}/action'

    ];
}
