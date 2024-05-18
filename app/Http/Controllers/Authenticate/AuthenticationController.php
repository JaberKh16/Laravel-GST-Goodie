<?php

namespace App\Http\Controllers\Authenticate;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;

class AuthenticationController extends Controller
{
    public function register_page()
    {
        return view('authenticate.register');
    }

    public function register_process(Request $request)
    {
        $validated = $request->validate([
            'fullname' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:30'],
            'password' => ['required', 'string', 'min:6', 'max:8'],
            'password_confirmation' => ['required', 'string', 'min:6', 'max:8'],
            'role_type' => ['required', 'string', 'max:30'],
            'agree_terms' => ['optional', 'string'],
        ]);

        if($validated){
            $register_stat = DB::table('users')->insert([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password), 
                'role_type' => $request->role_type,
                'agree_terms' => $request->agree_terms,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if($register_stat){
                return redirect()->route('login.page')->with('success', 'Successfully registered.');
            }else{
                return redirect()->route('register.page')->with('success', 'Registration failed, please try again.');
            }
        }else{
            return redirect()->route('register.page')->with('error', 'Validation failed, try again');
        }

    }

    public function login_page()
    {
        return view('authenticate.login');
    }

    public function login_process(Request $request)
    {
        $validator =  $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if($validator){
       
            $credentials = $request->only('email', 'password');
            // check for attempt
            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard')->with('success', 'Login successfull, redirected to dashboard');
            }else {
                // authentication failed
                return redirect()->route('login.page')->with('error', 'Email address or password is incorrect.');
            }
        }

        return redirect()->back()->withErrors($validator)->withInput();
    }

    public function logout_process()
    {
        if(Auth::check()){
            // flush the session variable
            Session::flush();
            // logout() from auth
            Auth::logout();  
            // redirects
            return Redirect()->route('login.page');
        }
        
    }

    public function forgot_password_page()
    {
        return view('authenticate.forgot-pass');
    }


    public function send_reset_link_email(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        // check registered email or not
        $check_registered_email = $this->check_if_the_email_is_registered($request->email);
        if($check_registered_email){
            $status = Password::sendResetLink($request->only('email'));
      
            if ($status === Password::RESET_LINK_SENT) {
                Mail::to($request->email)->send(new ResetPasswordEmail($status));
                return back()->with(['status' => __($status)]);
            } else {
                return back()->withErrors(['email' => __($status)]);
            }
        }else{
            return redirect()->back()->with('error', 'Not a registered member.');
        }

    
    }


    public function check_if_the_email_is_registered(string $email)
    {
        $check_existed = DB::table('users')->where('email', $email)->exists();
        if($check_existed){
            return true;
        }else{
            return false;
        }
    }


    public function show_reset_password_form(Request $request)
    {
        if($request->token){
            return view('authenticate.reset-pass', ['token' => $request->token]);
        }
    }


    public function reset_password_process(Request $request)
    {
       
       
        $validated = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'confirmed', 'min:6', 'max:8'],
        ]);

        // dd($request->all());
        // check if validation fails
        if (!$validated) {
            return redirect()->back()->with('error', 'Validation failed, please try again.');
        }

        // check if the email is registered
        $user = $this->check_if_the_email_is_registered($request->email);
  

        if (!$user) {
            return redirect()->back()->with('error', 'Not a registered member.');
        }

        // reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        // check the status of the password reset
        if ($status){
            return redirect()->route('login.page')->with('success', __('Password reset successfully. You can now login with your new password.'));
        } else {
            return back()->withErrors(['email' => __('Password reset failed.')]);
        }
    }



}
