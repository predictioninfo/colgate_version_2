
@extends('back-end.premium.layout.premium-main')

@section('content')

    <section class="main-contant-section">
    <?php

    use App\Models\Company;

    foreach ($locations as $location){
    $location1 = $location->location1 ?? "Location1";
    $location2 = $location->location2 ?? "Location2";
    $location3 = $location->location3 ?? "Location3";
    $location4 = $location->location4 ?? "Location4";
    }
    ?>

        <div class="mb-3">
            @if(Session::get('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif

            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong class="text-danger">{{ $error }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
            <div class="card mb-0">
                <div class="card-header with-border">
                    <h1 class="card-title text-center">{{__('Edit')}} {{$location3}}  </h1>
                    <ol id="breadcrumb1">
                        <li><a href="{{ route('home') }}"><span class="icon icon-home"> </span></a></li>

                        <li><a href="{{ route('territories') }}" ><span class="icon icon-list"> </span>List</a></li>

                        <li><a href="#">Edit - {{ $location3 ?? "location3"}}  </a></li>
                    </ol>
                </div>
            </div>
            @foreach($territories as $territory)
                                <div class="content-box">
                                    <div class="card">
                                     <div class="card-body">
                                        <form method="post" action="{{route('update-territories')}}" class="form-horizontal"
                                        enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">

                                                <input type="hidden" name="id" value="{{$territory->id}}">

                                                <div class="col-md-4 form-group">
                                                    <label> {{ $location1 }} {{__('Name')}} *</label>

                                                    <select name="region_id" id="region_id_edit" class="form-control">
                                                        <option selected> Plese Select </option>
                                                        @foreach($regions as $region)
                                                        <option value="{{$region->id}}" {{ $territory->territory_region_id == $region->id ? 'selected' : '' }}>{{$region->region_name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label> {{ $location2 }} {{__('Name')}} *</label>
                                                    <select class="form-control" name="area_id" id="area_id_edit">
                                                        <option selected> Plese Select </option>
                                                        @foreach($areas as $key => $area)
                                                        <option value="{{$area->id}}" {{ $territory->territory_area_id == $area->id ? 'selected' : '' }}>{{$area->area_name}}</option>

                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="col-md-4">
                                <div class="input-group mb-3">
                                <label> {{ $location3 }} {{__('Name')}} *</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-location-arrow" aria-hidden="true"></i> </span>
                                        </div>
                                        <input type="text" name="territory_name"
                                                        value="{{$territory->territory_name}}" required
                                                        class="form-control">
                                    </div>
                                </div>

                                                <div class="col-sm-12 mt-4">

                                                    <input type="submit" name="action_button"
                                                        class="btn btn-grad " value="{{__('Edit')}}" />

                                                </div>
                                            </div>

                                        </form>
                                     </div>
                                    </div>
                                   </div>
           @endforeach
        </div>
    </section>





@endsection
