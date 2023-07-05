@extends('layouts.app')
 
@section('content')
<div class="container">

     <div class="row justify-content-center">
        <div class="col-lg-10 margin-tb">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
       <!-- <div class="pull-right">
                <a class="btn btn-success" href="{{ route('companies.create') }}"> Create New Company</a>
        </div>-->
        <div class="card">
        <div class="card-header">{{ __('Company Management') }}</div>
        <div class="card-body">
        <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Logo</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($companies as $company)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $company->company_name }}</td>
            <td><img src="{{ $company->company_logo }}" width="100"></td>
            <td>
                <form action="{{ route('companies.destroy',$company->id) }}" method="POST">
   
    
                    <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger"  onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
                </div>
            </div>
           
        </div>
    </div>
   
   
   
   
    {!! $companies->links() !!}
</div>
@endsection