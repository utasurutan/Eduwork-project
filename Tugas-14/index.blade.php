@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <h2>Daftar Produk</h2>

    @if($products->count() > 0)
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:20px; margin-top:20px;">
            @foreach($products as $product)
                <div style="background:#16205c; border-radius:8px; padding:15px;">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/220x150?text=No+Image' }}"
                         alt="{{ $product->name }}"
                         style="width:100%; height:150px; object-fit:cover; border-radius:6px;">

                    <h3 style="margin:12px 0 5px;">{{ $product->name }}</h3>
                    <p style="font-size:13px; color:#c5cae9; margin:0 0 8px;">{{ $product->category->name ?? '-' }}</p>
                    <p style="font-weight:bold; color:#f2c94c; margin:0 0 12px;">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" style="width:100%; background:#6fcf97; color:#0f1745; border:none; padding:8px; border-radius:5px; font-weight:bold; cursor:pointer;">
                            + Keranjang
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <div style="margin-top:30px; color:#0f1745;">
            {{ $products->links() }}
        </div>
    @else
        <p style="color:#ffd166;">Belum ada produk yang tersedia.</p>
    @endif
@endsection
