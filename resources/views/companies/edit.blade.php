@extends('layouts.app')  
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
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
             <div class="card-header">{{ __('Edit Company') }}</div>
              <div class="card-body">
              <form action="{{ route('companies.update',$company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   
         <div class="row">
           
            
       
      

        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Company Name:</strong>
                <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="{{ $company->company_name }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3" >
            <div class="form-group">
                <strong>Company Logo:</strong>
          <input type="hidden" name="company_logo" value="{{$company->company_logo }}" />
                <input type="file" name="company_logo_new" class="form-control" placeholder="Choose file" id="file" value="{{ $company->company_logo }}">
                <img src="{{ url('/') }}/{{$company->company_logo}}" width="100"/>
      
                @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror            </div>
        </div>


     
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
   
    </form>
              
   
  
    
    </div>
@endsection

