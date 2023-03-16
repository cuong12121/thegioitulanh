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
         'ckfinder/*','add-cart','suggest','order-product', 'show-viewer-product','showDealClick', 'admins/check-active', 'compare-show-product', 'admins/add-limit', 'admins/remove-limit'
    ];
}
