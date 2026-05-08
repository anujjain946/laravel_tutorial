@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <h1>Welcome {{ $name }}</h1> 
<?php $age = 20;    ?> 
 @if($age > 18)
    <p>Adult</p>
@else
    <p>Minor</p>
@endif

<?php $users = ['Alice', 'Bob', 'Charlie']; ?>
@foreach($users as $user)
    <p>{{ $user }}</p>
@endforeach



@for($i = 0; $i < 5; $i++)
    <p>{{ $i }}</p>
@endfor

<x-alert type="success" message="Data Saved Successfully!" />

@endsection