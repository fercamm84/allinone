<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Auth;
use App;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class AccountController extends FrontController
{

    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo){
        parent::__construct();
        $this->userRepository = $userRepo;
    }

    public function index(){
        $user = Auth::user();

        $sections = Section::all();

        return view('account.edit', array('user' => $user, 'sections' => $sections));
    }

    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('myAccount.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('myAccount.index'));
    }

    public function changePassword(){
        $user = Auth::user();

        $sections = Section::all();

        return view('account.change_password', array('user' => $user, 'sections' => $sections));
    }

    public function updatePassword(UpdateUserRequest $request){
        if(Auth::Check())
        {
            $request_data = $request->All();
            $validator = $this->admin_credential_rules($request_data);
            if($validator->fails())
            {
                Flash::error($validator->errors()->first());
            }
            else
            {
                $current_password = Auth::User()->password;
                if(Hash::check($request_data['password'], $current_password))
                {
                    $user_id = Auth::User()->id;
                    $obj_user = App\Models\User::find($user_id);
                    $obj_user->password = Hash::make($request_data['new_password']);;
                    $obj_user->save();
                    Flash::success('Password updated successfully.');
                    return redirect()->to('/myAccount');
                }
                else
                {
                    Flash::error('Please enter correct current password');
                }
            }
        }

        $user = Auth::user();

        $sections = Section::all();

        return view('account.change_password', array('user' => $user, 'sections' => $sections));
    }

    public function admin_credential_rules(array $data)
    {
        $messages = [
            'password.required' => 'Please enter current password',
            'new_password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'password' => 'required',
            'new_password' => 'required|same:new_password',
            'password_confirmation' => 'required|same:new_password',
        ], $messages);

        return $validator;
    }

}
