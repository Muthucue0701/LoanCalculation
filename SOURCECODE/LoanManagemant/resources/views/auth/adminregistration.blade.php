@extends('layouts.default')
@section('title','Loan Management')
@section('main-content')
<div class="row" style="margin-top:10em;text-align:center; " >
    

    <h1>Admin Registration</h1>
    <center>
    <form method="post" action="{{ url('storeadmin') }}">
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
                <td><input type="text" name="adminname" required></td>
                <td>@error('name'){{ $message }}@enderror</td>
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
@endsection
