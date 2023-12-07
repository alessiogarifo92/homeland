@extends('layouts.adminApp')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Update Hometypes</h5>
                    <form method="POST" action="{{ route('admins.updateHomeTypes', $id) }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="home_type" id="form2Example1" class="form-control"
                                placeholder="hometype" />
                            @error('home_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>


                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
