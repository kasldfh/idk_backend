<!DOCTYPE html>
<html>
 
<head>
 
 <style type="text/css">background-image: url("/concrete_seamless.png");</style>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
 
    <link rel="stylesheet" href="IDKstyle.css">
    <link rel="shortcut icon" href=url(favcion.ico)>
    <script>
    document.onload = function(e) {
}
        function reRoll() {
        }
    function getOptions() {
        var radius = $("#radius").val();
        var lat = $("#lat").val();
        var lon = $("#lon").val();
        var max_price = $("#max_price").val();
        var last_token = $("#last_token").val();
        $.post("/api",
            {
                "radius": radius,
                "lat": lat,
                "lon": lon,
                "max_price": max_price,
                "last_token": last_token
             },
             function(data, textStatus) {
                //console.log(data);
                var json = JSON.parse(data);
                var items = json.items;
                var rand = Math.floor(Math.random() * items.length);
                console.log("random" + rand);
                var item = items[rand];
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

                


                console.log(item);
                console.log(item.name);
             });
        }
    </script>
 
</head>
  <body>
    <input type="hidden" id="radius" name="radius" value="{!!$radius!!}"></input>
    <input type="hidden" id="max_price" name="max_price" value="{!!$max_price!!}"></input>
    <input type="hidden" id="lat" name="lat" value="{!!$lat!!}"></input>
    <input type="hidden" id="lon" name="lon" value="{!!$lon!!}"></input>
    <input type="hidden" id="last_token" name="last_token" value="{!!$last_token!!}"></input>
    <script>
        getOptions();
    </script>
        <div class="titleBar">
                <h1>IDK</h1>
        </div>
        <div class="container mainContainer img-rounded">
        <div class="form-group col-lg-4 col-lg-offset-4">
            <h2 id="name_listing"></h2>
        </div>
        <hr style="width: 50%;">
            
        <div class="form-group col-lg-4 col-lg-offset-4">
            <h2 id="pricing_listing"></h2>
        </div>
            
        <hr style="width: 50%;">
        <div class="form-group col-lg-4 col-lg-offset-4">
            <h2 id="rating_listing"></h2>
        </div>
        <hr style="width: 50%;">

        <div class="form-group col-lg-4 col-lg-offset-4">
            <h2 id="address_listing"></h2>
        </div>
        <hr style="width: 50%; color: white;">
        
            
        <div class="form-group col-lg-4 col-lg-offset-4">
            <button class="btn btn-primary" onclick="getOptions()">Re-Roll</button>
        </div>
        <hr style="width: 50%;">
    </div>
   
  </body>
</html>
