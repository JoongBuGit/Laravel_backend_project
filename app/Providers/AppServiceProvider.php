<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Route;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
          // 미들웨어 그룹 생성
    Route::middlewareGroup('auth.session', [
        'CheckUser', // 실제 미들웨어 클래스 이름
    ]);

    // 특정 라우트 그룹에 미들웨어 적용
    Route::middleware('auth.session')->group(function () {
        // 세션 값을 사용하는 라우트 정의
        Route::get('/*', [ProfileController::class, 'show']);
    });



    }
}
