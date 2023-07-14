@extends('layouts.app')

@section('content')
    <div class="container">
 <form action="{{ route('userroles.updateRoleConnect') }}" method="POST">

            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name with Checkbox</th>
                    </tr>
                </thead>
                <tbody>
    @foreach ($userRoles as $userRole)
        <tr>
            <td>{{ $userRole->id }}</td>
            <td>
                <label>
                    <input type="checkbox" name="userRoleIds[]" value="{{ $userRole->id }}" {{ in_array($userRole->id, $userRoleIds) ? 'checked' : '' }}>
                    {{ $userRole->name }}
                </label>
            </td>
        </tr>
    @endforeach
</tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
