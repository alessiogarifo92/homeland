@extends('layouts.adminApp')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Properties</h5>
                    <form method="POST" action="{{ route('admins.storeProperties') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="title" id="form2Example1" class="form-control"
                                placeholder="title" />
                            @error('home_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price" id="form2Example1" class="form-control"
                                placeholder="price" />
                            @error('home_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Property image</label>
                            <input name="image" class="form-control" type="file" id="formFile">
                            @error('home_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="beds" id="form2Example1" class="form-control"
                                placeholder="beds" />
                            @error('home_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="baths" id="form2Example1" class="form-control"
                                placeholder="baths" />
                            @error('home_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="sq_ft" id="form2Example1" class="form-control"
                                placeholder="SQ/FT" />
                            @error('home_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="year_built" id="form2Example1" class="form-control"
                                placeholder="Year Build" />
                            @error('home_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price_sqft" id="form2Example1" class="form-control"
                                placeholder="Price Per SQ FT" />
                            @error('home_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="location" id="form2Example1" class="form-control"
                                placeholder="location" />
                            @error('home_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <select name="home_type" class="form-control form-select" aria-label="Default select example">
                            <option selected>Select Home Type</option>
                            @foreach ($homeTypes as $homeType)
                                <option value="{{ $homeType->home_type }}">{{ $homeType->home_type }}</option>
                            @endforeach
                        </select>
                        <select name="type" class="form-control mt-3 mb-4 form-select"
                            aria-label="Default select example">
                            <option selected>Select Type</option>
                            <option value="Buy">Buy</option>
                            <option value="Rent">For Rent</option>
                            <option value="Lease">For Lease</option>
                        </select>
                        <select name="city" class="form-control mt-3 mb-4 form-select"
                            aria-label="Default select example">
                            <option selected>Select City</option>
                            <option value="New York">New York</option>
                            <option value="Brooklyn">Boston</option>
                            <option value="London">London</option>
                            <option value="Tokyo">Tokyo</option>
                            <option value="Cairo">Cairo</option>
                        </select>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">More Info</label>
                            <textarea placeholder="More Info" name="more_info" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="agent_name" id="form2Example1" class="form-control"
                                placeholder="agent name" />
                            @error('home_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
