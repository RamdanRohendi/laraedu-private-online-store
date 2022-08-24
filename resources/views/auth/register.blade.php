@extends('layouts.app-master', ['no_margin_top' => 'true'])
@section('title', 'Register')

@push('styles')
    <style>
        .pass-invalid {
            border-color: #dc3545 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e") !important;
        }
    </style>
@endpush

@section('content')
    <div class="container min-vh-100 pb-4 mt-5 pt-3 d-flex align-items-center justify-content-center">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <h2 class="mb-3 w-100 text-center">
                    REGISTER
                </h2>
                <div class="card shadow rounded p-2 px-4">
                    <div class="card-body">
                        <form class="row g-3 needs-validation" action="{{ route('register.perform') }}" method="post" novalidate>
                            @csrf
                            <div class="col-12">
                                <label for="validationCustomEmail" class="form-label">Email Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" class="form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="validationCustomEmail" aria-describedby="inputGroupPrepend" required autofocus>
                                    <div class="invalid-feedback">
                                        Please provide a valid email.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="validationCustomUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="validationCustomUsername" required>
                                <div class="invalid-feedback">
                                    Please insert username.
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="validationCustomPassword" class="form-label">Password</label>
                                <input type="password" class="form-control pass-same" name="password" pattern=".{8,}" id="validationCustomPassword" required>
                                <div class="invalid-feedback">
                                    Please provide a valid password. <br>
                                    Minimum 8 characters.
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="validationCustomConfirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control pass-same" name="password_confirmation" pattern=".{8,}" id="validationCustomConfirmPassword" required>
                                <div class="invalid-feedback">
                                    Please provide a valid password. <br>
                                    Minimum 8 characters. <br>
                                    Password must match.
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
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

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    var inPass1 = form.querySelectorAll('.pass-same')[0];
                    var inPass2 = form.querySelectorAll('.pass-same')[1];
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
                            inPass2.classList.add('is-invalid');
                            inPass2.classList.add('pass-invalid');
                        }
                        event.preventDefault()
                        event.stopPropagation()
                    }


                    if (!passValid) {
                        inPass2.classList.add('pass-invalid');
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endpush
