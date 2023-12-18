@extends('layouts.user')
@section('title','Loan Management')
@section('main-content')
<div class="row" style="margin-top:10em;text-align:center; " >
<h1 style="color:white;">Loan Management</h1>

@if(isset($data['id']))
    <p style="color:white;">Welcome, {{ $data['username'] }}! Your user Id is {{ $data['id'] }}.</p>
    @else
    <p>Welcome to the dashboard.</p>
@endif
@if(isset($message))
        <div class="alert alert-info">
            {{ $message }}
        </div>
    @else
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

<table class="table">
        <thead>
            <tr>
                <th>Load id</th>
                <th>Loan Name</th>
                <th>Interest Percentage</th>
        </thead>
        <tbody>
        @foreach($schemes as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->loan_name }}</td>
                <td>{{ $item->interest_percentage }}</td>
                
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif

    <br>
    <form method="post" action="{{ url('calculateInterest') }}" >
    @csrf
    <center>

    <form method="post" action="{{ url('calculateInterest') }}">
    @csrf
    <center>
        <table cellspacing="10" cellpadding="10" bgcolor="#DBF1A0" width="80%">
            <tr>
                <th>Loan Amount</th>
                <td><input type="text" name="Amount" placeholder="Loan Amount" value="{{ old('Amount') }}" required></td>
            </tr>
            <tr>
                <th>Year</th>
                <td><input type="text" name="Year" placeholder="Year" value="{{ old('Year') }}" required></td>
            </tr>
            <tr>
                <th><input type="reset" class="btn btn-danger" value="CLEAR"></th>
                <th><input type="submit" class="btn btn-success" value="CALCULATE INTEREST"></th>
            </tr>
        </table>
        <br>
    </center>
</form>
@if(isset($message))
        <div class="alert alert-info">
            {{ $message }}
        </div>
    @else
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

@if(isset($calculatedInterest))
        <table class="table">
            <thead>
                <tr>
                    <th>Loan Name</th>
                    <th>Interest Percentage</th>
                    <th>Calculated Interest Amount</th>
                    <th>EMI for {{ $y[$item->id] ?? 'N/A' }} year</th>
                    <th>Total Amount To Pay</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schemes as $item)
                    <tr>
                        <td>{{ $item->loan_name }}</td>
                        <td>{{ $item->interest_percentage }}</td>
                        {{-- Calculate interest for the current scheme --}}
                        @if(isset($calculatedInterest[$item->id]))
                            <td>{{ $calculatedInterest[$item->id] }}</td>
                            <td>{{ $emi[$item->id] ?? 'N/A' }}</td>
                            <td>{{ $tot[$item->id] ?? 'N/A' }}</td>

                        @else
                            <td>N/A</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
                @endif

    @endif

@endsection