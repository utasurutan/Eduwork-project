<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Halaman utama (Home)
    public function home()
    {
        return view('pages.home');
    }

    // Halaman tentang kami
    public function about()
    {
        return view('pages.about');
    }

    // Halaman kontak
    public function contact()
    {
        return view('pages.contact');
    }

    // Kirim pesan dari form kontak
    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'nama'  => 'required|string|max:100',
            'email' => 'required|email',
            'pesan' => 'required|string',
        ]);

        // Di sini nanti bisa ditambahkan logic simpan ke database atau kirim email
        // Mail::to('admin@toko.com')->send(new ContactMessage($validated));

        return redirect()->route('contact')->with('pesan', 'Pesan kamu berhasil dikirim, terima kasih!');
    }

    // Halaman generik berdasarkan slug (misal: /page/syarat-ketentuan)
    public function show($slug)
    {
        // Pastikan file view-nya ada di resources/views/pages/{slug}.blade.php
        if (!view()->exists("pages.$slug")) {
            abort(404);
        }

        return view("pages.$slug");
    }
}
