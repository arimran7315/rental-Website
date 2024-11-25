@extends('common.layout')
@section('content')
<div class="main py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('common.sidebar')
            </div>
            <div class="col-md-9">
                @if (session('type'))
                    <x-alert type="{{session('type')}}" message="{{session('message')}}" ></x-alert>
                @endif
                <div class="card shadow border-0 p-4">
                    <div class="d-flex justify-content-between">
                        <h3>Lands</h3>
                        <a href="{{ route('lands.create') }}" class="btn btn-primary small">Create</a>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Location
                                    </th>
                                    <th>
                                        Rent
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lands as $land)
                                    <tr>
                                        <td>{{ $land->id }}</td>
                                        <td>{{ $land->location }}</td>
                                        <td>{{ $land->price_per_month }}</td>
                                        <td>{{ $land->status == 0? 'Pending': ($land->status == 1? 'Active' : ($land->status == 2? 'Reject':'Completed'))}}</td>
                                        <td>
                                            <a href="{{ route('lands.edit',$land->id) }}" class="btn btn-primary">
                                                Edit
                                            </a>
                                            <x-form action="{{route('lands.destroy',$land->id)}}" method="DELETE" style="display: inline">
                                                <button class="btn btn-secondary">        
                                                    Delete
                                                </button>
                                            </x-form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-danger">
                                            No Land Yet
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection