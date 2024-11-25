@extends('common.layout')
@section('content')
<section>
    <div class="container py-5">
        <div class="card border-0 p-4">
            <h4>All Applied Rent Request</h4>
            <hr>
            <div class="card-body p-4">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>
                                Request Id
                            </th>
                            <th>
                                Owner
                            </th>
                            <th>
                                Area
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Rent
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($requests)
                            @if ($requests->isNotEmpty())
                            @foreach ($requests as $req )
                            <tr>
                                <td>
                                    {{ $req->rent_id }}
                                </td>
                                <td>
                                    {{ $req->name }}
                                </td>
                                <td>
                                    {{ $req->location }}
                                </td>
                                <td>
                                    {{ $req->status == 1? 'Approved':($req->status == 2?'Reject':'Pending') }}
                                </td>
                                <td>
                                    Rs. {{ $req->price_per_month }}
                                </td>
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text-danger">No Request Found</td>
                                </tr>
                            @endif
                        @endisset
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection