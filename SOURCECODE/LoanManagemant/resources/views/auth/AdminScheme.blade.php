
@extends('layouts.admin')
@section('title','Loan Management')
@section('main-content')
<div class="row" style="margin-top:10em;text-align:center; " >
<center>

<h1>View scheme</h1>
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

<div class="table-responsive">
<center>

    <table class="table">
        <thead>
            <tr>
                <th>Item no</th>
                <th>Load id</th>
                <th>Loan Name</th>
                <th>Interest Percentage</th>
        </thead>
        <tbody>
        @foreach($schemes as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->loan_name }}</td>
                <td>{{ $item->interest_percentage }} %</td>
                
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
@endif


</center>
@endsection