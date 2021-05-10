<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use App\HasRole;
use App\UsersImport;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'school_mail' => ['required', 'string', 'email', 'max:255', 'unique:users'],
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

        $login = explode("@", $data['school_mail']);

        $ustavy = ["UPSY", "UPGM", "UITS", "UIFS"];

        $act_user = UsersImport::where('login', $login[0])->first();

        if(isset($act_user)) {
            if(in_array($act_user->class, $ustavy) && $login[1] == "fit.vut.cz") {
                $role = Role::where('role', 'Učitel')->first();
            } else if(strpos($act_user->class, "FIT") !== false && $login[1] == "stud.fit.vut.cz") {
                $role = Role::where('role', 'Student')->first();
            } else {
                $role = Role::where('role', 'Registrovaný uživatel')->first();
            }
        } else {
            $role = Role::where('role', 'Registrovaný uživatel')->first();
        }


        $user = User::create([
            'username' => $data['username'],
            'school_mail' => $data['school_mail'],
            'password' => Hash::make($data['password']),
        ]);

        $hasRole = new hasRole();
        $hasRole->user_id = $user->id;
        $hasRole->role_id = $role->id;
        $hasRole->save();

        return $user;

    }
}
