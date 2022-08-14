<x-layout>
{{-- <div class="container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d62804.643450013515!2d123.90563839999997!3d10.318643199999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sde!2sph!4v1658670649632!5m2!1sde!2sph" width="2000" height="2000" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div> --}}
<div class="container">
    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d62804.643450013515!2d123.90563839999997!3d10.318643199999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sde!2sph!4v1658670649632!5m2!1sde!2sph" width="2000" height="2000" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
    <div id="map"></div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"
            integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function initMap(){
        var options = {
            zoom: 14,
            center: {lat: 10.315724, lng:123.885419}
        }
        var map =  new google.maps.Map(document.getElementById('map'), options);

        geo()
        function geo(){
        axios.get('/api/requests')
            .then( res => {
                res.data.forEach(location => {
                    var lat = parseFloat(location['lat'])
                    var lng = parseFloat(location['lng'])
                    
                    console.log({lat: lat, lng: lng})
                    addMarker({lat: lat, lng: lng});
                    
                });
            }).catch(err => console.log(err));
        }

        function addMarker(coordinates){
            var marker = new google.maps.Marker({
            position: coordinates,
            map: map,
            icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
          
            
            });
                var infoWindow = new google.maps.InfoWindow({
                    content: '<h4>Request Type: Fire</h4><h5>Status: On Going</h5><h5>Responder Name: Juan L.</h5>'
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
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmBdspnwo8JBNw_XRJre2XgIyH_E_5mRc&callback=initMap"
  defer
></script>
</x-layout>