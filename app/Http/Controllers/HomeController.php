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
use DataTables;

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
         'CGPA' => $request->get('cgpa'),
         'XII' => $request->get('12th'),
         'X' => $request->get('10th'),
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
    
    public function table()
    {
        $users = DB::table("users")->simplepaginate(10);
        return view('records',compact('users'));
    }

        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	
        if(Auth::user()->usertype == 1) {
        DB::table("users")->delete($id);
    	return response()->json(['success'=>"Record Deleted successfully.", 'tr'=>'tr_'.$id]);
        }
        else{
            return response(abort(403,''));
        }
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("users")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Records Deleted successfully."]);
    }

    public function search(Request $request)
    {
        $users = DB::table('users');
        if( $request->input('search')){
            $users = $users->where('name', 'LIKE', "%" . $request->search . "%");
        }
        $users = $users->paginate(10);
        return view('records', compact('users'));
    }

    public function usertable(Request $request)
    {
        if(Auth::user()->usertype == 1) {
        if($request->ajax())
        {
            $data = User::where('usertype','2')->oldest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('users');
        }
        else{
            return response(abort(403,''));
        }

    }

    public function email()   
    {  
        if(Auth::user()->usertype == 1) {
            $uni = User::distinct()->where('usertype','2')->select('university')->get()->toArray();
            $group = User::distinct()->where('usertype','2')->select('group')->get()->toArray();
            $sec = User::distinct()->where('usertype','2')->select('section')->get()->toArray();
            return view('email')->with('uni',$uni)->with('group',$group)->with('sec',$sec);
        }
        else{
            return response(abort(403,''));
        }  
    }

    public function all(Request $request)   
    {  
        if(Auth::user()->usertype == 1) {
            $subject = $request->get('esub');
            $body = $request->get('ebody');
             $emails = DB::table('users')->where('usertype','2')->pluck('email')->toArray();
             $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
             foreach($emails as $email)
             {
                 $beautymail->send('email-template',array('msg' => $body), function($message) use ($email,$subject)
                 {
                     $message->from('noreply.geu.gehu@gmail.com');
                     $message->to($email);
                     $message->subject($subject); 
                 });
             }
 
             return redirect()->back()->with("success","Email sent");
        }
        else{
            return response(abort(403,''));
        }  
    }

    public function university(Request $request)   
    {  
        if(Auth::user()->usertype == 1) {
            $uni = $request->get('uni');
            $subject = $request->get('esub');
            $body = $request->get('ebody');
             $emails = DB::table('users')->where('usertype','2')->where('university',$uni)->pluck('email')->toArray();
             $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
             foreach($emails as $email)
             {
                 $beautymail->send('email-template',array('msg' => $body), function($message) use ($email,$subject)
                 {
                     $message->from('noreply.geu.gehu@gmail.com');
                     $message->to($email);
                     $message->subject($subject); 
                 });
             }
 
             return redirect()->back()->with("success","Email sent");
        }
        else{
            return response(abort(403,''));
        }  
    }

    public function group(Request $request)   
    {  
        if(Auth::user()->usertype == 1) {
            $group = $request->get('grp');
            $subject = $request->get('esub');
            $body = $request->get('ebody');
             $emails = DB::table('users')->where('usertype','2')->where('group',$group)->pluck('email')->toArray();
             $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
             foreach($emails as $email)
             {
                 $beautymail->send('email-template',array('msg' => $body), function($message) use ($email,$subject)
                 {
                     $message->from('noreply.geu.gehu@gmail.com');
                     $message->to($email);
                     $message->subject($subject); 
                 });
             }
 
             return redirect()->back()->with("success","Email sent");
        }
        else{
            return response(abort(403,''));
        }  
    }


    public function section(Request $request)   
    {  
        if(Auth::user()->usertype == 1) {
            $section = $request->get('sec');
            $subject = $request->get('esub');
            $body = $request->get('ebody');
             $emails = DB::table('users')->where('usertype','2')->where('section',$section)->pluck('email')->toArray();
             $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
             foreach($emails as $email)
             {
                 $beautymail->send('email-template',array('msg' => $body), function($message) use ($email,$subject)
                 {
                     $message->from('noreply.geu.gehu@gmail.com');
                     $message->to($email);
                     $message->subject($subject); 
                 });
             }
 
             return redirect()->back()->with("success","Email sent");
        }
        else{
            return response(abort(403,''));
        }  
    }

    public function marks(Request $request)   
    {  
        if(Auth::user()->usertype == 1) {
            $xii = floatval($request->get('12th'));
            $x = floatval($request->get('10th'));
            $cgpa = floatval($request->get('cgpa'));
            $subject = $request->get('esub');
            $body = $request->get('ebody');
             $emails = DB::table('users')->where('usertype','2')->where('X','>=',$x)->where('XII','>=',$xii)->where('CGPA','>=',$cgpa)->pluck('email')->toArray();
             if($emails == null){
                return redirect()->back()->with("success","No Such Student");
             }
             else{
                $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
                foreach($emails as $email)
                {
                    $beautymail->send('email-template',array('msg' => $body), function($message) use ($email,$subject)
                    {
                        $message->from('noreply.geu.gehu@gmail.com');
                        $message->to($email);
                        $message->subject($subject); 
                    });
                }
    
                return redirect()->back()->with("success","Email sent");
            }
        }
        else{
            return response(abort(403,''));
        }  
    }
}
