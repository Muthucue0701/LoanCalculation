@extends('layouts.default')
@section('title','Loan Management')
@section('main-content')
<div class="row" style="margin-top:10em;text-align:center; " >
    


<h1>Admin Login</h1>

<form method="post" action="{{ url('adminloginpass') }}" >
    @if (Session::has('success'))
        <p>{{ Session::get('success') }}</p>
    @endif
    @if (Session::has('fail'))
        <p>{{ Session::get('fail') }}</p>
    @endif
    <center>
    <table cellspacing="10" cellpadding="10">
        @csrf
        <tr>
            <th>Name</th>
            <td><input type="text" name="adminname" value="{{ old('adminname') }}" required></td>
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
</center>

</form>
</div>
@endsection