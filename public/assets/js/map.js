    var map;
    var map_id;
    var el;

    initMap();

    function initMap(){

        el = document.getElementById('map');

        map_id = $(el).attr('data-id');


        if( el == null ){
            console.log("There is no element");
        }

        map = new google.maps.Map( el, {
            zoom: 14,
            scrollwheel: false,
            center: new google.maps.LatLng(40.7344458, -73.86704922)
        });

        getData();

        var i;
        var location = "";

        function loadMarkers(markers){

            for (i = 0; i < markers.length; i++) {

                var marker = markers[i];
                var markerContent;;

                console.log(marker.id);


                markerContent =
                    '<div class="marker" data-id="'+ marker.id +'" data-url="data.html"  data-color="#000" data-i="'+ i +'">' +
                        '<div class="title">'+ marker.company +'</div>' +
                        '<div class="marker-wrapper">' +
                            '<div class="pin">' +
                            '<div class="image" style="background-color: #000"></div>' +
                        '</div>' +
                    '</div>';


                // Latitude, Longitude and Address

                if ( marker.latitude && marker.longitude && marker.full_address ){
                    location = 'latLong';
                }

                // Only Address

                else if ( marker.full_address && !marker.latitude && !marker.longitude ){
                    location = 'address';
                }

                // Only Latitude and Longitude

                else if ( marker.latitude && marker.longitude && !marker.full_address ) {
                    location = 'latLong';
                }

                if( location != "" ) {
                    addRichMarker( location, marker );
                }
            }

            /*
             * Add Marker
             */
            function addRichMarker( location, marker ){
                switch ( location ) {
                    case "latLong":
                        var richMarker = new RichMarker({
                            position: new google.maps.LatLng( marker.latitude, marker.longitude ),
                            map: map,
                            draggable: false,
                            content: markerContent,
                            flat: true,
                            id: marker.id
                        });
                        console.log(richMarker);
                        break;
                    case "address":
                        a = i;
                        var geocoder = new google.maps.Geocoder();
                        var geoOptions = {
                            address: marker.full_address
                        };

                        geocoder.geocode(geoOptions, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                richMarker = new RichMarker({
                                    position: results[0].geometry.location,
                                    map: map,
                                    draggable: false,
                                    content: markerContent,
                                    flat: true,
                                    id: parseInt($(markerContent.innerHTML).attr("data-id"))
                                });

                            } else {
                                console.log("Geocode failed " + status);
                            }
                        });
                        break;
                }
            }

        }

        function getData( url, id ){
            $.ajax({
                url: "/getMapData",
                dataType: "json",
                type: "post",
                data: {
                    'map_id' : map_id,
                    '_token': $('meta[name=csrf-token]').attr('content')
                },
                cache: false,
                success: function(results){
                    console.log(results);
                    loadMarkers(results);
                },
                error : function (e) {
                    console.log(e);
                }
            });
        }

    }

$(document).ready(function(){

    $(document).on("mouseenter",".marker,.result_link", function(e){
        // e.preventDefault();
        var id = $(this).data("id");
        // console.log(id);
        $('.marker').removeClass("hover-state");
        $('.result_link').removeClass("hover");

        $('.marker').each(function(i, marker){
            var markerId = $(marker).data("id");
            if(markerId == id) {
                 // console.log(markerId);
                $(marker).addClass("hover-state");
            }
        });

        $('.result_link').each(function(i, link){
            var linkId = $(link).data("id");
            if(linkId == id) {
                 // console.log(linkId);
                $(link).addClass("hover");
            }
        });

    }).on("mouseleave",".marker,.result_link", function(){
        $('.marker').removeClass('hover-state');
        $('.result_link').removeClass("hover");
    });

    $(document).on("click",".marker,.result_link", function(e){
        var id = $(this).data("id");
        // console.log(id);
        $('.marker').removeClass("active");
        $('.result_link').removeClass("active");

        $('.marker').each(function(i, marker){
            var markerId = $(marker).data("id");
            if(markerId == id) {
                 // console.log(markerId);
                $(marker).addClass("active");
            }
        });

        $('.result_link').each(function(i, link){
            var linkId = $(link).data("id");
            if(linkId == id) {
                 // console.log(linkId);
                $(link).addClass("active");
            }
        });

        $.ajax({
            url: "/getSingleMap",
            dataType: "json",
            type: "post",
            data: {
                'id' : id,
                '_token': $('meta[name=csrf-token]').attr('content')
            },
            cache: false,
            success: function(data){
                // console.log(data);
                var title = (data.title) ? data.title : "";
                var location = (data.location) ? data.location : "";
                var category = (data.category) ? data.category : "";
                var rating = (data.rating) ? data.rating : "";
                var reviews_number = (data.reviews_number) ? data.reviews_number : "";
                var phone = (data.phone) ? '<i class="active fa fa-phone"></i> '+data.phone : "";
                var email = (data.email) ? '<i class="active fa fa-envelope"></i> '+data.email : "";
                var website = (data.website) ? '<i class="active fa fa-globe"></i> '+data.website : "";
                var description = (data.description) ? data.description : "";
                var gallery = data.gallery.split(',');
                // console.log(gallery);
                var content = '<div class="back_results"><i class="fa fa-arrow-left"></i></div>'+
                                '<h2 class="single_result_title">'+title+'</h2>'+
                                '<h2 class="single_result_location">'+location+'</h2>'+
                                '<h3 class="single_result_category">'+category+'</h3>'+
                                '<div class="rating" data-rating="'+rating+'">'+
                                    '<span class="stars">'+
                                        '<i class="active fa fa-star"></i>'+
                                        '<i class="active fa fa-star"></i>'+
                                        '<i class="active fa fa-star"></i>'+
                                        '<i class="active fa fa-star"></i>'+
                                        '<i class="fa fa-star"></i>'+
                                    '</span>'+
                                    '<span class="reviews">('+reviews_number+')</span>'+
                                '</div>'+
                                '<p class="single_result_phone">'+phone+'</p>'+
                                '<p class="single_result_email">'+email+'</p>'+
                                '<p class="single_result_website">'+website+'</p>'+
                                '<figure class="single_result_image">'+
                                    '<img src="'+gallery[0]+'" alt="Result Image" class="img-fluid">'+
                                '</figure>'+
                                '<h4 class="single_result_about">About</h4>'+
                                '<p class="single_result_desc">'+description+'</p>';
                $('.single_result').html(content);
                $('.results,.single_result').addClass('slideLeft');
            },
            error : function (e) {
                console.log(e);
            }
        });
    });

    $(document).on("click",".back_results", function(){
        $('.results,.single_result').removeClass('slideLeft');
        $('.marker').removeClass("active");
        $('.result_link').removeClass("active");
    });
});