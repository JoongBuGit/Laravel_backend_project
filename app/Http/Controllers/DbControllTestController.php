<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

class DbControllTestController extends Controller
{
    // 회원가입 처리
    public function signup(Request $request) {

        // 회원가입 정보 데이터 변수에 넣어주기
        $email = $request-> input('Email');
        $PW = $request -> input('PW');

        // 비번 해시화
        $PW_Hashed = Hash::make($PW);

        // DB에 잘 넣는지 확인
        try {
             // DB에 회원가입 데이터 넣기
            $create = DB::table('account') -> insert([
            'email' => $email,
            'pw' => $PW_Hashed
        ]);
        } catch (\Exception $e) {

        // 에러나면 알림창으로 회원가입 실패를 알려주기
        return redirect("https://zz.msporthome.store/signup_failed");
        }

        // 성공시 알림창으로 회원가입 성공을 알려주기
        return redirect("https://zz.msporthome.store/signup_successed");

        // 회원가입 DB출력해서 성공했는지 확인하는 코드
        // $table = DB::table('account')-> get();
        // return $table -> all();

    }   

    // 로그인 상태 확인 -> 로컬 스토리지로 대체

    public function loginCheck (Request $request) {        

        $session_data = $request->session()->get('login_state');


        // $session_data = "hihi";
        // $session_data = $request->session()->all();

        // $session_data = session()->all();



         // json -> array로 바꿔주기
        //  $account_data_array = json_decode($session_data, true);

         // array에서 PW 데이터만 추출
        //  $account_login_state = $account_data_array[0]['login_state'];


        if ($session_data == 'login') {
            return response()->json(['login_state' => 'login']);            
        } else {
            return response()->json(['login_state' => 'logout']);

        }

        return $session_data;
    }


    // 로그인 처리
    public function login(Request $request) {
        // 1. DB에서 이메일로 pw들 찾아서 비교하기 -> 이때 이메일은 중복이 되면 안됨
            
        // request로 넘어온 로그인 데이터 변수에 넣어주기
        $email = $request-> input('Email');
        $PW = $request -> input('PW');


        // 이메일에 해당하는 계정 json 데이터 가져오기
        $account = DB::table('account') -> where('email', $email) -> get() ;

        // 배열 엘리먼트의 개수를 세서 email 존재 여부 확인
        // 0 => 계정 없음 , 1 => 계정 있음
        $count = count($account);


        // 계정 없을
        if ($count == 0) {
            $request->session()->put('login_state', 'logout');

            return response()->json([
                'login_state' => 'logout',
                'text_message' => '로그인 실패 다시 해주세요',
            ]);

            // return "로그인 실패 다시 해주세요";
        } else {    
        // 계정 있을 때

        // json -> array로 바꿔주기
        $account_array = json_decode($account, true);

        // array에서 PW 데이터만 추출
        $account_PW = $account_array[0]['pw'];

         // 비밀번호 채크
        $check_PW = Hash::check($PW, $account_PW);

         // 로그인 실패, 성공 구분해주기
        if ($check_PW == false) {

            session()->put('login_state', 'logout');

           // 로그인 실패
        //    return "로그인 실패 다시 해주세요";

           return response()->json([
            'login_state' => 'logout',
            'text_message' => '로그인 실패 다시 해주세요',
        ]);


        //    $request->session()->put('login_state', 'logout');
        } else {
            // 로그인 성공

            $request->session()->put('login_state', 'login');
            // dd(Session::all()); // 모든 세션 데이터 출력


            return response()->json([
                'login_state' => 'login',
                'text_message' => '로그인 성공!, 서비스를 이용해주세요',
            ]);


            //  return response()->
            //  json(['login_state' => 'login'
            // //  ,       'session_id' => $_token
            // ], 200)
            //     ->cookie('SESSION_COOKIE', session()->getId(), $cookie_lifetime, '/', null, false, true); // HttpOnly 설정


            // return response()->json(['authenticated' => true, 'user' => auth()->user()]);

            // return response()->json(['login_state' => 'login']);
        }

        }


        // $session_data = $request->session()->all();

        // dd(Session::all()); // 모든 세션 데이터 출력


        // return dd(Session::all());

        // return $session_data;


        // 배열 키값으로 PW 가져오기
        //  $PW = $login_array['PW'];

        // return $tt2;
      

    }

}
