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
                    @foreach ( $roleConnects as  $roleConnect)
                        <tr>
                            <td>{{ $userRole->id }}</td>
                            <td>
                                <label>
                                <input type="checkbox" name="userRoleIds[]" value="{{ $userRole->id }}" {{ $userRole->id == $roleConnect->userrole_id ? 'checked' : '' }}>

                                    {{ $userRole->name }}
                                </label>
                            </td>
                        </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
