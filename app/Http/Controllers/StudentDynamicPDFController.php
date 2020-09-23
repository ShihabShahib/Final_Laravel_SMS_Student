<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class StudentDynamicPDFController extends Controller
{
    /*function index()
    {
        
     $routine_data = $this->get_routine_data();
     return view('dynamic_pdf')->with('routine_data', $routine_data);
    }*/

    function get_routine_data()
    {
        $class = session('class');
        $section = session('section');
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
        return [$saturday, $sunday, $monday, $tuesday, $wednesday, $thursday];
    }
    function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_routine_data_to_html());
        //return $pdf->stream();
        return $pdf->download('classroutine.pdf');
    }

    function convert_routine_data_to_html()
    {
        $routine_data = $this->get_routine_data();
        $saturday = $routine_data[0];
        $sunday = $routine_data[1];
        $monday = $routine_data[2];
        $tuesday = $routine_data[3];
        $wednesday = $routine_data[4];
        $thursday = $routine_data[5];
        $output = '
        <h3 align="center">Class Routine</h3>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
            <th style="border: 1px solid; padding:12px;" width="4%">Day/Time</th>
            <th style="border: 1px solid; padding:12px;" >9AM-10AM</th>
            <th style="border: 1px solid; padding:12px;" >10AM-11AM</th>
            <th style="border: 1px solid; padding:12px;" >11AM-12PM</th>
            <th style="border: 1px solid; padding:12px;" >1PM-2PM</th>
        </tr>
        <tr>
            <td style="border: 1px solid; padding:12px;">Saturday</td>';  
        foreach($saturday as $routine)
        {
        $output .= '
            <td style="border: 1px solid; padding:12px;"><b>Subject: </b>'.$routine->subjectname.'<br>
            <b>Teacher: </b>'.$routine->teachername.'</td>';
        }
        $output .= '</tr>
        <tr>
            <td style="border: 1px solid; padding:12px;">Sunday</td>';
        foreach($sunday as $routine)
        {
        $output .= '
            <td style="border: 1px solid; padding:12px;"><b>Subject: </b>'.$routine->subjectname.'<br>
            <b>Teacher: </b>'.$routine->teachername.'</td>';
        }
        $output .= '</tr>
        <tr>
            <td style="border: 1px solid; padding:12px;">Monday</td>';  
        foreach($monday as $routine)
        {
        $output .= '
            <td style="border: 1px solid; padding:12px;"><b>Subject: </b>'.$routine->subjectname.'<br>
            <b>Teacher: </b>'.$routine->teachername.'</td>';
        }
        $output .= '</tr>
        <tr>
            <td style="border: 1px solid; padding:12px;">Tuesday</td>';  
        foreach($tuesday as $routine)
        {
        $output .= '
            <td style="border: 1px solid; padding:12px;"><b>Subject: </b>'.$routine->subjectname.'<br>
            <b>Teacher: </b>'.$routine->teachername.'</td>';
        }
        $output .= '</tr>
        <tr>
            <td style="border: 1px solid; padding:12px;">Wednesday</td>';  
        foreach($wednesday as $routine)
        {
        $output .= '
            <td style="border: 1px solid; padding:12px;"><b>Subject: </b>'.$routine->subjectname.'<br>
            <b>Teacher: </b>'.$routine->teachername.'</td>';
        }
        $output .= '</tr>
        <tr>
            <td style="border: 1px solid; padding:12px;">Thursday</td>';  
        foreach($thursday as $routine)
        {
        $output .= '
            <td style="border: 1px solid; padding:12px;"><b>Subject: </b>'.$routine->subjectname.'<br>
            <b>Teacher: </b>'.$routine->teachername.'</td>';
        }
        $output .= '</tr>
        </table>';
            return $output;
    }

}
