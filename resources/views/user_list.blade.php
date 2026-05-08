
@extends('layouts.app')

@section('title', 'User List')

@section('content')
<div class="container">

@if(session('success'))
    <x-alert type="success" message=" {{ session('success') }}" />
@endif

@if(session('welcome'))
    <x-alert type="success" message=" {{ session('welcome') }}" />
@endif

<h1>Users</h1>
<!-- Add User Button -->
    <a href="{{ route('user.add') }}" style="float: right;">
      <button type="button" class="btn btn-primary">Add User</button>
    </a>
<table class="table">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th>Profile</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $key => $user)
    <tr>
      <th scope="row">{{ $key+1 }}</th>
      <td>
      <img src="{{ asset('uploads/users/'.$user->image) }}"
     width="100"></td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
         <a href="{{ route('user.edit', ['id' => $user->id]) }}">
            <button type="button" class="btn btn-info">Edit</button>
          </a>
           <a href="{{ route('user.delete', ['id' => $user->id]) }}">
            <button type="button" class="btn btn-danger">Delete</button>
          </a>
      </td>
    </tr>
    @endforeach

    
  </tbody>
</table>

</div>
@endsection