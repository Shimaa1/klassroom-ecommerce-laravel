<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\RegistrationEmailNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(){
        $this->middleware('auth',['only'=>'logout']);
    }

    public function showLoginForm(){
        return view('frontend.auth.login');
    }

    public function processLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only(['email','password']);

        if (auth()->attempt($credentials)){

            if (auth()->user()->email_verified_at === null){
                $this->setError('Your account is not activated.');
                return redirect()->route('login');
            }
            $this->setSuccess('User logged in.');
            return redirect('/');
        }

        $this->setError('Invalid credentials');
        return redirect()->back();


    }

    public function showRegisterForm(){
        return view('frontend.auth.register');
    }

    public function processRegister(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|min:11|max:13|unique:users,phone_number',
            'password' => 'required|min:6',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => strtolower($request->email),
                'phone_number' => $request->phone_number,
                'password' => bcrypt($request->password),
                'email_verification_token' => uniqid(time(),true),
            ]);

            $user->notify(new RegistrationEmailNotification($user));

            $this->setSuccess('Account Registered.');
            return redirect()->route('login');

        }catch (\Exception $e){

            $this->setError($e->getMessage());
            return redirect()->back();
        }
    }

    public function activate($token = null){
        if ($token == null){
            return redirect('/');
        }

        $user = User::where('email_verification_token', $token)->firstOrFail();

        if ($user){
            $user->update([
                'email_verified_at' => Carbon::now(),
                'email_verification_token' => null,
            ]);

            $this->setSuccess('Account activated. You can log in now.');

            return redirect()->route('login');
        }

        $this->setError('Invalid token');
        return redirect()->route('login');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function profile(){

    }

}
