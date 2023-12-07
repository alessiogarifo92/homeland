@extends('layouts.app')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay"
        style="background-image: url({{ asset('assets/images/img_1.jpg') }});" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <h1 class="mb-2">Saved Properties</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section site-section-sm bg-light">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="site-section-title mb-5">
                        <h2>Saved Properties</h2>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                @if ($savedProperties->count() > 0)
                    @foreach ($savedProperties as $cprop)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="property-entry h-100">
                                <a href="{{ route('single.prop', $cprop->prop_id) }}" class="property-thumbnail">
                                    <img src="{{ asset('assets/images/' . $cprop->image) }}" alt="Image"
                                        class="img-fluid">
                                </a>
                                <div class="p-4 property-body">
                                    <h2 class="property-title"><a href="property-details.html">{{ $cprop->title }}</a>
                                    </h2>
                                    <span class="property-location d-block mb-3"><span
                                            class="property-icon icon-room"></span> {{ $cprop->location }}</span>
                                    <strong
                                        class="property-price text-primary mb-3 d-block text-success">${{ $cprop->price }}</strong>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    NO SAVED PROPERTIES TO SHOW YET 
                @endif

            </div>
        </div>
    </div>
@endsection
