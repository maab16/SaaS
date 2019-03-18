<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Md Abu Ahsan Basir">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Maps</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic' rel='stylesheet' type='text/css'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/map.css') }}" type="text/css">

</head>

<body>
<section class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="map" id="map"></div>
        </div>
        <div class="col-md-3 right_sidebar">
            <div class="sidebar-content">
                <div class="results">
                    @forelse($datas as $data)
                        <div class="result">
                            <a href="javascript:void(0)" data-url="{{ $data->url }}" data-id="{{ $data->id }}" class="result_link"><h2 class="result-title">{{ $data->title }}</h2>
                                <div class="result-content">
                                    <figure class="result_image">
                                        @php $gallery = explode(",", $data->gallery) @endphp
                                        @if($gallery)
                                            <img src="{{ asset($gallery[0]) }}" alt="Result Image" class="img-fluid">
                                        @endif
                                        
                                        <h3 class="result_image_caption">Average price $30</h3>
                                    </figure>
                                    <div class="description">
                                        <h4 class="result-sub-title"><i class="fa fa-map-marker"></i>{{ $data->location }}</h4>
                                        <div class="rating" data-rating="{{ $data->rating }}">
                                            <span class="stars">
                                                <i class="active fa fa-star"></i>
                                                <i class="active fa fa-star"></i>
                                                <i class="active fa fa-star"></i>
                                                <i class="active fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="reviews">({{ $data->reviews_number }})</span>
                                        </div>
                                        <h3 class="result_category">{{ $data->category }}</h3>
                                        <p class="result_desc">{{ Str::limit( $data->description, 60) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                    
                </div>

                <div class="single_result">
                    
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="{{ asset('js/richmarker.js') }}"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });      
    });
</script>
<script src="{{ asset('assets/js/map.js') }}"></script>

</body>