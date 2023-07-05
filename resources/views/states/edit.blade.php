@extends('layouts.app')  
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('states.index') }}"> Back</a>
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
             <div class="card-header">{{ __('Edit State') }}</div>
              <div class="card-body">
              <form action="{{ route('states.update',$state->id) }}" method="POST" >
        @csrf
        @method('PUT')
   
         <div class="row">
           
            
       
      

        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>State Name:</strong>
                <input type="text" name="state_name" class="form-control" placeholder="State Name" value="{{ $state->state_name }}">
            </div>
        </div>
        


     
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
   
    </form>
              
   
  
    
    </div>
@endsection

