@extends('layouts.app-master')
@section('title', 'Form Product')

@section('content')
    <div class="card shadow my-3">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Form Product</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ @$product ? route('products.update', @$product->id) : route('products.store') }}" enctype="multipart/form-data">
                @if(@$product)
                    @method('PUT')
                @endif

                @csrf
                <div class="form-group mb-3">
                    <label for="foto"><small>Foto :</small></label> <br>
                    @if (@$product)
                        <img id="foto" class="mt-1 mb-2" onerror="this.onerror=null;this.src='{{ asset('assets/img/default-profile.jpg') }}';" src="{{ asset(@$product->foto) }}" alt="foto-profile" width="150">
                    @else
                        <img id="foto" class="mt-1 mb-2 d-none" src="" alt="foto-profile" width="150">
                    @endif
                    <input class="form-control" type="file" id="input-file" name="foto" accept="image/jpeg, image/png, image/jpg">
                    @if ($errors->has('foto'))
                        <span class="text-danger text-left">{{ $errors->first('foto') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="text" autofocus class="form-control" name="nama" value="{{ old('nama', @$product->nama) }}" placeholder="nama" required>
                    <label for="floatingName">Nama</label>
                    @if ($errors->has('nama'))
                        <span class="text-danger text-left">{{ $errors->first('nama') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan', @$product->keterangan) }}" placeholder="keterangan" required>
                    <label for="floatingName">Keterangan</label>
                    @if ($errors->has('keterangan'))
                        <span class="text-danger text-left">{{ $errors->first('keterangan') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="number" class="form-control" name="harga" value="{{ old('harga', @$product->harga) }}" placeholder="harga" required>
                    <label for="floatingName">Harga</label>
                    @if ($errors->has('harga'))
                        <span class="text-danger text-left">{{ $errors->first('harga') }}</span>
                    @endif
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="number" class="form-control" name="stok" value="{{ old('stok', @$product->stok) }}" placeholder="stok" required>
                    <label for="floatingName">Stok</label>
                    @if ($errors->has('stok'))
                        <span class="text-danger text-left">{{ $errors->first('stok') }}</span>
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
