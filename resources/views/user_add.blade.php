@extends('layouts.app')

@section('title')

    {{ isset($user) ? 'Edit User' : 'Add User' }}

@endsection

@section('content')

<div class="container">

    <h1>
        {{ isset($user) ? 'Edit User' : 'Add User' }}
    </h1>

    <form action="{{ isset($user)
            ? route('user.update', ['id' => $user->id])
            : route('user.create') }}"
          method="POST" enctype="multipart/form-data">

        @csrf

        

        <div class="form-group">

             @if(isset($user) && $user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" width="100"> 
            @else
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @error('image')

                <span style="color:red;">
                    {{ $message }}
                </span>
            @endif
             @enderror

        </div>
<div class="form-group">

            <label>Name</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $user->name ?? '') }}">

            @error('name')

                <span style="color:red;">
                    {{ $message }}
                </span>

            @enderror

        </div>

        <br>

        <div class="form-group">

            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $user->email ?? '') }}">

            @error('email')

                <span style="color:red;">
                    {{ $message }}
                </span>

            @enderror

        </div>

        <br>

@empty($user)

<div class="form-group">

    <label>Password</label>

    <input type="password"
           name="password"
           class="form-control">

    @error('password')

        <span style="color:red;">
            {{ $message }}
        </span>

    @enderror

</div>

<br>

@endempty

        <button type="submit"
                class="btn btn-primary">

            {{ isset($user) ? 'Update User' : 'Add User' }}

        </button>

    </form>

</div>

@endsection