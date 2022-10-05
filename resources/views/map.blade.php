<x-layout>
<div class="container">
    <div id="map"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"
            integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function initMap(){
        var options = {
            zoom: 13,
            center: {lat: 10.315724, lng:123.885419}
        }
        var map =  new google.maps.Map(document.getElementById('map'), options);

        geo()
        function geo(){
        axios.get('/api/requests')
            .then( res => {
                console.log(res);
                res.data.requests.forEach(location => {
                    var requestType = location['requestType']
                    var status = location['status']
                    var lat = parseFloat(location['lat'])
                    var lng = parseFloat(location['lng'])
                    console.log(res.data.requests);

                    addMarker({lat: lat, lng: lng}, requestType, status);
                    
                });
            }).catch(err => console.log(err));
        }

        function addMarker(coordinates, type, status){
            var marker = new google.maps.Marker({
            position: coordinates,
            map: map,
            icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
          
            
            });
                var infoWindow = new google.maps.InfoWindow({
                    content: '<h4>Request Type: '+ type +'</h4><h5>Status: '+ status +'</h5><h5>Responder Name: Juan L.</h5>'
                });

                marker.addListener('click', function(){
                    infoWindow.open(map,marker);
                });
            // // Check for custom icon
            // if(props.iconImage){
            //     marker.setIcon(props.iconImage);
            // }

            // if(props.content){
            //     var infoWindow = new google.maps.InfoWindow({
            //         content: props.content
            //     });

            //     marker.addListener('click', function(){
            //         infoWindow.open(map,marker);
            //     });
            // }

        }
    }
    
</script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTvsSu0ZGBeOQ_wLQu1Ochqlr8Yd8XPjg&callback=initMap"
  defer
></script>
</x-layout>