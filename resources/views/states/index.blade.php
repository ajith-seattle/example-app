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
        <div class="card-header">{{ __('State Management') }}</div>
        <div class="card-body">
            @if($states->isEmpty())
           
    No States Created. <a href="/states/create">Add a State</a>
    @else            
               
        <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($states as $state)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $state->state_name }}</td>
            <td>
                <form action="{{ route('states.destroy',$state->id) }}" method="POST">
   
    
                    <a class="btn btn-primary" href="{{ route('states.edit',$state->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger"  onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    @endif
                </div>
            </div>
           
        </div>
    </div>
   
   
   
   
</div>
@endsection