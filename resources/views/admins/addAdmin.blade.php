@extends('layouts.adminApp')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Admins</h5>
                    <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4 mt-4">
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="email" />
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="admin name" />
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="psw" class="form-control"
                                placeholder="password" />
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


                    </form>
                    
                </div>
            </div>
            <div id="message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="specChar" class="invalid">A <b>special charachter</b></p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
              </div>
        </div>
    </div>
@endsection
