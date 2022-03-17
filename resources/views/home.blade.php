@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{__('My locations')}}
                </div>
                <div class="card-body">
                    <div class="row" id="map_container">
                        <div id="map" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page-specific-scripts')
    <script>
        function initMap() {
            const locations =  {!! json_encode($userLocations->toArray()) !!};
            let center = locations[0];
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: center,
            });
            for(let i=0 ;i< Object.keys(locations).length ; i++){
                let date = new Date(locations[i].created_at);
                let contentString =
                    '<div class="text-black-50">' +
                    '<h4>'+ locations[i].name +'</h4>' +
                    '<div id="bodyContent">' +
                    '<h6><strong>'+ locations[i].city +'</strong>'+
                    '<strong>, '+ locations[i].state +'</strong>'+
                    '<strong>, '+ locations[i].country +'</strong></h6>'+
                    '<h6>'+ locations[i].street +
                     ', ' + locations[i].zip_code + '</h6>' +
                    '<hr><h6>(Added at:' + date.getDate() + '-' + date.getMonth() + '-' + date.getFullYear()
                    +').</h6>' +'</div>' +
                    "</div>";
                let infoWindow = new google.maps.InfoWindow({
                    content: contentString,
                    position: locations[i],
                });
                let marker = new google.maps.Marker({
                    position: locations[i],
                    map: map,
                });
                marker.addListener('mouseover', function() {
                    infoWindow.open(map, this);
                });
                marker.addListener('mouseout', function() {
                    infoWindow.close();
                });
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_maps_key')}}&callback=initMap&v=weekly" async></script>
@endpush
