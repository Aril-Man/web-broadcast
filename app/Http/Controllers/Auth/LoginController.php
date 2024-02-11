<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'index']);
    }

    public function index()
    {
        if(Auth::user()->role == "admin"){
            return redirect()->route('admin.index');
        }elseif(Auth::user()->role == "client"){
            return redirect()->route('client.index');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        if($request->email){
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required',
            ]);

            $login = auth()->attempt(array('email' => $input['email'], 'password' => $input['password']));
            $wordingError = 'Email And Password Are Wrong.';
        } else{
            return redirect()->route('login')->with('error','Login Failed');
        }

        if (Auth::user()->role == "admin") {
            return redirect()->route('admin.index');
        }else if (Auth::user()->role == "client"){
            return redirect()->route('client.index');
        }else {
            return redirect()->route('login')->with('error', $wordingError);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
