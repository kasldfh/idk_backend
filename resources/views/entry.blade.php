@extends('layout')
@section('js')
    <script>
    //function to submit a request for 
    function submit() {
        var zip = $("#zip").val();
        var price = $("#price option:selected").index();
        //defaultprice should be 1, otherwise chosen index - 1
        price = price == 0 ? 1 : price-1;

        //convert miles to meters
        var radius = 1609.34 * $("#radius").val();

        window.location.href = "/show?"
            + "max_price=" + price 
            + "&radius=" + radius
            + "&zip=" + zip;
    }

    window.onload = function(e) {
        $("#zip").focus();
    }
    </script>
@endsection

@section('content')
	<div class="container mainContainer img-rounded">
        {{-- Input for zip code --}}
        <div class="form-group col-lg-4 col-lg-offset-4">
            <input type="text" class="form-control" placeholder="Zip Code" id="zip">
        </div>

        {{-- select price range --}}
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
        {{-- enter search radius --}}
        <div class="form-group col-lg-4 col-lg-offset-4">
            <input type="text" class="form-control" placeholder="Search Radius (miles)" id="radius">
        </div>

        {{-- submit button --}}
        <div class="form-group col-lg-4 col-lg-offset-4">
            <button class="btn btn-primary" onclick="submit()">Submit</button>
        </div>
    </div>

@endsection
