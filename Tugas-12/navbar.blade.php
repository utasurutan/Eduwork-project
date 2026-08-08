<nav style="background:#0f1745; padding:15px 40px; display:flex; justify-content:space-between; align-items:center;">
    <a href="{{ route('home') }}" style="color:#f2c94c; font-size:22px; font-weight:bold; text-decoration:none;">
        TokoKita
    </a>

    <div style="display:flex; gap:25px; align-items:center;">
        <a href="{{ route('home') }}" style="color:#fff; text-decoration:none; {{ request()->routeIs('home') ? 'font-weight:bold; color:#f2c94c;' : '' }}">
            Beranda
        </a>
        <a href="{{ route('products.index') }}" style="color:#fff; text-decoration:none; {{ request()->routeIs('products.*') ? 'font-weight:bold; color:#f2c94c;' : '' }}">
            Produk
        </a>
        <a href="{{ route('cart.index') }}" style="color:#fff; text-decoration:none; {{ request()->routeIs('cart.*') ? 'font-weight:bold; color:#f2c94c;' : '' }}">
            Keranjang
            @if(count(session('cart', [])) > 0)
                <span style="background:#eb5757; color:#fff; border-radius:50%; padding:2px 7px; font-size:12px; margin-left:4px;">
                    {{ count(session('cart', [])) }}
                </span>
            @endif
        </a>
        <a href="{{ route('about') }}" style="color:#fff; text-decoration:none; {{ request()->routeIs('about') ? 'font-weight:bold; color:#f2c94c;' : '' }}">
            Tentang
        </a>
        <a href="{{ route('contact') }}" style="color:#fff; text-decoration:none; {{ request()->routeIs('contact') ? 'font-weight:bold; color:#f2c94c;' : '' }}">
            Kontak
        </a>
    </div>
</nav>
