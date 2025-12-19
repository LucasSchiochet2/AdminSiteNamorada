@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
@include('users.parts.basic-details')
<br>
@include('users.parts.profile')
<br>
@include('users.parts.interest')
<br>
@include('users.parts.roles')
@endsection
