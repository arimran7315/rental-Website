@extends('common.layout')

@section('content')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Lands</h2>
                </div>
                <div class="col-6 col-md-2">

                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <form action="" name="searchForm" id="searchForm">
                        <div class="card border-0 shadow p-4">

                            <div class="mb-4">
                                <h4>Price</h4>
                                <input type="text" name="price" placeholder="price"
                                    class="form-control">
                            </div>

                            <div class="mb-4">
                                @if ($locations->isNotEmpty())
                                    <h4>Locations</h4>
                                    <select name="location" class="form-select">
                                        <option value="" selected> Select Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->location }}">{{ $location->location }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            {{-- @endif --}}
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary">
                                    search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 col-lg-9 ">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @if ($lands->isNotEmpty())
                                    @foreach ($lands as $land)
                                        <div class="col-md-4">
                                            <div class="lands card border-0 p-3 shadow mb-4">
                                                <div class="card-body">
                                                    <h6 class="border-0 pb-2 mb-0">Owner:
                                                        <span>{{ $land->user->name }}</span></h6>
                                                    <p class="fs-6">Added
                                                        at:<span>{{ \Carbon\Carbon::parse($land->created_at)->format('d-M-Y') }}</span>
                                                    </p>
                                                    <div class="bg-light p-3 border">
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i
                                                                    class="bi bi-geo-alt-fill"></i></span>
                                                            <span class="ps-1 fs-6">{{ $land->location }}</span>
                                                        </p>

                                                        {{-- @if ($job->salary != null) --}}
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="bi bi-cash-stack"></i></span>
                                                            <span class="ps-1">Rs. {{ $land->price_per_month }}</span>
                                                        </p>
                                                        {{-- @endif --}}
                                                    </div>

                                                    <div class="d-grid mt-3">
                                                        <a href="{{ route('landDetailPage', $land->id) }}"
                                                            class="btn btn-primary btn-lg">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="">
                                        <h2>No Land Found</h2>
                                    </div>
                                @endif

                            </div>
                            <div class="row">
                                {{-- {{ $jobs->links('pagination::bootstrap-5') }} --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
