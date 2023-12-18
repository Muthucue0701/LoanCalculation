<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\user;
use App\Models\scheme;
use Illuminate\Support\Facades\Session;
use Hash;

class AdminController extends Controller
{
    public function Home(){
        return view('auth.Home');
    }
    public function login(){
        return view('auth.login');
    }
    public function registration(){
        return view('auth.registration');
    }
    
    public function storeuser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:10'
        ]);

        $user = new User(); 
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        
        $res = $user->save();
        echo ($user->username);

        if ($res) {
            return back()->with('success', 'You have registered successfully');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }
    public function adminregistration(){
        return view('auth.adminregistration');
    }
    public function storeadmin(Request $request)
    {
        $request->validate([
            'adminname' => 'required',
            'password' => 'required|min:3|max:10'
        ]);

        $admin = new Admin(); 
        $admin->adminname = $request->input('adminname');
        $admin->password = bcrypt($request->input('password'));
        
        $res = $admin->save();
        echo ($admin->adminname);

        if ($res) {
            return back()->with('success', 'You have registered successfully');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }


    public function adminlogin(){
        return view('auth.adminlogin');
    }
    public function adminloginpass(Request $request)
    {
        $request->validate([
            'adminname' => 'required',
            'password' => 'required|min:3|max:10'
        ]);

        $admin = Admin::where('adminname', '=', $request->adminname)->first();

        if ($admin) {
            // Check if the password is hashed using Bcrypt
            if (password_get_info($admin->password)['algo'] === PASSWORD_BCRYPT) {
                if (Hash::check($request->password, $admin->password)) {
                    $request->session()->put('loginId', $admin->id);
                    return redirect('dashboard');
                } else {
                    return back()->with('fail', 'Password not matches');
                }
            } else {
                // Check if the plain password matches
                if (password_verify($request->password, $admin->password)) {
                    $request->session()->put('loginId', $admin->id);
                    return redirect('dashboard');
                } else {
                    return back()->with('fail', 'Password not matches');
                }
            }
        } else {
            return back()->with('fail', 'Admin not found');
        }
    }
    public function dashboard(){
        $data=array();
        if(session::has('loginId')){
            $data=Admin::where('id','=',session::get('loginId'))->first();
            $data['id'] = $data->id;
            $data['adminname'] = $data->adminname;
        }
        return view('auth.dashboard',compact('data'));
    }
    
    public function addscheme(){
        return view('auth.addscheme');
    }
    public function storescheme(Request $request){
        $request->validate([
            'loan_name' => 'required',
            'interest_percentage' => 'required|numeric|min:0|max:100', 
         ]);

        $scheme = new Scheme();
        $scheme->loan_name = $request->input('loan_name');
        $scheme->interest_percentage = $request->input('interest_percentage');
        $result = $scheme->save();

        if ($result) {
            return back()->with('success', 'Scheme added successfully');
        } else {
            return back()->with('fail', 'Failed to add scheme');
        }
   
    }
    
    public function AdminScheme()
    {
        $schemes = Scheme::all();
        if ($schemes->isEmpty()) {
            $message = 'No schemes found.';
            return view('auth.AdminScheme', compact('message'));
        }
        return view('auth.AdminScheme', compact('schemes'));
    }
    public function logout(Request $request)
    {
        Session::flash('success', 'You have been successfully logged out.');
        $request->session()->forget('loginId');
        return redirect('/'); // Redirect to your login page after logout
    }

}
