<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserRegistrationController extends Controller
{
    public function showRegistrationForm(){
    	return view('admin.users.registration-form');
    }

    public function saveUser(Request $request){
    	$this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $users = User::all();
        return view('admin.users.user-list', ['users'=>$users]);
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
            'role' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:17'],
            // 'mobile' => ['required', 'string', 'min:13', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
            'role'      => $data['role'],
            'name'      => $data['name'],
            'mobile'    => $data['mobile'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
        ]);
    }

    public function userList(){
    	$users = User::all();
        return view('admin.users.user-list', ['users'=>$users]);
    }
}
