@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <h2>Keranjang Belanja</h2>

    @if(count($cart) > 0)
        <table style="width:100%; border-collapse:collapse; background:#16205c; margin-top:20px;">
            <tr style="background:#0f1745;">
                <th style="padding:10px; text-align:left;">Produk</th>
                <th style="padding:10px; text-align:left;">Harga</th>
                <th style="padding:10px; text-align:left;">Qty</th>
                <th style="padding:10px; text-align:left;">Subtotal</th>
                <th style="padding:10px; text-align:left;">Aksi</th>
            </tr>

            @php $total = 0; @endphp

            @foreach($cart as $id => $item)
                @php $subtotal = $item['harga'] * $item['quantity']; $total += $subtotal; @endphp
                <tr style="border-bottom:1px solid #3a4694;">
                    <td style="padding:10px;">{{ $item['nama_produk'] }}</td>
                    <td style="padding:10px;">Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td style="padding:10px;">{{ $item['quantity'] }}</td>
                    <td style="padding:10px;">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                    <td style="padding:10px;">
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:#ff6b6b; color:#fff; border:none; padding:6px 12px; border-radius:5px; cursor:pointer; font-weight:bold;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <p style="text-align:right; font-size:20px; font-weight:bold; margin-top:15px;">
            Total: Rp{{ number_format($total, 0, ',', '.') }}
        </p>

        <div style="text-align:right;">
            <a href="{{ route('checkout.index') }}" style="background:#f2c94c; color:#0f1745; padding:12px 28px; border-radius:6px; text-decoration:none; font-weight:bold;">
                Checkout
            </a>
        </div>
    @else
        <p style="color:#ffd166;">Keranjang masih kosong. Yuk tambah produk dulu!</p>
        <a href="{{ route('products.index') }}" style="color:#f2c94c;">&laquo; Belanja sekarang</a>
    @endif
@endsection
