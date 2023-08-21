@extends('layouts.app')  
   
@section('content')
<div class="container">
    <div class="row  right-content">
        <div class="col-lg-10 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary btn-reverse" href="{{ route('users.index') }}"> Back</a>
        </div>
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
  
            <div class="card">
             <div class="card-header">{{ __('Edit User') }}</div>
              <div class="card-body">
              <form action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">

                </div>
            </div>
            
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" class="form-control" placeholder="Password" value="{{ $user->password }}">
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Phone:</strong>
                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ $user->phone }}">
            </div>
        </div>
        @if ((Auth::user()->usertype)==1)
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Usertype:</strong>
                <select name="usertype" class="form-control" onchange="change_type()" id="team_id">
                    <option value="">Select User Type</option>
                    <option value="2" {{ $user->usertype == 2 ? 'selected' : '' }}>Company</option>
                    <option value="3" {{ $user->usertype == 3 ? 'selected' : '' }}>Sub-Contractor/End user</option>
                </select>
            </div>
        </div>
       
        @endif

       

        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Company:</strong>
                <select class="form-control" name="company_id" id="category">
                <option selected>Select Company</option>
                @foreach ($companynames as $item)
                <option value="{{ $item->id }}" {{ $user->company_id == $item->id ? 'selected' : '' }}>{{ $item->company_name }}</option>
                @endforeach
                </select>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
    <div class="form-group">
        <strong>Company Logo:</strong>
        <input type="file" name="company_logo_new" class="form-control" placeholder="Choose file">
        @if ($user->company)
            <input type="hidden" name="company_logo" value="{{ $user->company->company_logo }}" />
            <img src="{{ url('/') }}/{{$user->company->company_logo}}" width="100"/>
        @endif
        @error('company_logo_new')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
</div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
   
    </form>
              
   
  
    
    </div>
@endsection


