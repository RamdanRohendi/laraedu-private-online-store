@extends('layouts.admin-master')
@section('title', 'Users')

@section('content')
    <div class="min-vh-100 w-100">
        <div class="card shadow my-3">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title">Users</h3>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('users.create') }}" class="btn btn-primary space-nowrap">
                            Add User
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table id="table-user" class="table table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let table_user = $('#table-user');

            table_user.DataTable({
                processing: true,
                serverSide: true,
                order: [2, 'asc'],
                ajax: '{{ route('users.data') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'foto', name: 'foto', orderable: false, searchable: false },
                    { data: 'username', name: 'username' },
                    { data: 'role', name: 'role' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                fnDrawCallback: function(oSettings) {
                    table_user.parent().addClass('overflow-auto');
                }
            });

            $(document).on('click', '.btn-delete', function(e){
                e.preventDefault();

                let url = $(this).attr('href');
                let csrf = $(this).data('csrf');
                let confirm = window.confirm('Are you sure you want to delete this user?');

                if (confirm) {
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        data: {
                            _token: csrf
                        },
                        success: function(response) {
                            toastLive.classList.add('bg-success');
                            toastMessage.innerHTML = response.message;
                            toast.show();
                            table_user.DataTable().ajax.reload();
                        },
                        error: function(response) {
                            toastLive.classList.add('bg-danger');
                            toastMessage.innerHTML = response.message;
                            toast.show();
                        }
                    });
                }
            });
        });
    </script>
@endpush
