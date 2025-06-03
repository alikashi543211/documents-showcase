<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FrontService
{

    public function __construct() {}

    public function frontServiceIndex()
    {
        if (!$this->frontServiceHelperUserLoggedIn()) {
            Session::flash('error', 'Please login to continue.');
            return redirect()->to('user-login');
        }
        // Return the front.index view with all defined variables in the current scope
        return view('front.index', get_defined_vars());
    }

    public function frontServiceUserLoginView()
    {
        if ($this->frontServiceHelperUserLoggedIn()) {
            return redirect()->to('/');
        }
        return view('front.user_login', get_defined_vars());
    }

    public function frontServiceUserLogin($request)
    {

        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'username' => 'required|max:250',
            'password' => 'required|min:8|max:20',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->to('/user-login');
        }

        if ($inputs['username'] == 'kashif.ali' && $inputs['password'] == '12345678') {
            Session::put('user_logged_in', [
                'username' => $inputs['username'],
                'password' => $inputs['password']
            ]);

            Session::flash('success', "You’ve successfully logged in.");
            return redirect()->to('/');
        }

        Session::flash('error', 'Invalid email or password.');
        return redirect()->to('/user-login');
    }

    public function frontServiceUserLogout()
    {

        Session::forget('user_logged_in');
        Session::flash('success', 'Logged out successfully.');
        return redirect()->to('/user-login');
    }

    public function frontServiceHelperUserLoggedIn()
    {
        if (Session::has('user_logged_in')) {
            $user = Session::get('user_logged_in');
            if ($user['username'] == 'kashif.ali' && $user['password'] == '12345678') {
                return true;
            }
        }

        return false;
    }
}
