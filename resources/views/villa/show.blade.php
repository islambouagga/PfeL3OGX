@extends('layouts.avam')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section spad set-bg" data-setbg="{{asset('img/breadcrumb-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h4>Villa Details</h4>
                        <div class="bt-option">
                            <a href="/"><i class="fa fa-home"></i> Home</a>
                            <span>Villa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Property Details Section Begin -->
    <section class="property-details-section">

        <div class="container">
            <div class="row">
                @foreach($villa->offers as $offer)
                    <div class="col-lg-12 ">
                        <div class="pd-text">
                            <div class="row">
                                <div class="col-lg-6 mt-5">
                                    <div class="pd-title">
                                        <div class="pt-price">dz {{$offer->prix}}</div>
                                        <h3>{{$offer->title}}</h3>
                                        <p><span class="icon_pin_alt"></span>{{$offer->address}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="pd-social">
                                        <form role="form" method="post"
                                              action="{{route('myByOffer.store')}}">
                                            @csrf
                                            <input type="hidden" name="offerid" value="{{$offer->id}}">
                                            <input type="hidden" name="userid" value="{{Auth::id()}}">
                                            @if($offer->create_by_user_id != Auth::id())
                                                @if(\App\User::findOrFail(Auth::id())->buyOffers()->where('offer_id',$offer->id)->first() == null)
                                                    <button type="submit" class="heart-icon btn"><span
                                                            class="icon_heart_alt"></span></button>
                                                @endif
                                            @endif
                                            <a href="{{route('villa.edit',$villa->id)}}"><i class="fa fa-edit"></i></a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="pd-board">
                                <div class="tab-board">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Overview</a>
                                        </li>
                                    </ul><!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                            <div class="tab-details">
                                                <ul class="left-table">
                                                    <li>
                                                        <span class="type-name">Price</span>
                                                        <span class="type-value">Dz {{$offer->prix}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="type-name">Balconies</span>
                                                        <span class="type-value">{{$villa->balcon}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="type-name">Floors</span>
                                                        <span class="type-value">{{$villa->etage}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="type-name">Cuisine</span>
                                                        <span class="type-value">{{$villa->cuisine}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="type-name">Garage</span>
                                                        <span class="type-value">{{$villa->garage}}</span>
                                                    </li>
                                                </ul>
                                                <ul class="right-table">
                                                    <li>
                                                        <span class="type-name">Home Area</span>
                                                        <span class="type-value">{{$offer->surfface}} m²</span>
                                                    </li>
                                                    <li>
                                                        <span class="type-name">Bedrooms</span>
                                                        <span class="type-value">{{$villa->chombre}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="type-name">Bathrooms</span>
                                                        <span class="type-value">{{$villa->salledebain}}</span>
                                                    </li>
                                                    <li>
                                                        <span class="type-name">WC</span>
                                                        <span class="type-value">{{$villa->toilettes}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
    <!-- Property Details Section End -->

@endsection
