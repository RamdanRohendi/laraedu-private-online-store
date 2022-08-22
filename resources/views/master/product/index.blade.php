@extends('layouts.app-master')
@section('title', 'Products')

@section('content')
    <div class="vh-100">
        <div class="card shadow my-3">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title">Products</h3>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('products.create') }}" class="btn btn-primary space-nowrap">
                            Add Product
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table id="table-products" class="table table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Harga</th>
                            <th>Stok</th>
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
            let table_product = $('#table-products');

            table_product.DataTable({
                processing: true,
                serverSide: true,
                order: [2, 'asc'],
                ajax: '{{ route('products.data') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'foto', name: 'foto', orderable: false, searchable: false },
                    { data: 'nama', name: 'nama' },
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'harga', name: 'harga' },
                    { data: 'stok', name: 'stok' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $(document).on('click', '.btn-delete', function(e){
                e.preventDefault();

                let url = $(this).attr('href');
                let csrf = $(this).data('csrf');
                let confirm = window.confirm('Are you sure you want to delete this product?');

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
                            table_product.DataTable().ajax.reload();
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
