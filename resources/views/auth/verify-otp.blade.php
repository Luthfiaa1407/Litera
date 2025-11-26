@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Verifikasi OTP</h3>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif


        <form action="{{ route('verify.otp') }}" method="POST">
            @csrf

            <input type="hidden" name="email" value="{{ session('otp_email') }}">

            <div class="mb-3">
                <label>Kode OTP</label>
                <input type="text" name="otp" class="form-control" maxlength="6" required>
            </div>

            <button type="submit" class="btn btn-primary">Verifikasi</button>
        </form>

    </div>
@endsection
