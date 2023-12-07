@extends('layouts.adminApp')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Properties</h5>
                    <a href="{{route('admins.addProperties')}}" class="btn btn-primary mb-4 text-center float-right ">Create
                        Properties</a>
                    <a href="create-Gallery.html" class="btn btn-primary mb-4 text-center float-right mr-5">Create Gallery</a>

                    @if (Session::has('success'))
                        <div class="alert alert-success" style="margin-top: 20px">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @elseif (Session::has('error'))
                        <div class="alert alert-danger" style="margin-top: 20px">
                            <p>{{ Session::get('error') }}</p>
                        </div>
                    @endif

                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">price</th>
                                <th scope="col">home type</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($properties as $property)
                                <tr>
                                    <th scope="row">{{ $property->id }}</th>
                                    <td>{{ $property->title }}</td>
                                    <td>{{ $property->price }}</td>
                                    <td>{{ $property->home_type }}</td>
                                    <td><a href="{{ route('admins.deleteProperties', $property->id) }}"
                                            class="btn btn-danger  text-center ">delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
