@extends('common.layout')
@section('content')
    <div class="main py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow border-0 p-4">
                        <div class="d-flex justify-content-between">
                            <h3>Edit / User</h3>
                            <a href="{{ route('users.index') }}" class="btn btn-primary small">
                                Back
                            </a>
                        </div>
                        <hr>
                        <div class="card-body p-4">
                            <x-form action="{{ route('users.update',$user->id) }}" method="PUT">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" value="{{ $user->email }}" name="email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="Name" class="form-label">Role</label>
                                    <select name="role" class="form-select">
                                        <option value="">--Select Role--</option>
                                        @if ($user->role == 'seller')
                                            <option value="0" selected>Seller</option>
                                            <option value="1">Buyer</option>
                                        @else
                                            <option value="0">Seller</option>
                                            <option value="1" selected>Buyer</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-secondary">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
