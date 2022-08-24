@extends('layouts.admin-master')
@section('title', 'Home')

@section('content')
    <div class="min-vh-100 w-100">
        <div class="bg-light p-4 rounded">
            <h1>Dashboard</h1>
            <h4>Welcome {{ Auth::user()->username }}</h4>
            <small>Ini adalah halaman admin</small>
        </div>
    </div>
@endsection
