<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginSite(Request $request){
      //  $this->redirectTo = '/';
        return $this->login($request, 2, '/');
    }

    public function loginAdmin(Request $request){
      //  $this->redirectTo = '/products';
        return $this->login($request, 1, '/admin');
    }

    public function login(Request $request, $role, $path){
        $this->validateLogin($request);

        $this->redirectTo = $path;

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = Auth::user();
            $user = User::find($user->id);

            if($user && $user->status != 1){
                Auth::logout();

                Flash::error(trans('auth.verification'));
    
                throw ValidationException::withMessages([
                    $this->username() => [trans('auth.verification')],
                ]);
            }

            foreach($user->roleUsers as $roleUser){
                if($roleUser->role_id == $role){
                    return $this->sendLoginResponse($request);
                }
            }

            Auth::logout();

            Flash::error(trans('auth.permission'));

            throw ValidationException::withMessages([
                $this->username() => [trans('auth.permission')],
            ]);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $intendedUrl = Session::get('url.intended', url('/'));

        if(strpos($intendedUrl, 'basket.add') !== false){
            Session::forget('url.intended');
        }

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

}
