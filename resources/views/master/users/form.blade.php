@extends('layouts.app-master')
@section('title', 'Form User')

@section('content')
    <div class="card shadow my-3">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Form User</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ @$user ? route('users.update', @$user->id) : route('users.store') }}" enctype="multipart/form-data">
                @if(@$user)
                    @method('PUT')
                @endif

                @csrf
                <div class="form-group mb-3">
                    <label for="foto"><small>Foto :</small></label> <br>
                    @if (@$user)
                        <img id="foto" class="mt-1 mb-2" onerror="this.onerror=null;this.src='{{ asset('assets/img/default-profile.jpg') }}';" src="{{ asset(@$user->foto) }}" alt="foto-profile" width="150">
                    @else
                        <img id="foto" class="mt-1 mb-2 d-none" src="" alt="foto-profile" width="150">
                    @endif
                    <input class="form-control" type="file" id="input-file" name="foto" accept="image/jpeg, image/png, image/jpg">
                    @if ($errors->has('foto'))
                        <span class="text-danger text-left">{{ $errors->first('foto') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="email" class="form-control" {{ @$user ? '' : 'autofocus' }} name="email" value="{{ old('email', @$user->email) }}" placeholder="name@example.com" required="required">
                    <label for="floatingEmail">Email address</label>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control" name="username" value="{{ old('username', @$user->username) }}" placeholder="Username" required>
                    <label for="floatingName">Username</label>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="role"><small>Role :</small></label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">Select Role</option>
                        <option value="admin" {{ old('role', @$user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', @$user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" {{ @$user ? '' : 'required' }}>
                    <label for="floatingPassword">Password</label>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" {{ @$user ? '' : 'required' }}>
                    <label for="floatingConfirmPassword">Confirm Password</label>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <div class="text-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            'use strict'

            var inputFile = document.getElementById('input-file')

            inputFile.addEventListener('change', function () {
                let file = this.files[0];

                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        let img = document.getElementById('foto');
                        img.src = e.target.result;
                        img.classList.remove('d-none');
                    };

                    reader.readAsDataURL(file);
                }
            });
        })();
    </script>
@endpush
