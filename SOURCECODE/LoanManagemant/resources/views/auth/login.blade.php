@extends('layouts.default')
@section('title','Loan Management ')
@section('main-content')
<div class="row" style="margin-top:10em;text-align:center; " >
<h1>User Login</h1>
<center>
<form method="post" action="{{ url('UserLogin') }}" >
    @if (Session::has('success'))
        <p>{{ Session::get('success') }}</p>
    @endif
    @if (Session::has('fail'))
        <p>{{ Session::get('fail') }}</p>
    @endif
    <table cellspacing="10" cellpadding="10">
        @csrf
        <tr>
            <th>User Name</th>
            <td><input type="text" name="username" value="{{ old('username') }}" required></td>
        </tr>
        <tr>
            <th>Password</th>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <th><input type="reset" class="btn btn-danger" value="CLEAR"></th>
            <th><input type="submit" class="btn btn-success" value="LOGIN"></th>
            </tr>
    </table>
</form>

</center>
</div>
@endsection