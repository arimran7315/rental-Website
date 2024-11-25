@extends('admin.dashboard')
@section('content')
    <div class="main py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('common.sidebar')
                </div>
                <div class="col-md-9">
                    @if (session('type'))
                        <x-alert type="{{session('type')}}" message="{{session('message')}}"></x-alert>
                    @endif
                    <div class="card shadow border-0 p-4">
                        <h3>Users</h3>
                        <hr>
                        <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Role
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary">
                                                    Edit
                                                </a>
                                                <x-form action="{{route('users.destroy',$user->id)}}" method="DELETE">
                                                    <button class="btn btn-secondary">
                                                        Delete
                                                    </button>
                                                </x-form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-danger">
                                                No Users Yet
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
