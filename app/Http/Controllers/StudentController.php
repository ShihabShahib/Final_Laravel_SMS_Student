<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use App\Http\Requests\StudentRequests;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    function stdash(Request $request){
        $class = $request->session()->get('class');
        $section = $request->session()->get('section');

        $event = DB::table('event')->get();

        $notice = DB::table('notice')
                        ->join('subject', 'notice.subject_id', '=', 'subject.subject_id')
                        ->where('notice.class_id', $class)
                        ->where('notice.section_id', $section)
                        ->orderBy('notice.noticedate', 'desc')
                        ->limit(10)
                        ->get();

        return view('student.stdash')->with('notice', $notice)->with('event', $event);
    }

    function teacher(Request $request){
        $class = $request->session()->get('class');

        $teacher = DB::table('teacher')
                        ->join('subject', 'teacher.subject_id', '=', 'subject.subject_id')
                        ->where('subject.class_id', $class)
                        ->get();

        return view('student.teacher')->with('teacher', $teacher);
    }

    function routine(Request $request){

        $class = $request->session()->get('class');
        $section = $request->session()->get('section');

        $saturday = DB::table('routine')
                        ->where('class_id', $class)
                        ->where('section_id', $section)
                        ->where('day', 'Saturday')
                        ->orderBy('startingtime', 'asc')
                        ->get();

        $sunday = DB::table('routine')
                        ->where('class_id', $class)
                        ->where('section_id', $section)
                        ->where('day', 'Sunday')
                        ->orderBy('startingtime', 'asc')
                        ->get();

        $monday = DB::table('routine')
                        ->where('class_id', $class)
                        ->where('section_id', $section)
                        ->where('day', 'Monday')
                        ->orderBy('startingtime', 'asc')
                        ->get();

        $tuesday = DB::table('routine')
                        ->where('class_id', $class)
                        ->where('section_id', $section)
                        ->where('day', 'Tuesday')
                        ->orderBy('startingtime', 'asc')
                        ->get();

        $wednesday = DB::table('routine')
                        ->where('class_id', $class)
                        ->where('section_id', $section)
                        ->where('day', 'Wednessday')
                        ->orderBy('startingtime', 'asc')
                        ->get();

        $thursday = DB::table('routine')
                        ->where('class_id', $class)
                        ->where('section_id', $section)
                        ->where('day', 'Thursday')
                        ->orderBy('startingtime', 'asc')
                        ->get();

        return view('student.routine')->with('saturday', $saturday)
                                      ->with('sunday', $sunday)
                                      ->with('monday', $monday)
                                      ->with('tuesday', $tuesday)
                                      ->with('wednesday', $wednesday)
                                      ->with('thursday', $thursday);
    }

    function subject(Request $request){
        $class = $request->session()->get('class');
        
        $subject = DB::table('subject')
                        ->join('teacher', 'subject.subject_id', '=', 'teacher.subject_id')
                        ->where('class_id', $class)
                        ->get();
        
        return view('student.subject')->with('subject', $subject);
    }

    function syllabus(Request $request){

        $class = $request->session()->get('class');
        $section = $request->session()->get('section');

        $syllabus = DB::table('syllabus')
                        ->join('subject', 'syllabus.subject_id', '=', 'subject.subject_id')
                        ->where('syllabus.class_id', $class)
                        ->where('syllabus.section_id', $section)
                        ->get();

        return view('student.syllabus')->with('syllabus', $syllabus);
    }

    function notes(Request $request){

        $class = $request->session()->get('class');
        $section = $request->session()->get('section');

        $notes = DB::table('note')
                        ->join('subject', 'note.subject_id', '=', 'subject.subject_id')
                        ->where('note.class_id', $class)
                        ->where('note.section_id', $section)
                        ->get();
        return view('student.notes')->with('notes', $notes);
    }

    function assignment(Request $request){
        $class = $request->session()->get('class');
        $section = $request->session()->get('section');

        $assignment = DB::table('assignment')
                        ->join('subject', 'assignment.subject_id', '=', 'subject.subject_id')
                        ->join('teacher', 'assignment.subject_id', '=', 'teacher.subject_id')
                        ->where('assignment.class_id', $class)
                        ->where('assignment.section_id', $section)
                        ->orderBy('assignment.date', 'desc')
                        ->limit(10)
                        ->get();

        $upload = DB::table('assignment')
                        ->join('upload', 'assignment.assignment_id', '=', 'upload.assignment_id')
                        ->join('subject', 'assignment.subject_id', '=', 'subject.subject_id')
                        ->join('teacher', 'assignment.subject_id', '=', 'teacher.subject_id')
                        ->where('assignment.class_id', $class)
                        ->where('assignment.section_id', $section)
                        ->orderBy('upload.uploaddate', 'desc')
                        ->limit(10)
                        ->get();

        return view('student.assignment')->with('assignment', $assignment)->with('upload', $upload);
    }

    function upload($id,Request $request){
        $sid = $request->session()->get('userid');

        if($request->hasfile('uploadfile') ){
            
            $AssignmentFile =  $request->file('uploadfile');
            $filename = $AssignmentFile->getClientOriginalName();
            $date = date("Y-m-d");
            DB::table('upload')->insert(
                ['assignment_id' => $id,
                'uploadfilename' => $filename,
                'uploaddate' => $date,
                'student_id' => $sid]);
            if($AssignmentFile->move('student/file', $AssignmentFile->getClientOriginalName()) ){
                return redirect()->route('student.assignment');
            }else{
                return redirect()->route('student.stdash');
            }
        }
    }


    function generatepdf(Request $request){
        $id = $request->session()->get('userid');
        $class = $request->session()->get('class');
        $section = $request->session()->get('section');

        $grade = DB::table('result')
                        ->join('grade', 'result.subject_id', '=', 'grade.subject_id')
                        ->join('subject', 'result.subject_id', '=', 'subject.subject_id')
                        ->where('result.class_id', $class)
                        ->where('result.section_id', $section)
                        ->where('result.student_id', $id)
                        ->where('grade.class_id', $class)
                        ->where('grade.section_id', $section)
                        ->where('grade.student_id', $id)
                        ->get();
        return view('student.generatepdf')->with('grade', $grade);
    }

    function found(){

        $found= DB::table('lostfound')->get();
         
        return view('student.found')->with('found', $found);
    }

    function stprofile(Request $request){

        $value = $request->session()->get('userid');

        $student = DB::table('student')->where('student_id', $value)->first();

        return view('student.stprofile')->with('student', $student);
    }

    function updateprofile(Request $request){

        $value = $request->session()->get('userid');

        $student = DB::table('student')->where('student_id', $value)->first();

        return view('student.updateprofile')->with('student', $student);
    }

    function saveprofile(StudentRequests $request){
        $id = $request->session()->get('userid');

        DB::table('student')
              ->where('student_id', $id)
              ->update(['studentname'      => $request->name,
                        'studentemail'     => $request->email,
                        'studentmothername'=> $request->mothername,
                        'studentfathername'=> $request->fathername,
                        'guardiannumber'   => $request->phone,
                        'studentaddress'   => $request->address]);
        return redirect()->route('student.stprofile');
    }

}
