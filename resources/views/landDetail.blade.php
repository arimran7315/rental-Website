@extends('common.layout')
@section('content')
    <section class="section-4 bg-2">
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <a href="{{ route('landPage') }}" class="btn btn-primary large">
                        Back to Lands
                    </a>
                </div>
            </div>
        </div>
        <div class="container job_details_area">
            <div class="row pb-5">
                <div class="col-md-8">
                    <div class="row mt-2 px-4">
                        @if (session('type'))
                            <x-alert type="{{ session('type') }}" message="{{ session('message') }}"></x-alert>
                        @endif
                    </div>
                    <div class="card shadow border-0 p-4">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="jobs_conetent">
                                        <a href="javascript:void(0)">
                                            <h4>Owner: <span>{{ $land->user->name }}</span></h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location" id="address">
                                                <p> <i class="bi bi-geo-alt-fill pe-1"></i>{{ $land->address }}</p>
                                            </div>
                                            <div class="price">
                                                <p class="fs-5">Rent/month: Rs.<span
                                                        class="fw-bolder">{{ $land->price_per_month }}</span></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="price">
                                                <h4>Description:</h4>
                                                <p class="fs-5">{!! $land->description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lands_right">
                                    <div class="apply_now">
                                        <a class="heart_mark" href="#"> <i class="bi bi-suit-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3 text-end">
                            @if (Auth::check())
                                @if ($rent->isNotEmpty())
                                <button disabled class="btn btn-primary">Rent Request</button>
                                @else
                                <x-form action="{{ route('rent-land.store') }}" mrthod="POST">
                                    <input type="hidden" value="{{ $land->id }}" name="land_id">
                                    <button type="submit" class="btn btn-primary">Request Send</button>
                                </x-form>
                                    
                                @endif
                            @else
                                <a href="{{ route('loginPage') }}" class="btn btn-primary">Rent Request</a>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow border-0 p-4">
                        <div class="land_location">
                            <h3>Map View</h3>
                            <div class="p-5" id="map">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
