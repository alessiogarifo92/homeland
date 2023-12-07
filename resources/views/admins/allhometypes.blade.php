@extends('layouts.adminApp')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Hometypes</h5>
                    <a href="{{ route('admins.addHomeTypes') }}" class="btn btn-primary mb-4 text-center float-right">Create
                        Hometypes</a>

                    @if (Session::has('success'))
                        <div class="alert alert-success" style="margin-top: 20px">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @elseif (Session::has('error'))
                        <div class="alert alert-danger" style="margin-top: 20px">
                            <p>{{ Session::get('error') }}</p>
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">update</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($homeTypes as $homeType)
                                <tr>
                                    <th scope="row">{{ $homeType->id }}</th>
                                    <td>{{ $homeType->home_type }}</td>
                                    <td><a href="{{ route('admins.editHomeTypes', $homeType->id) }}"
                                            class="btn btn-warning text-white text-center ">Update</a></td>
                                    <td><a href="{{ route('admins.deleteHomeTypes', $homeType->id) }}"
                                            class="btn btn-danger  text-center ">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
