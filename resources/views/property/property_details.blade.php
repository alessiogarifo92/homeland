@extends('layouts.app')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay"
        style="background-image: url({{ asset('assets/images/' . $propertyInfo->image) }});" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Property Details of</span>
                    <h1 class="mb-2">{{ $propertyInfo->title }}</h1>
                    <p class="mb-5"><strong class="h2 text-success font-weight-bold">${{ $propertyInfo->price }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section site-section-sm">
        <div class="container">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @elseif (Session::has('failed'))
                <div class="alert alert-danger">
                    <p>{{ Session::get('failed') }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8">
                    <div>
                        <div class="slide-one-item home-slider owl-carousel">
                            @foreach ($prop_images as $cProp_image)
                                <div><img src="{{ asset('assets/images/' . $cProp_image->image) }}" alt="Image"
                                        class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-white property-body border-bottom border-left border-right">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <strong class="text-success h1 mb-3">${{ $propertyInfo->price }}</strong>
                            </div>
                            <div class="col-md-6">
                                <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                                    <li>
                                        <span class="property-specs">Beds</span>
                                        <span class="property-specs-number">{{ $propertyInfo->beds }} <sup>+</sup></span>

                                    </li>
                                    <li>
                                        <span class="property-specs">Baths</span>
                                        <span class="property-specs-number">{{ $propertyInfo->baths }}</span>

                                    </li>
                                    <li>
                                        <span class="property-specs">SQ FT</span>
                                        <span class="property-specs-number">{{ $propertyInfo->sq_ft }}</span>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Home Type</span>
                                <strong class="d-block">{{ $propertyInfo->home_type }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Year Built</span>
                                <strong class="d-block">{{ $propertyInfo->year_built }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Price/Sqft</span>
                                <strong class="d-block">${{ $propertyInfo->price_sqft }}</strong>
                            </div>
                        </div>
                        <h2 class="h4 text-black">More Info</h2>
                        <p>{{ $propertyInfo->more_info }}</p>

                        <div class="row no-gutters mt-5">
                            <div class="col-12">
                                <h2 class="h4 text-black mb-3">Gallery</h2>
                            </div>
                            @foreach ($prop_images as $cProp_image)
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="{{ asset('assets/images/' . $cProp_image->image) }}"
                                        class="image-popup gal-item"><img
                                            src="{{ asset('assets/images/' . $cProp_image->image) }}" alt="Image"
                                            class="img-fluid"></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    {{-- if not logged in, it won't be displayd the form to send messages --}}
                    @if (empty($notAuth))
                        <div class="bg-white widget border rounded">

                            <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
                            @if (isset($messageSent) && $messageSent == 0)
                                <form action="{{ route('insert.request', $propertyInfo->id) }}" method="POST"
                                    class="form-contact-agent">
                                    @csrf
                                    <input type="hidden" name="prop_id" id="prop_id" class="form-control"
                                        value="{{ $propertyInfo->id }}">
                                    <input type="hidden" name="agent_name" id="agent_name" class="form-control"
                                        value="{{ $propertyInfo->agent_name }}">
                                    @auth

                                        <input type="hidden" name="user_id" id="user_id" class="form-control"
                                            value="{{ Auth::user()->id }}">
                                    @else
                                        You must login
                                    @endauth

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control">
                                        @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" id="phone" class="btn btn-primary"
                                            value="Send Message">
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-success">
                                    <p>Message already sent for this property.</p>
                                </div>
                            @endif
                        </div>

                        <div class="bg-white widget border rounded">

                            <h3 class="h4 text-black widget-title mb-3">Save Property</h3>
                            @if (isset($savedProperty) && $savedProperty == 0)
                                <form action="{{ route('save.props', $propertyInfo->id) }}" method="POST"
                                    class="form-contact-agent">
                                    @csrf
                                    <input type="hidden" name="prop_id" id="prop_id" class="form-control"
                                        value="{{ $propertyInfo->id }}">

                                    <input type="hidden" name="title" id="title" class="form-control"
                                        value="{{ $propertyInfo->title }}">

                                    <input type="hidden" name="location" id="location" class="form-control"
                                        value="{{ $propertyInfo->location }}">

                                    <input type="hidden" name="image" id="image" class="form-control"
                                        value="{{ $propertyInfo->image }}">

                                    <input type="hidden" name="price" id="price" class="form-control"
                                        value="{{ $propertyInfo->price }}">

                                    <div class="form-group">
                                        <input type="submit" name="submit" id="phone" class="btn btn-primary"
                                            value="Save property">
                                    </div>
                                </form>
                            @else
                                <div class="form-group">
                                    <input type="submit" name="submit" id="phone" class="btn btn-primary"
                                        value="Property already saved" disabled>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="bg-white widget border rounded">
                        <h3 class="h4 text-black widget-title mb-3 ml-0">Share</h3>
                        <div class="px-3" style="margin-left: -15px;">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('single.prop', $propertyInfo->id) }}=&quote={{ $propertyInfo->title }}"
                                class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                            <a href="https://twitter.com/intent/tweet?text={{ $propertyInfo->title }}&url={{ route('single.prop', $propertyInfo->id) }}"
                                class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('single.prop', $propertyInfo->id) }}"
                                class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                        </div>
                    </div>
                </div>







            </div>
        </div>
    </div>

    <div class="site-section site-section-sm bg-light">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="site-section-title mb-5">
                        <h2>Related Properties</h2>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                @if ($relatedProps->count() > 0)
                    @foreach ($relatedProps as $relatedProp)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="property-entry h-100">
                                <a href="{{ route('single.prop', $relatedProp->id) }}" class="property-thumbnail">
                                    <div class="offer-type-wrap">
                                        <span class="offer-type bg-danger">Sale</span>
                                        <span class="offer-type bg-success">Rent</span>
                                    </div>
                                    <img src="{{ asset('assets/images/' . $relatedProp->image) }}" alt="Image"
                                        class="img-fluid">
                                </a>
                                <div class="p-4 property-body">
                                    <h2 class="property-title"><a
                                            href="property-details.html">{{ $relatedProp->title }}</a></h2>
                                    <span class="property-location d-block mb-3"><span
                                            class="property-icon icon-room"></span> {{ $relatedProp->location }}</span>
                                    <strong
                                        class="property-price text-primary mb-3 d-block text-success">${{ $relatedProp->price }}</strong>
                                    <ul class="property-specs-wrap mb-3 mb-lg-0">
                                        <li>
                                            <span class="property-specs">Beds</span>
                                            <span class="property-specs-number">{{ $relatedProp->beds }}
                                                <sup>+</sup></span>

                                        </li>
                                        <li>
                                            <span class="property-specs">Baths</span>
                                            <span class="property-specs-number">{{ $relatedProp->baths }}</span>

                                        </li>
                                        <li>
                                            <span class="property-specs">SQ FT</span>
                                            <span class="property-specs-number">{{ $relatedProp->sq_ft }}</span>

                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    NO RELATED HOUSES TO DISPLAY
                @endif

            </div>
        </div>
    </div>
@endsection
