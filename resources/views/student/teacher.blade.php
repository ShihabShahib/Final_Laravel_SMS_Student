@extends('layout.StudentMain')

@section('studentcontent')

@section('title')
Teachers
@endsection

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body teacher_content">
                <div class="row">
                    <div class=" col-sm-12 col-md-4">
                        <label>Search:</label>
                            <input id="teacher" type="text" placeholder="Enter Teacher name" class="form-control form-control-sm" aria-controls="basic-datatable">
                    </div>
                </div><br>
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
                    <thead>
                        <tr style="background-color: #313a46; color: #ababab;">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Designation</th>
                        </tr>
                    </thead>
                    <tbody id="searchteacher">
                    @for($i=0; $i != count($teacher); $i++)
                        <tr>
                            <td>{{$teacher[$i]->teachername}}</td>
                            <td>{{$teacher[$i]->teacheremail}}</td>
                            <td>{{$teacher[$i]->teacherdepartment}}</td>
                            <td>{{$teacher[$i]->teacherdesignation}}</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>


    @endsection