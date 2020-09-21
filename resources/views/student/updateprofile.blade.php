@extends('layout.StudentMain')

@section('studentcontent')

@section('title')
Manage Profile
@endsection
<div class="row">
    <div id = "profile_content" class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="row justify-content-md-center">
    <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Update Profile</h4>
                <form method="POST" class="col-12 " action="{{route('student.updateprofile')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="col-12">
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="name"> Name</label>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" class="form-control"  value="{{$student->studentname}}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="email">Email</label>
                            <div class="col-md-9">
                                <input type="email" id="email" name="email" class="form-control"  value="{{$student->studentemail}}" required>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="fathername">Father Name</label>
                            <div class="col-md-9">
                                <input type="text" id="name" name="fathername" class="form-control"  value="{{$student->studentfathername}}" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="mothername"> Mother Name</label>
                            <div class="col-md-9">
                                <input type="text" id="name" name="mothername" class="form-control"  value="{{$student->studentmothername}}" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="phone"> Phone</label>
                            <div class="col-md-9">
                                <input type="text" id="phone" name="phone" class="form-control"  value="{{$student->guardiannumber}}"required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3 col-form-label" for="address"> Address</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="address" name = "address" rows="5" value="{{$student->studentaddress}}">{{$student->studentaddress}}</textarea>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-secondary col-xl-4 col-lg-4 col-md-12 col-sm-12">Update Profile</button>
                        </div>
                    </div>
                    
                </form>@foreach($errors->all() as $err)
                        {{$err}} <br>
                    @endforeach
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div>

</div>
    </div>
</div>
                   <!-- END PLACE PAGE CONTENT HERE -->
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>

    @endsection