<?php

use Laravel\Sanctum\Sanctum;

return [

  /*
   * Stateful Domains
   * --------------------------------------------------------------------
   * Requests from these domains will receive cookies for stateful API
   * authentication. Typically, include your local and production domains
   * if your API is accessed by a frontend SPA.
   */
  'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
      '%s%s',
      'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
      Sanctum::currentApplicationUrlWithPort()
  ))),

  /*
   * Sanctum Guards
   * --------------------------------------------------------------------
   * These authentication guards are checked when Sanctum authenticates
   * requests. If none match, Sanctum uses the bearer token for authentication.
   */
  'guard' => ['web'],

  /*
   * Token Expiration (Minutes)
   * --------------------------------------------------------------------
   * This value controls how long an issued token is valid before expiring.
   * It overrides any "expires_at" setting on the token itself, but doesn't
   * affect first-party sessions. Set to `null` for no expiration.
   */
  'expiration' => 1440, 

  /*
   * Token Prefix
   * --------------------------------------------------------------------
   * Sanctum can prefix new tokens to improve security by notifying
   * developers if they accidentally commit tokens to source control.
   * Configure this in your `.env` file (e.g., SANCTUM_TOKEN_PREFIX=your_prefix)
   */
  'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

  /*
   * Sanctum Middleware
   * --------------------------------------------------------------------
   * These middleware are used when authenticating your SPA with Sanctum.
   * You may customize them as needed.
   */
  'middleware' => [
    'authenticate_session' => Laravel\Sanctum\Http\Middleware\AuthenticateSession::class,
    'encrypt_cookies' => Illuminate\Cookie\Middleware\EncryptCookies::class,
    'validate_csrf_token' => Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
  ],

];