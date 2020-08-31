<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
// use Auth;


class UserRegistrationController extends Controller
{
    public function showRegistrationForm(){
        if (Auth::user()->role == 'Admin') {
            return view('admin.users.registration-form');
        }else{
            return back();
            // return redirect('/home');
        }
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
        if (Auth::user()->role == 'Admin') {
            $users = User::all();
            return view('admin.users.user-list', ['users'=>$users]);
        }else{
            return back();
            // return redirect('/home');
        }
    }

    public function userProfile($userId){

        $user = User::findOrFail($userId);
        return view('admin.users.profile', ['user'=>$user]); 
    }

    public function changeUserInfo($id){
        $user = User::find($id);
        return view('admin.users.change-user-info', ['user'=>$user]);
    }

    public function userInfoUpdate(Request $request){

        $this->validate($request, [

            'name'      => 'required|string|max:255',
            'mobile'    => 'required|string|max:17',
            'email'     => 'required|string|max:255|email',
        ]);

        $user = User::find($request->user_id);

        $user->name     = $request->name;
        $user->mobile   = $request->mobile;
        $user->email    = $request->email;

        $user->save();

        return redirect("/user-profile/$request->user_id")->with('message', 'Information updated successfully');
    }
}
