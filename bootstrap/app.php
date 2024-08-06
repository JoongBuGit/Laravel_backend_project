<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\CheckUser;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // 미들웨어 클래스 적용하기 -> 로그인 인증할 미들웨어
        $middleware-> append(CheckUser::class);

        // CSRF 토큰 비활성화 -> 리엑트에서 접속하기 편하게 하기 위해서
        $middleware->validateCsrfTokens(except: [
            '/*'
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
