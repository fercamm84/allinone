<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\RoleUserRepository;
use App\Repositories\UserRepository;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /** @var  RoleUserRepository */
    private $roleUserRepository;

    /** @var  UserRepository */
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoleUserRepository $roleUserRepo, UserRepository     $userRepo){
        $this->roleUserRepository = $roleUserRepo;
        $this->userRepository = $userRepo;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->redirectTo = '/';

        try{
            $this->validator($request->all())->validate();
        }catch(\Exception $e){
            Flash::error(trans('auth.register.error'));
            throw $e;
        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        $roleUser = array();
        $roleUser['user_id'] = $user->id;
        $roleUser['role_id'] = 2;
        $this->roleUserRepository->create($roleUser);

        Flash::success(trans('auth.register.ok'));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

}
