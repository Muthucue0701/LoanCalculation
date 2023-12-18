<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\scheme;
use Hash;
use Illuminate\Support\Facades\Session;


class CustomAuth extends Controller
{
        
    public function UserLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:3|max:10'
        ]);

        $user = User::where('username', '=', $request->username)->first();

        if ($user) {
            // Check if the password is hashed using Bcrypt
            if (password_get_info($user->password)['algo'] === PASSWORD_BCRYPT) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('loginId', $user->id);
                    return redirect('userdashboard');
                } else {
                    return back()->with('fail', 'Password not matches');
                }
            } else {
                if (password_verify($request->password, $user->password)) {
                    $request->session()->put('loginId', $user->id);
                    return redirect('userdashboard');
                } else {
                    return back()->with('fail', 'Password not matches');
                }
            }
        } else {
            return back()->with('fail', 'user not found');
        }
    }
    public function userdashboard(){
        $data=array();
        if(session::has('loginId')){
            $data=User::where('id','=',session::get('loginId'))->first();
            $data['id'] = $data->id;
            $data['username'] = $data->username;
            $schemes = Scheme::all();
            if ($schemes->isEmpty()) {
                $message = 'No schemes found.';
                return view('auth.AdminScheme', compact('message'));
            }
        } 
        return view('auth.userdashboard', compact('data', 'schemes'));
    }
    public function calculateInterest(Request $request)
    {
        $data=array();
        if(session::has('loginId')){
            $data=User::where('id','=',session::get('loginId'))->first();
            $data['id'] = $data->id;
            $data['username'] = $data->username;
            $schemes = Scheme::all();
        } 
        $loanAmount = $request->input('Amount');
        $year = $request->input('Year');
        $calculatedInterest = [];
        $emi = [];
        $tot=[];
        $y=[];


    foreach ($schemes as $scheme) {
        $calculatedInterest[$scheme->id] = (int)$loanAmount * $scheme->interest_percentage * ((int)$year) / 100;
        $monthlyInterestRate = ($scheme->interest_percentage / 12) / 100;
        $numPayments = $year * 12;
        $emi[$scheme->id] =(((int)$loanAmount * $scheme->interest_percentage * ((int)$year) / 100)+(int)$loanAmount) /$numPayments ;
        $tot[$scheme->id] = ((int)$loanAmount * $scheme->interest_percentage * ((int)$year) / 100)+ (int)$loanAmount;
        $y[$scheme->id] =$year;
    }
    return view('auth.userdashboard', compact('data', 'schemes', 'calculatedInterest','emi','tot','y'));
}

/* 

        //dd($loanAmount, $year);
        $calculatedInterest = (int)$loanAmount *$intrest * ((int)$year * 12) / 100;
        return view('auth.userdashboard', compact('data', 'schemes', 'calculatedInterest'));
    }
     */

}
