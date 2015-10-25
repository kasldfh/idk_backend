<!DOCTYPE html>
<html>

<head>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

    <link rel="stylesheet" href="IDKstyle.css">
    <link rel="shortcut icon" href=url(favcion.ico)>
    <script>
        function submit() {
            var zip = $("#zip").val();
            var price = $("#price option:selected").index();
            price = price == 0 ? 1 : price-1;
            //convert miles to meters
            var radius = 1609.34 * $("#radius").val();
            //console.log("called submit");
            //console.log("price" + price);
            //console.log(radius);

    var lat = '';
    var lng = '';
    var address = zip;
    $.get("/zip?zip=" + zip, {},
        function(data, textStatus) {
            var json = JSON.parse(data);
            //console.log(json.lat);
            //console.log(json.lon);
            window.location.href = "/show?max_price="+price+"&radius="+radius+"&lat="+json.lat+"&lon="+json.lon;
        });

    $.get("/show",
        {
          "zip": zip,
          "price": price,
          "radius": radius
        }
        ,function(data, textStatus) {
          console.log(data);
    });
        }

        window.onload = function(e) {
        }
    </script>

</head>
  <body>
	<div class="titleBar">
		<h1>IDK</h1>
	</div>
	<div class="container mainContainer img-rounded">
        <div class="form-group col-lg-4 col-lg-offset-4">
            <input type="text" class="form-control" placeholder="Zip Code" id="zip">
        </div>
        <div class="form-group col-lg-4 col-lg-offset-4">
            <select class="form-control" id="price">
                <option>Price Range</option>
                <option>Free</option>
                <option>$</option>
                <option>$$</option>
                <option>$$$</option>
                <option>$$$$</option>
            </select>
        </div>
        <div class="form-group col-lg-4 col-lg-offset-4">
            <input type="text" class="form-control" placeholder="Search Radius (miles)" id="radius">
        </div>
        <div class="form-group col-lg-4 col-lg-offset-4">
            <button class="btn btn-primary" onclick="submit()">Submit</button>
        </div>
    </div>
    

  </body>
</html>
