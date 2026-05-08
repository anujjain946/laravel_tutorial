@extends('layouts.app')

@section('title', 'User List')

@section('content')

<div class="fluid-container">
    <h2>User List</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add User Button -->
    <a href="{{ route('user.create') }}" style="margin-bottom:10px; display:inline-block;">
        Add New User
    </a>

    <!-- User Table -->
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <!-- Edit -->
                        {{-- <a href="{{ route('user.edit', $user->id) }}">Edit</a> --}}

                        <!-- Delete -->
                        {{-- <form action="{{ route('user.delete', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this user?')">
                                Delete
                            </button>
                        </form> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No Users Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
