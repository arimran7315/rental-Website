@extends('common.layout')

@section('content')
    <div class="main py-5">
        <div class="container">
            <section class="login-form">
                <div class="card py-5 px-3 w-50 mx-auto border-0 shadow">
                    <h4>Registration Form</h4>
                    <hr>
                    <div class="card-body">
                        <x-form action="{{ route('register.function') }}" method="POST">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" placeholder="name" name="name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Username: </label>
                                <input type="text" placeholder="@example.com" name="username" class="form-control @error('username')
                                    is-invalid
                                @enderror" value="{{ old('username') }}">
                                @error('username')
                                  <p class="invalid-feedback">
                                    {{ $message }}
                                  </p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Password: </label>
                                <input type="password" placeholder="Adjcn2@mda" class="form-control @error('password')
                                    is-invalid
                                @enderror" name="password">
                                @error('password')
                                    <p class="invalid-feedback">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Confirm Password: </label>
                                <input type="password" placeholder="Adjcn2@mda" class="form-control @error('password')
                                    is-invalid
                                @enderror" name="password_confirmation">
                                @error('password')
                                    <p class="invalid-feedback">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Role: </label>
                               <select id="" class="form-select  @error('role')
                                   is-invalid
                               @enderror" name="role" value="{{ old('role') }}">
                                <option value="">--Select Role--</option>
                                <option value="0">Seller</option>
                                <option value="1">Buyer</option>
                               </select>
                               @error('role')
                                   <p class="invalid-feedback">
                                    {{ $message }}
                                   </p>
                               @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-secondary">
                                        Register
                                    </button>
                                    <p class="mt-3">Already have an account? <a href="{{ route('loginPage') }}">Login</a></p>
                                </div>
                            </div>
                        </x-form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
