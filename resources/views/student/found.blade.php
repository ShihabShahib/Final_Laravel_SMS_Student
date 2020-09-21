@extends('layout.StudentMain')

@section('studentcontent')
@section('title')
Lost & Found
@endsection
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body teacher_content">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
                    <thead>
                        <tr style="background-color: #313a46; color: #ababab;">
                            <th>Item</th>
                            <th>Description</th>
                            <th>Lost Date</th>
                            <th>Found</th>
                            <th>Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=0; $i != count($found); $i++)
                        <tr>
                            <td>{{$found[$i]->lostname}}</td>
                            <td>{{$found[$i]->lostdescription}}</td>
                            <td>{{$found[$i]->lostday}}</td>
                            <td>{{$found[$i]->found}}</td>
                            <td>{{$found[$i]->received}}</td>
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