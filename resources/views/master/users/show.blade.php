@extends('layouts.admin-master')
@section('title', 'Detail User')

@section('content')
    <div class="min-vh-100 w-100">
        <div class="card shadow my-3">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title">Data User</h3>
                    </div>
                </div>
            </div>
            <div class="card-body overflow-auto">
                <div class="row">
                    <div class="col-12">
                        <label for="foto">Foto :</label> <br>
                        <img id="foto" class="mt-2 mb-3" onerror="this.onerror=null;this.src='{{ asset('assets/img/default-profile.jpg') }}';" src="{{ asset(@$user->foto) }}" alt="foto-profile" width="150">
                    </div>
                    <div class="col-md-6 col-sm-12 space-nowrap">
                        <label for="email">Email :</label>
                        <p id="email" class="">{{ @$user->email }}</p>
                    </div>
                    <div class="col-md-6 col-sm-12 space-nowrap">
                        <label for="username">Username :</label>
                        <p id="username" class="">{{ @$user->username }}</p>
                    </div>
                    <div class="col-md-12 col-sm-12 space-nowrap">
                        <label for="role">Role :</label>
                        <p id="role" class="text-capitalize">{{ @$user->role }}</p>
                    </div>
                    <div class="col-md-6 col-sm-12 space-nowrap">
                        <label for="created_at">Created At :</label>
                        <p id="created_at" class="">{{ @$user->created_at }}</p>
                    </div>
                    <div class="col-md-6 col-sm-12 space-nowrap">
                        <label for="updated_at">Updated At :</label>
                        <p id="updated_at" class="">{{ @$user->updated_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
