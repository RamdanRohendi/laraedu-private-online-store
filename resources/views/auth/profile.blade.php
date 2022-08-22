@extends('layouts.app-master')
@section('title', 'My Profile')

@push('styles')
    <style>
        .pass-invalid {
            border-color: #dc3545 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e") !important;
        }
    </style>
@endpush

@section('content')
    <div class="py-3">
        <div class="card shadow">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title">My Profile</h3>
                    </div>
                </div>
            </div>
            <div class="card-body overflow-auto">
                <div class="row">
                    <div class="col-12 space-nowrap">
                        <div class="row">
                            <div class="col-12">
                                <label for="foto">Foto :</label> <br>
                            </div>
                            <div class="col-auto">
                                <img id="foto" class="mt-1 mb-2" onerror="this.onerror=null;this.src='{{ asset('assets/img/default-profile.jpg') }}';" src="{{ asset(@$user->foto) }}" alt="foto-profile" width="150">
                            </div>
                            <div class="col py-3">
                                <form class="mb-3" action="{{ route('user.profile.update-foto') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input class="form-control" type="file" id="input-file" name="foto" accept="image/jpeg, image/png, image/jpg" required>
                                    <button class="btn btn-primary mt-1" type="submit">Ubah Foto</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 space-nowrap">
                        <label for="email">Email :</label>
                        <p id="email" class="">{{ @$user->email }}</p>
                    </div>
                    <div class="col-md-6 col-sm-12 space-nowrap">
                        <label for="username">Username :</label>
                        <p id="username" class="">{{ @$user->username }}</p>
                    </div>
                    <div class="col-12 space-nowrap">
                        <label for="created_at">Created At :</label>
                        <p id="created_at" class="">{{ @$user->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title">Update Password</h3>
                    </div>
                </div>
            </div>
            <div class="card-body overflow-auto">
                <form class="row g-3 needs-validation" action="{{ route('user.profile.update-password') }}" method="post" novalidate>
                    @csrf
                    <div class="col-12">
                        <label for="validationCustomPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control pass-same" name="password" pattern=".{8,}" id="validationCustomPassword" required>
                        <div class="invalid-feedback">
                            Please provide a valid password. <br>
                            Minimum 8 characters.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="validationCustomConfirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control pass-same" name="password_confirmation" pattern=".{8,}" id="validationCustomConfirmPassword" required>
                        <div class="invalid-feedback">
                            Please provide a valid password. <br>
                            Minimum 8 characters. <br>
                            Password must match.
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow mt-4">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title">Delete Akun</h3>
                    </div>
                </div>
            </div>
            <div class="card-body overflow-auto">
                <form id="delete-form" action="{{ route('user.profile.delete') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        var deleteForm = document.getElementById('delete-form')
        var inputFile = document.getElementById('input-file')

        inputFile.addEventListener('change', function () {
            let file = this.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let img = document.getElementById('foto');
                    img.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        });

        deleteForm.addEventListener('submit', function (event) {
            var confirmation = confirm('Are you sure you want to delete account? \nThis action cannot be undone.')

            if (confirmation) {
                var textConfirmation = prompt('Please type "DELETE MY ACCOUNT" to confirm.')

                if (textConfirmation === 'DELETE MY ACCOUNT') {
                    return true
                } else {
                    event.preventDefault()
                    event.stopPropagation()
                    alert('You have cancelled the deletion.')

                    return false
                }
            }

            event.preventDefault()
            event.stopPropagation()

            return false
        })

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    var inPass1 = form.querySelectorAll('.pass-same')[0]
                    var inPass2 = form.querySelectorAll('.pass-same')[1]
                    var passValid = inPass1.value === inPass2.value;
                    inPass2.classList.remove('pass-invalid');
                    inPass2.classList.remove('is-invalid');

                    inPass2.addEventListener('keyup', function (e) {
                        if (e.target.value !== inPass1.value) {
                            inPass2.classList.add('pass-invalid')
                            inPass2.classList.add('is-invalid')
                        } else {
                            inPass2.classList.remove('pass-invalid')
                            inPass2.classList.remove('is-invalid')
                        }
                    })

                    if (!form.checkValidity() || !passValid) {
                        if (!passValid) {
                            inPass2.classList.add('is-invalid')
                            inPass2.classList.add('pass-invalid')
                        }
                        event.preventDefault()
                        event.stopPropagation()
                    }


                    if (!passValid) {
                        inPass2.classList.add('pass-invalid')
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endpush
