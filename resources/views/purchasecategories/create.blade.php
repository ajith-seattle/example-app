@extends('layouts.app')  
@section('content')
<div class="container">
<div class="row justify-content-center">
 <div class="col-lg-10 margin-tb">
 <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back</a>
        </div>
 <div class="card">
    <div class="card-header">{{ __('Add New Purchase Category') }}</div>
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
   
<form action="{{ route('purchasecategories.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
            <div class="form-group">
                <strong>Purchase Category Name:</strong>
                <input type="text" name="purchase_category" class="form-control" placeholder="Purchase Category Name" required>

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
