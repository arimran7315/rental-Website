@extends('common.layout')

@section('hero')
    <section class="hero-section d-flex align-items-center">
        <div class="container text-center">
            <span>Rental Website</span>
            <h1 class="mt-3">Find. Rent. Thrive – Your Trusted Land Rental Hub.</h1>
            <div class="d-flex justify-content-center">
                <x-form action="{{route('search')}}" method="GET">
                    <div class="row pt-4">
                        <div class="col-5">
                            <div class="form-group">
                                <select name="location" class="form-select rounded-0">
                                    <option value="" selected hidden> Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->location }}">{{ $location->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <input type="text" class="form-control rounded-0" placeholder="Price" name="price">
                            </div>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="popular_locations bg-light ">
        <div class="container py-5">
            <h2>Popular Locations</h2>
            <div class="row pt-4">
                @if($locations->isNotEmpty())
               @foreach ($locations as $location)
               <div class="col-md-4 mt-4">
                <div class="single-location">
                   
                        <a href="{{ route('search','location='.$location->location) }}">
                            <h4>
                                {{$location->location}}
                            </h4>
                        </a>
                            <p class="fs-6">
                                {{ $location->location_count }} lands Available
                            </p>
                </div>
            </div>
               @endforeach
                @else
                NO Location Found
                @endif
            </div>
        </div>
    </section>
@endsection
