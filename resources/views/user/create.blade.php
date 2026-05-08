@extends('layouts.app')

@section('title', 'User Page')

@section('content')

<div class="container">
    <h1>Create User</h1>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <!-- Name -->
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name">
        @error('name')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <!-- Email -->
        <input type="email" class="form-control" name ="email" value="{{ old('email') }}" placeholder="Enter Email">
        @error('email')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <!-- Password -->
        <input type="password" class="form-control" name="password" placeholder="Enter Password">
        @error('password')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection