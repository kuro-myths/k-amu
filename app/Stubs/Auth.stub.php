<?php

namespace {

    use Illuminate\Auth\AuthManager;

    /**
     * Get the authentication guard.
     */
    function auth(?string $guard = null): AuthManager|\Illuminate\Contracts\Auth\Guard
    {
        $auth = app('auth');
        if (null === $guard) {
            return $auth;
        }

        return $auth->guard($guard);
    }
}
