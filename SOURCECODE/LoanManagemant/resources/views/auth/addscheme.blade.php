@extends('layouts.admin')
@section('title','Loan Management')
@section('main-content')
<div class="row" style="margin-top:10em;text-align:center; " >
<center>

<h1>Add scheme</h1>
<center>
<form method="post" action="{{ url('storescheme') }}">
        @csrf
        @if (Session::has('success'))
            <p>{{ Session::get('success') }}</p>
        @endif
        @if (Session::has('fail'))
            <p>{{ Session::get('fail') }}</p>
        @endif
        <table cellspacing="10" cellpadding="10">
            <tr>
                <th>Loan Name</th>
                <td><input type="text" name="loan_name" placeholder="Loan Name" required></td>
                <td>@error('name'){{ $message }}@enderror</td>
            </tr>
            <tr>
                <th>Interest Percentage</th>
                <td><input type="text" name="interest_percentage" placeholder="Interest Percentage" required></td> <!-- Change 'mail' to 'email' for consistency -->
                <td>@error('email'){{ $message }}@enderror</td>
            </tr>
            
            <tr>
                <th><input type="reset" class="btn btn-danger" value="CLEAR"></th>
                <th><input type="submit" class="btn btn-success" value="ADD SCHEME"></th>
            
            </tr>
        </table>
    </form>
</center>
@endsection