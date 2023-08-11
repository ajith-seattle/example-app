@extends('layouts.app')  
@section('content')
<div class="container create-content">
<div class="row  right-content">
 <div class="col-lg-10 margin-tb">
 <div class="pull-right">
            <a class="btn btn-primary btn-reverse" href="{{ route('users.index') }}"> Back</a>
        </div>
 <div class="card">
    <div class="card-header">{{ __('Add New User') }}</div>
    <div class="card-body">
    @if ($errors->any())
    <div class="alert alert-danger">
        There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('users.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Phone:</strong>
                <input type="text" name="phone" class="form-control" placeholder="Phone">
            </div>
        </div>
        @if ((Auth::user()->usertype)==1)
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Usertype:</strong>
                <select name="usertype" class="form-control" onchange="change_type()" id="team_id">
                    <option value="">Select User Type</option>
                    <option value="2">Company</option>
                    <option value="3">Sub-Contractor/End user</option>
                    <option value="4">Employee</option>
                </select>
            </div>
        </div>
        
        @endif
       <!-- <div class="row" id="toshow">
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Company Name:</strong>
                <input type="text" name="company_name" class="form-control" placeholder="Company Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3" >
            <div class="form-group">
                <strong>Company Logo:</strong>
                <input type="text" name="company_logo" class="form-control" placeholder="Company Logo">
            </div>
        </div>
</div>-->
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Company:</strong>
                <select class="form-control" name="company_id" id="category">
                <option selected>Select Company</option>
                @foreach ($companynames as $item)
                <option value="{{ $item->id }}">{{ $item->company_name }}</option>
                @endforeach
                </select>
            </div>
        </div>
<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
    </div>
 </div>
 </div>
 </div>

   

   

@endsection
<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
   
    $("select#team_id").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
          if(optionValue == 2){
          $("#toshow").show();
          $("#companylist").hide();
        }else if(optionValue == 3)
        {
          $("#toshow").hide();
          $("#companylist").show();
          
        }
        else{
            $("#toshow").hide();
          $("#companylist").hide();
        }
        });
    }).change();
});
</script>
-->