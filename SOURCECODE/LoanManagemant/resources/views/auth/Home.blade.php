@extends('layouts.default')
@section('title','Loan Management ')
@section('main-content')

<div class="row" style="margin-top:10em;text-align:center; " >
    <h1>Loan Management</h1>
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
</div>
@endsection