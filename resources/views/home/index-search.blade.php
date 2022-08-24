@extends('layouts.app-master')
@section('title', 'Home')

@section('content')
    <div class="min-vh-100">
        <p class="mt-5">Hasil Pencarian Untuk <b>{{ @$keyword }}</b></p>

        <div class="p-4 row justify-content-start">
            @foreach ($products as $product)
                <div class="col-auto">
                    <div class="card shadow mb-2" style="width: 18rem;" role="button">
                        <img class="card-img-top" onerror="this.onerror=null;this.src='{{ asset('assets/img/blank-image.png') }}';" src="{{ $product->foto }}" alt="foto-product" style="height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama }}</h5>
                            <p class="card-text">
                                {{ $product->keterangan }} <br>
                                <small>Rp{{ number_format($product->harga) }}</small>
                            </p>
                            <a href="javascript: void(0);" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
            @if (count($products) == 0)
                <p>Tidak Ditemukan Produk Dengan Kata Kunci Tersebut.</p>
            @endif
        </div>
    </div>
@endsection
