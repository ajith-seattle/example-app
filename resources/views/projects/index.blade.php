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
        <div class="card-header">{{ __('Project Management') }}</div>
        <div class="card-body">
            @if($projects->isEmpty())
           
    No Projects Created. <a href="/projects/create">Add a Project</a>
    @else            
               
        <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Project</th>
            <th>Sub Contractor</th>
            <th>Location</th>
            <th>State</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($projects as $project)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $project->project_name }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->location_name }}</td>
            <td>{{ $project->state_name }}</td>
            <td>
                <form action="{{ route('projects.destroy',$project->id) }}" method="POST">
   
    
                    <a class="btn btn-primary" href="{{ route('projects.edit',$project->id) }}">Edit</a>
   
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