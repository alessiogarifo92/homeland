@extends('layouts.app')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay"
        style="background-image: url({{ asset('assets/images/img_1.jpg') }});" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <h1 class="mb-2">All Your Requests for Properties</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section site-section-sm bg-light">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="site-section-title mb-5">
                        <h2>All Your Requests for Properties</h2>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                @if (count($allRequests) > 0)
                    @foreach ($propsInfo as $cprop)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="property-entry h-100">
                                <a href="{{ route('single.prop', $cprop->id) }}" class="property-thumbnail">
                                    <div class="offer-type-wrap">
                                        <span class="offer-type bg-danger">{{ $cprop->type }}</span>
                                    </div>
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
                                    <ul class="property-specs-wrap mb-3 mb-lg-0">
                                        <li>
                                            <span class="property-specs">Beds</span>
                                            <span class="property-specs-number">{{ $cprop->beds }}
                                                <sup>+</sup></span>

                                        </li>
                                        <li>
                                            <span class="property-specs">Baths</span>
                                            <span class="property-specs-number">{{ $cprop->baths }}</span>

                                        </li>
                                        <li>
                                            <span class="property-specs">SQ FT</span>
                                            <span class="property-specs-number">{{ $cprop->sq_ft }}</span>

                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    NO SUBMITTED REQUESTS TO SHOW YET 
                @endif

            </div>
        </div>
    </div>
@endsection
