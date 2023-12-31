@extends('layouts.app')  
@section('content')
<div class="container create-content">
<div class="row ">
 <div class="col-lg-10 margin-tb">
 <div class="pull-right">
            <a class="btn btn-primary btn-reverse" href="{{ route('states.index') }}"> Back</a>
        </div>
 <div class="card">
    <div class="card-header">{{ __('Add New State') }}</div>
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
   
<form action="{{ route('states.store') }}" method="POST"  >
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>State Name:</strong>
                <input type="text" name="state_name" class="form-control" placeholder="Name">
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
