@extends('layouts.app-master')
@section('title', 'Home')

@section('header')
    <div class="mt-3">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/img/caro-1.jpg') }}" class="d-block w-100 vh-100 img-fit-cover" alt="gambar-slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/caro-2.jpg') }}" class="d-block w-100 vh-100 img-fit-cover" alt="gambar-slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/caro-3.png') }}" class="d-block w-100 vh-100 img-fit-cover" alt="gambar-slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endsection

@section('content')
    <h6 class="">All Product</h6>

    <div class="p-4 row justify-content-start">
        @foreach ($products as $product)
            <div class="col-auto">
                <div class="card shadow mb-2" style="width: 18rem;" role="button">
                    <img class="card-img-top" onerror="this.onerror=null;this.src='{{ asset('assets/img/blank-image.png') }}';" src="{{ $product->foto }}" alt="foto-product" style="height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama }}</h5>
                        <p class="card-text">
                            {{-- {{ $product->keterangan }} <br> --}}
                            <small>Rp{{ number_format($product->harga) }}</small>
                        </p>
                        <a href="javascript: void(0);" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
        @if (count($products) == 0)
            <p>Belum ada data produk.</p>
        @endif
    </div>
@endsection
