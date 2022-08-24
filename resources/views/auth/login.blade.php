@extends('layouts.app-master', ['no_margin_top' => 'true'])
@section('title', 'Login')

@section('content')
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <h2 class="mb-3 w-100 text-center">
                    LOGIN
                </h2>
                <div class="card shadow rounded p-2 px-4">
                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('login.perform') }}" novalidate>
                            @csrf
                            <div class="col-12">
                                <label for="validationCustomEmail" class="form-label">Email Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" id="validationCustomEmail" aria-describedby="inputGroupPrepend" required autofocus>
                                    <div class="invalid-feedback">
                                        Please provide a valid email.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="validationCustom03" class="form-label">Password</label>
                                <input type="password" pattern=".{8,}" class="form-control" id="validationCustom03" name="password" required>
                                <div class="invalid-feedback">
                                    Please provide a valid password. <br>
                                    Minimum 8 characters.
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary" type="submit">Login</button>
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
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endpush
