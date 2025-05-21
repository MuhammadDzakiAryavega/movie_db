@extends('layout.template')

@section('title', 'Login')

@section('content')
<style>
  /* Pastikan container form tidak di tengah */
  .login-container {
    max-width: 400px;
    margin: 0; /* Hilangkan margin auto */
    padding: 20px;
  }
</style>

<div class="login-container">
    <h1 class="mb-4 text-start">Login</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="text-start">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                placeholder="Masukkan email"
                required
                autofocus
            >
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection
