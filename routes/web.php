<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Namespace1;
use App\Http\Controllers\SessionCookieController;
use App\Http\Middleware\CheckUser;


Route::get('/', function () {
    return view('welcome');
});


// 회원가입 테스트 페이지
Route::get('/signup', function() {
    return view('front_test_views/signup');
});


// 로그인 테스트 페이지
Route::get('/login', function() {
    return view('front_test_views/login');
});


// 회원가입 api
Route::post('/server/signup', 'App\Http\Controllers\DbControllTestController@signup');

// 로그인 api
Route::post('/server/login', 'App\Http\Controllers\DbControllTestController@login');

// 로그인 상태 체크
Route::get('/server/loginCheck', 'App\Http\Controllers\DbControllTestController@loginCheck');



// 세션 테스트 페이지
// Route::get ('/session/get',  [SessionCookieController::class, 'getSessionData']) -> name('session.get');
Route::get ('/session/set',  [SessionCookieController::class, 'storeSessionData']) -> name('session.set');
Route::get ('/session/remove',  [SessionCookieController::class, 'deleteSessionData']) -> name('session.remove');

 
    Route::get ('/session/get',  [SessionCookieController::class, 'getSessionData']) -> name('session.get');


Route::middleware(['web', 'SetSession'])->group(function () {
    // 모든 라우트
});




// 테스트 코드  ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ 

Route::get('/model', function () {

    return 'MODEL TEST';

});

Route::get('/session_test', function () {

    return 'MODEL TEST';

});



Route::get('/signup_successed', function () {
    echo "<script>
    alert('회원가입 성공, 이제 로그인 해주세요~!');
    window.location.href = 'https://a.msporthome.store';
    </script>";
});

Route::get('/signup_failed', function () {
    echo "<script>
    alert('회원가입 실패!, 다시 시도해 주세요');
    window.location.href = 'https://a.msporthome.store';
    </script>";
});

Route::get('/login_successed', function () {
    echo "<script>
    alert('로그인 성공!');
    window.location.href = 'https://a.msporthome.store';
    </script>";
});

Route::get('/login_failed', function () {
    echo "<script>
    alert('로그인 실패!, 다시 시도해 주세요');
    window.location.href = 'https://a.msporthome.store';
    </script>";
});

// Route::get('/chat', function () {
//     echo "<script>
//     alert('채팅창 이동');
//     window.location.href = 'https://a.msporthome.store';
//     </script>";
// });





