@extends('common.layout')
@section('content')
    <div class="main py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="create-land card shadow border-0 p-4">
                        <div class="d-flex justify-content-between">
                            <h3>Lands / Create</h3>
                            <a href="{{ route('lands.index') }}" class="btn btn-primary small">Back</a>
                        </div>
                        <hr>
                        <div class="card-body">
                            <x-form action="{{ route('lands.update',$land->id) }}" method="PUT">
                                <div class="form-group mb-3">
                                    <label for="areaname" class="form-label">Area Name<span>*</span>:</label>
                                    <input type="text" placeholder="Samanabad"
                                        class="form-control @error('location')
                                        is-invalid
                                    @enderror" name="location" value="{{$land->location}}" />
                                    @error('location')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address" class="form-label">Address<span>*</span>:</label>
                                    <input type="text"
                                        placeholder="House #1700, Doctor Chowk, D-Type Colony, Faisalabad, Pakistan (Kindly Follow formate For accurate results)"
                                        class="form-control @error('address')
                                        is-invalid
                                    @enderror" name="address" value="{{$land->address}}"/>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="rent" class="form-label">Rent Price (Rs)<span>*</span>:</label>
                                    <input type="text" placeholder="5000"
                                        class="form-control @error('price_per_month')
                                        is-invalid
                                    @enderror" name="price_per_month" value="{{$land->price_per_month}}" />
                                    @error('price_per_month')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea type="text" placeholder="Samanabad"
                                        class="textarea"
                                        name="description">{{$land->description}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-secondary small">
                                    Update
                                </button>
                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
