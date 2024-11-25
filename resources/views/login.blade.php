@extends('common.layout')

@section('content')
    <div class="main py-5">
        <div class="container py-5">
            <section class="login-form py-5">
                <div class="mb-3 w-50 m-auto">
                    @if (session('type'))
                        <x-alert type="{{ session('type') }}" message="{{ session('message') }}"></x-alert>
                    @endif
                </div>
                <div class="card py-5 px-3 w-50 mx-auto border-0 shadow">
                    <h4>Login Form</h4>
                    <hr>
                    <div class="card-body">
                        <x-form action="{{ route('login.function') }}" method="POST">
                            <div class="form-group mb-3">
                                <label for="username">Username: </label>
                                <input type="text" placeholder="@example.com" class="form-control @error('email')
                                    is-invalid
                                @enderror" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="invalid-feedback">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password: </label>
                                <input type="password" placeholder="Adjcn2@mda" class="form-control @error('password')
                                    is-invalid
                                @enderror" name="password">
                                @error('password')
                                    <p class="invalid-feedback">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-secondary">
                                        Login
                                    </button>
                                    <p class="mt-3">Don't have an account? <a
                                            href="{{ route('registerPage') }}">Signup</a></p>
                                </div>
                            </div>
                        </x-form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection