@extends('layouts.app')  
@section('content')
<div class="container create-content">
<div class="row ">
 <div class="col-lg-10 margin-tb">
 <div class="pull-right">
            <a class="btn btn-primary btn-reverse" href="{{ route('projects.index') }}"> Back</a>
        </div>
 <div class="card">
    <div class="card-header">{{ __('Add New Project') }}</div>
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
   
<form action="{{ route('projects.update',$project->id) }}" method="POST">
    @csrf
    @method('PUT')
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Project Name:</strong>
                <input type="text" name="project_name" class="form-control" placeholder="Project Name" value="{{$project->project_name}}" required>
                <input type="hidden" name="created_by" class="form-control" value="{{Auth::user()->id}}">

            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Sub Contractor:</strong>
                <select class="form-control" name="subcontractor" required >
                <option value="" selected>Select Sub Contractor</option>
                @foreach ($subcontractors as $item)
                <option value="{{ $item->id }}" {{ $project->subcontractor == $item->id  ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Location:</strong>
                <select class="form-control" name="location" required>
                <option value="" selected>Select Location</option>
                @foreach ($locationnames as $item)
                <option value="{{ $item->id }}" {{ $project->location == $item->id  ? 'selected' : '' }}>{{ $item->location_name }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>State:</strong>
                <select class="form-control" name="state" required>
                <option value="" selected>Select State</option>
                @foreach ($statenames as $item)
                <option value="{{ $item->id }}" {{ $project->state == $item->id  ? 'selected' : '' }}>{{ $item->state_name }}</option>
                @endforeach
                </select>
            </div>
        </div>
       
        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
            <div class="form-group">
                <strong>Project Details:</strong>
               <textarea name="project_details" class="form-control">{{$project->project_details}}</textarea>
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
