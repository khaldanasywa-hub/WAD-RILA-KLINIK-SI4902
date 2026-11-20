
@extends('layouts.app')

@section('title', 'Register - Klinik Sehat')

@section('content')

<div class="card" style="max-width:420px; margin:40px auto; padding:24px;">

    <h2>Daftar Akun</h2>
    <p class="teks-redup">Buat akun untuk mengakses Klinik Sehat</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-grid">

            <div class="full">
                <label for="name">Nama Lengkap</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    class="@error('name') input-error @enderror"
                    required
                >
                @error('name')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="full">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="@error('email') input-error @enderror"
                    required
                >
                @error('email')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="full">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="@error('password') input-error @enderror"
                    required
                >
                @error('password')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="full">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                >
            </div>

            <div class="full">
                <button type="submit" class="btn btn-primary">
                    Daftar
                </button>
            </div>

        </div>
    </form>

    <p style="margin-top:18px;">
        Sudah punya akun?
        <a href="{{ route('login') }}">Login di sini</a>
    </p>

</div>

@endsection
