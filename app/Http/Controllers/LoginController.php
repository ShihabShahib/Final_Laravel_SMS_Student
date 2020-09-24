<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    function index(){
        return view('login');
    }
    function land(){
        return view('landing');
    }

    function varify(Request $request){
        $request->validate([
            'userid'  => 'required|max:10|min:10',
            'password'  => 'required'
        ]);

       $data = DB::table('login')
                    ->where('user_id', $request->userid)
                    ->where('userpassword', $request->password)
                    ->get();

        if(count($data) > 0 ){
            if($data[0]->usertype == "student"){
                $request->session()->put('userid', $request->userid);
                $request->session()->put('type', $data[0]->usertype);

                $student = DB::table('student')
                        ->where('student_id', $request->userid)
                        ->get();
                $request->session()->put('name', $student[0]->studentname);
                $request->session()->put('image', $student[0]->studentimage);
                $request->session()->put('class', $student[0]->class_id);
                $request->session()->put('section', $student[0]->section_id);
                return redirect()->route('student.stdash');
            }
        }else{
            $request->session()->flash('msg', 'invalid username/password');
            return redirect()->route('login');
        }
    }
}
