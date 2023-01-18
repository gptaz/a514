<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function index()
    {
        //
        if(!empty(session('username'))){
            $user = User::where('username',session('username'))->first();
            return view('display',compact('user'));
        }
        $msg="";
        return view('login',compact('msg'));
    }

    public function generatedb()
    {
        $user = new User();
        $user->username = "a1";
        $user->name = "Jame Smith";
        $user->email = "AlfredoSBaxter@teleworm.us";
        $user->address = "Sandy Bay";
        $user->balance = 100;
        $user->password = "123123";
        $user->save();

        $user = new User();
        $user->username = "a2";
        $user->name = "Susan M. Sweeney";
        $user->email = "AlfredoSBaxter@teleworm.us";
        $user->address = "Sandy Bay";
        $user->balance = 100;
        $user->password = "123123";
        $user->save();

        $user = new User();
        $user->username = "a3";
        $user->name = "Whitney P. Ramirez";
        $user->email = "AlfredoSBaxter@teleworm.us";
        $user->address = "Sandy Bay";
        $user->balance = 100;
        $user->password = "123123";
        $user->save();

        echo "Database is generated succesful!";
    }

    public function out(Request $request)
    {
        
        //dd(session('username'));
        $user = User::where('username',session('username'))->first();
        $user->token = '';
        $user->save();
        $request->session()->flush();
        return view('logout');
    }

    public function checklog(Request $request)
    {
        //
        $msg="";
        $user = User::where('username',$request->get('username'))
                            ->where('password',$request->get('password'))                        
                            ->first();
        //dd($user);
        if($user!=null) {
                $msg = "login success";
                /*
                session(['name' => $user->username]);
                session(['name' => $user->name]);
                session(['token' => $user->token]);
                */

                
                $user->token=$request->get('_token');
                $user->save();
                $url = 'http://131.217.174.114/a514/public/display/'.$user->username.'/'.$user->token;
                $stri = 'echo "Dear '.$user->name.',
                    <br>
                       Please use this link to login to the website:
                    <br>
                    '.$url.'
                    <br>
                    Admin Team
                    <br>
                    " | mail -s "Login link requested" '.$user->email;
                $last_line = system($stri, $retval);
                if(!$retval)
                {
                    $name = $user->name;
                    return view('notice',compact('name'));    
                } else echo "send email failed";
                
        } else $msg= "login failed";
        //return session('name');

        return view('login',compact('msg'));
    }

    public function display($username,$token){
        if(strlen($token)==40)
        {
            if($token == csrf_token())
            {
                //dd($username,$token);
                $user = User::where('username',$username)
                                ->where('token',$token)                        
                                ->first();
                //dd($user);
                if($user!=null) {
                    session(['username' => $user->username]);
                    session(['name' => $user->name]);
                    session(['token' => $user->token]);
                    return view('display',compact('user'));
                } else echo "Token has been expired";
            } else echo "Token has been expired";
            
            
        } else echo "Invalid token";
        
    }
}
