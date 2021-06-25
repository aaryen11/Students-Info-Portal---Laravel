<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;
use Validator;
use App\Models\User;
use App\Exports\UsersExport;  
use Maatwebsite\Excel\Facades\Excel; 


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            return view('home')->with('msg',"If it's your first login, Kindly change your password by navigating to change password section");   
    }

    public function ChangePasswordview(){
        return view('auth.changepassword');
    }

    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }


    public function addcsv()
    {
        if(Auth::user()->usertype == 1) {
            return view('addcsv');
        }
        else{
            return response(abort(403,''));
        }

    }


    public function upload(Request $request)
    {
        if(Auth::user()->usertype == 1) {
            $upload = $request->file('dbfile') ;
            $v = Validator::make(
                [
                    'file'      => $upload,
                    'extension' => strtolower($upload->getClientOriginalExtension()),
                ],    
                [
                    'file'          => 'required',
                    'extension'      => 'required|in:csv',
                ]
            );
            if($v->passes()){
                $filePath = $upload->getRealPath();
    
            $file = fopen($filePath,'r');
            $header = fgetcsv($file);
            
            // dd($header);
            $escapedHeader=[];
            //validate
            foreach ($header as $key => $value) {
                $lheader=strtolower($value);
                $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
                array_push($escapedHeader, $escapedItem);
            }
    
            //looping through othe columns
            while($columns=fgetcsv($file))
            {
                if($columns[0]=="")
                {
                    continue;
                }
                //Data to DB
    
               $data= array_combine($escapedHeader, $columns);
               $name=$data['name'];
               $email = $data['email'];
               $university = $data['university'];
               $section = $data['section'];
               $group = $data['group'];
                    $studentdata= User::firstOrNew(['email'=>$email]);
                    $studentdata->name=$name;
                    $studentdata->email=$email;
                    $studentdata->university=$university;
                    $studentdata->section=$section;
                    $studentdata->group=$group;
                    $studentdata->usertype='2';
                    $studentdata->password= Hash::make($email);
                    $studentdata->save();
            }
            return redirect()->back()->with('status','Successfully Added Entries!');
            }
            else{
                echo "<script> alert('Error : CSV File Type Required');</script>";
                return redirect()->back();
            }
        }

    }

    public function editprofile()
    {
        return view('edit');

    }

    public function update(Request $request)
    {
        $id = Auth::user()->email;
        $data = [
         'name' => $request->get('name'),
         'email' => $request->get('email'),
         'official_email_id' => $request->get('oemail'),
         'course' => $request->get('course'),
         'branch' => $request->get('branch'),
         'phone' => $request->get('phone'),
         'section' => $request->get('section'),
         'updated_at' => date('Y-m-d H:i:s')
        ];
     DB::table('users')->where("email",$id)->update($data);
     return redirect()->back()->with("success","Updated");
    }

    public function export()   
    {  
        if(Auth::user()->usertype == 1) {
            return Excel::download(new UsersExport, 'students.xlsx');
        }
        else{
            return response(abort(403,''));
        }  
    }  
}
