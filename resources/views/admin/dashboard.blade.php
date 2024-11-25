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
                        <x-alert type="{{ session('type') }}" message="{{ session('message') }}"></x-alert>
                    @endif
                    @cannot('isSeller')
                        <div class="card shadow border-0 p-4">
                            <h3>Land Requests</h3>
                            <hr>
                            <div class="card-body p-4">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Added by
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                            <th>
                                                Location
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @isset($landRequests)
                                       @if ($landRequests->isNotEmpty())
                                       @foreach ($landRequests as $landRequest)
                                           <tr>
                                               <td>{{ $landRequest->id }}</td>
                                               <td>{{ $landRequest->user->name }}</td>
                                               <td>{{ \Carbon\Carbon::parse($landRequest->created_at)->format('d-M-Y') }}
                                               </td>
                                               <td>{{ $landRequest->location }}</td>
                                               <td>
                                                   <x-form action="{{ route('lands.update', $landRequest->id) }}"
                                                       method="PUT">
                                                       <input type="hidden" name="status" value="approve">
                                                       <button type="submit" class="btn btn-success btn-sm">
                                                           Approve
                                                       </button>
                                                   </x-form>
                                                   <x-form action="{{ route('lands.update', $landRequest->id) }}"
                                                       method="PUT">
                                                       <input type="hidden" name="status" value="reject">
                                                       <button type="submit" class="btn btn-danger btn-sm">
                                                           Reject
                                                       </button>
                                                   </x-form>
                                               </td>
                                           </tr>
                                       @endforeach
                                   @else
                                       <tr>
                                           <td colspan="5" class="text-danger text-center">
                                               No request Yet
                                           </td>
                                       </tr>
                                   @endif
                                       @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endcannot
                    @can('isSeller')
                    <div class="card shadow border-0 p-4">
                        <h3>Rent Requests</h3>
                        <hr>
                        <div class="card-body p-4">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            From
                                        </th>
                                        <th>
                                            Date
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
                                   @isset($RentRequests)
                                   @if ($RentRequests->isNotEmpty())
                                   @foreach ($RentRequests as $RentRequest)
                                       <tr>
                                           <td>{{ $RentRequest->id }}</td>
                                           <td>{{ $RentRequest->user->name }}</td>
                                           <td>{{ \Carbon\Carbon::parse($RentRequest->created_at)->format('d-M-Y') }}
                                           </td>
                                           <td>{{$RentRequest->status == 0? 'Pending':($RentRequest->status == 1? 'Approved':'Reject')}}</td>
                                           <td>
                                            @if ($RentRequest->status == 0)
                                            <x-form action="{{ route('rent-land.update', $RentRequest->id) }}"
                                                method="PUT">
                                                <input type="hidden" name="status" value="approve">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Approve
                                                </button>
                                            </x-form>
                                            <x-form action="{{ route('rent-land.update', $RentRequest->id) }}"
                                                method="PUT">
                                                <input type="hidden" name="status" value="reject">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Reject
                                                </button>
                                            </x-form> 
                                            @else
                                            <button disabled type="submit" class="btn btn-success btn-sm">
                                                Approve
                                            </button>
                                            <button disabled type="submit" class="btn btn-danger btn-sm">
                                                Reject
                                            </button>
                                            @endif
                                               
                                           </td>
                                       </tr>
                                   @endforeach
                               @else
                                   <tr>
                                       <td colspan="5" class="text-danger text-center">
                                           No request Yet
                                       </td>
                                   </tr>
                               @endif
                                   @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
