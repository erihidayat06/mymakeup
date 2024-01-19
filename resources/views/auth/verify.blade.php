@extends('login.layouts.main')

@section('container')

@include('sweetalert::alert')

<div style="margin-top: 150px" class="col-lg-5 mb-3">
<main id="login" class="form-signin w-100 bg-light shadow">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Sebelum melanjutkan, periksa email Anda untuk tautan verifikasi.') }}
                    {{ __(' Jika Anda tidak menerima email tersebut,') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk meminta yang lain') }}</button>.
                    </form>
                </div>
            </main>
</div>
@endsection
