@extends('layout.StudentMain')

@section('studentcontent')
@section('title')
Gradesheet
@endsection
<script>
    function pdf(){
        var doc = new jsPDF();
var elementHTML = $('#contnet').html();
var specialElementHandlers = {
    '#elementH': function (element, renderer) {
        return true;
    }
};
//doc.fromHTML(elementHTML, 15, 15, {
    //'width': 170,
doc.fromHTML(elementHTML, 30, 30, {
    'width': 1000,
    'elementHandlers': specialElementHandlers
});

// Save the PDF
doc.save('gradesheet.pdf');
    }
</script>


<div class="row" id="contnet">
    <div class="col-12">
        <div class="card">
            <div class="card-body teacher_content">
                <h2>Gradesheet</h2>
                <h3>Exam:Final</h3>
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
                    <thead>
                        <tr style="background-color: #313a46; color: #ababab;">
                            <th>Subject</th>
                            <th>Attendance</th>
                            <th>Mid</th>
                            <th>Final</th>
                            <th>Total</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=0; $i != count($grade); $i++) 
                        <tr>
                            <td width="20%">{{$grade[$i]->subjectname}}</td>
                            <td width="20%">{{$grade[$i]->attendance}}</td>
                            <td width="20%">{{$grade[$i]->midmarks}}</td>
                            <td width="20%">{{$grade[$i]->finalmarks}}</td>
                            <td width="20%">{{$grade[$i]->total}}</td>
                            <td width="20%">{{$grade[$i]->finalgrade}}</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="elementH"></div>
<button class="btn btn btn-secondary" onclick="pdf();">pdf</button>
<a href="{{ url('grade_pdf/pdf') }}" class="btn btn-danger">PDF</a>
</div>
</div>
</div>
</div>
@endsection