@extends('layouts.default')
@section('title','Loan Management')
@section('main-content')
<div class="row" style="margin-top:10em;text-align:center; " >
    <h1>User Registration</h1>

    <center>
    <form method="post" action="{{ url('store') }}">
        @csrf
        @if (Session::has('success'))
            <p>{{ Session::get('success') }}</p>
        @endif
        @if (Session::has('fail'))
            <p>{{ Session::get('fail') }}</p>
        @endif
        <table cellspacing="10" cellpadding="10">
            <tr>
                <th>Name</th>
                <td><input type="text" name="username" required></td>
                <td>@error('name'){{ $message }}@enderror</td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="text" name="email" required></td> <!-- Change 'mail' to 'email' for consistency -->
                <td>@error('email'){{ $message }}@enderror</td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" name="password" required></td> <!-- Change input type to 'password' for security -->
                <td>@error('password'){{ $message }}@enderror</td>
            </tr>
            <tr>
            <th><input type="reset" class="btn btn-danger" value="CLEAR"></th>
            <th><input type="submit" class="btn btn-success" value="REGISTER"></th>
            </tr>
        </table>
    </form>
    
</center>
    <p><a href='LOGIN'>Already Registered!! Login here</a></p>
@endsection
