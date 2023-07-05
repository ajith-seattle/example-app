@extends('layouts.app')  
@section('content')
<div class="container">
<div class="row justify-content-center">
 <div class="col-lg-10 margin-tb">
 <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('purchases.index') }}"> Back</a>
        </div>
 <div class="card">
    <div class="card-header">{{ __('Add New Purchases') }}</div>
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
   
<form action="{{ route('purchases.store') }}" method="POST" enctype="multipart/form-data" id="upload-file">
    @csrf
  
     <div class="row">
     <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Purchase Date:</strong>
                <div class="input-group date" id="datepicker">
                        <input type="text" name="purchase_date" class="form-control"  placeholder="Purchase Date" required>
                        <span class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Project Name:</strong>
                <select class="form-control" name="project_name" required>
                <option value="" selected>Select Project</option>
                @foreach ($projectnames as $item)
                <option value="{{ $item->id }}">{{ $item->project_name }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Project Location:</strong>
                <select class="form-control" name="project_location" required>
                <option value="" selected>Select Location</option>
                @foreach ($locationnames as $item)
                <option value="{{ $item->id }}">{{ $item->location_name }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>State:</strong>
                <select class="form-control" name="state" required>
                <option value="" selected>Select State</option>
                @foreach ($statenames as $statename)
                <option value="{{ $statename->id }}">{{ $statename->state_name }}</option>
                @endforeach
                </select>
            </div>
        </div>
    <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Sub Contractor:</strong>
                <select class="form-control" name="subcontractor" required>
                <option value="" selected>Select Sub Contractor</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
                </select>
            </div>
        </div>
       <!-- <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Product Name:</strong>
                <input type="text" name="product_name" class="form-control" placeholder="Product Name" required>
            </div>
        </div>-->
        
        
        
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Purchase Category:</strong>
                <select class="form-control" name="purchase_category" required>
                <option value="" selected>Select Purchase Category</option>
                @foreach ($purchasecategory as $item)
                <option value="{{ $item->id }}">{{ $item->purchase_category }}</option>
                @endforeach
                </select>
                <input type="hidden" name="userid" class="form-control" value="{{Auth::user()->id}}">

            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Total Amount:</strong>
                <input type="text" name="total_amount" class="form-control" placeholder="Total Amount" required>

            </div>
        
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Product Image:</strong>
                <input type="file" name="product_image" class="form-control" placeholder="Product Image" id="file">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>First Name</strong>
                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Last Name</strong>
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Email</strong>
                <input type="email" name="email" class="form-control" placeholder="Email" required>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3">
            <div class="form-group">
                <strong>Phone Number</strong>
                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>

            </div>
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

