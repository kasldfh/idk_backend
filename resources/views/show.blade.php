@extends('layout')
@section('js')
    <script>
        //TODO: call reroll method instead of getOptions to reduce api calls
        function reRoll() {
            
        }

        function getOptions() {
            //get request parameters
            var radius = $("#radius").val();
            var lat = $("#lat").val();
            var lon = $("#lon").val();
            var max_price = $("#max_price").val();
            var last_token = $("#last_token").val();
            //get options from api
            $.post("/api",
                {
                    "radius": radius,
                    "lat": lat,
                    "lon": lon,
                    "max_price": max_price,
                    "last_token": last_token
                 },
                 function(data, textStatus) {
                    //decode returned value
                    var json = JSON.parse(data);
                    var items = json.items;
                    //choose random item
                    var rand = Math.floor(Math.random() * items.length);
                    var item = items[rand];
                    
                    //set listing elements to item attributes
                    $("#name_listing").text(item.name);

                    var price_text = "Price Level: ";
                    for(var i = 0; i < item.price_level; i++) {
                        price_text += "$";
                    }

                    $("#pricing_listing").text(price_text);
                    if(item.rating !== "") {
                        $("#rating_listing").text(item.rating + " Stars");
                    }
                    $("#address_listing").text(item.vicinity);
                 }
            );
        }
    </script>
@endsection
 
@section('content')
    <input type="hidden" id="radius" name="radius" value="{!!$radius!!}"></input>
    <input type="hidden" id="max_price" name="max_price" value="{!!$max_price!!}"></input>
    <input type="hidden" id="lat" name="lat" value="{!!$lat!!}"></input>
    <input type="hidden" id="lon" name="lon" value="{!!$lon!!}"></input>
    <input type="hidden" id="last_token" name="last_token" value="{!!$last_token!!}"></input>
    <script>
        getOptions();
    </script>

        <div class="container mainContainer img-rounded">
            {{-- item name --}}
            <div class="form-group col-lg-4 col-lg-offset-4">
                <h2 id="name_listing"></h2>
            </div>
            <hr style="width: 50%;">
                
            {{-- item price --}}
            <div class="form-group col-lg-4 col-lg-offset-4">
                <h2 id="pricing_listing"></h2>
            </div>
            <hr style="width: 50%;">

            {{-- item rating --}}
            <div class="form-group col-lg-4 col-lg-offset-4">
                <h2 id="rating_listing"></h2>
            </div>
            <hr style="width: 50%;">

            {{-- item address --}}
            <div class="form-group col-lg-4 col-lg-offset-4">
                <h2 id="address_listing"></h2>
            </div>
            <hr style="width: 50%; color: white;">
            
            {{-- reroll button --}}
            <div class="form-group col-lg-4 col-lg-offset-4">
                <button class="btn btn-primary" onclick="getOptions()">Re-Roll</button>
            </div>
            <hr style="width: 50%;">
    </div>
@endsection
