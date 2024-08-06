<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

use Illuminate\Session\Store;


class CheckUser
{



public function __construct(Store $session)
{
    $this->session = $session;
}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         // 세션 시작 (필요한 경우)
        //  if (!session()->has('user_id')) {
        //     session()->start();
        // }

        // $session_data = session() -> has('login_state');


        // if ( $session_data ) {
        //     // echo '로그인 상태 데이터 있음 <br>';

        // } else {
        //     // echo ' NULL값 <br>';

        // }

        // 세션에 필요한 값 설정
        // session(['user_id' => auth()->id()]);
        // session(['login_state' => 'logout']);






        return $next($request)
        // 모든 도메인 허용 (주의: 보안 문제 발생 가능성)
            ->header('Access-Control-Allow-Origin', '*') 
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');

    //    $loginState = $request -> session() -> get('_loginState') ;

    //    $loginState = $request -> session() -> get('login_state') ;

    //    $request->session()->put('user_id', 1);

   



    //   $session_data = $request->session()->all();

        // echo '미들웨어 성공 <br>';
        
        // $dd = session('login_state');

        // if ($dd == null) {
        //     echo ' == NULL 실패';

        // } else {
        //     echo ' == 성공';
        // }

        // echo $dd;

        // echo dd(Session::all());

        // echo '<br>';

        // echo '로그인 인증 할 미들웨어 - 이 줄은 미들웨어 동작 <br>';

        

        return $next($request);






        
    }
}
