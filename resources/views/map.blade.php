<x-layout>
<div class="container">
    <div id="map"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"
            integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    var marker, map, allMarkers = [];

    //Create a function creates a button that controls the filtering of requests on the map.
    function createFireFilter(map, allMarkers){
        // Create a button html tag to trigger the event for the filtering
        const fireControlButton = document.createElement("button");

        // This sets the CSS for the button control
        fireControlButton.style.backgroundColor = "#fff"; //set the background color for the button control white
        fireControlButton.style.border = "2px solid #fff"; // sets 2px thickness of border that is also white
        fireControlButton.style.borderRadius = "3px"; //this gives the button a bit of a rounder look around its egdes
        fireControlButton.style.boxShadow = "0 2px 6px rgba(0,0,0,0.3)"; //this puts a shadow of 30% opacity of the hue black
        fireControlButton.style.color = "#323232";  //sets the font color of the button control 
        fireControlButton.style.cursor = "pointer"; //sets the cursor when on hover to a pointer one
        fireControlButton.style.fontFamily = "Roboto, sans-serif"; //set the family font style
        fireControlButton.style.lineHeight = "38px";
        fireControlButton.style.margin = "15px 20px";
        fireControlButton.style.padding = " 0 5px";
        fireControlButton.style.textAlign = "center";   

        fireControlButton.textContent = "Only Fire";
        fireControlButton.title = "Click to display only fire emergency requests.";
        fireControlButton.type = "button";
        
        // Setup the click eent listeners
        fireControlButton.addEventListener("click", () => {
            // fireControlButton.style.backgroundColor = "#f4f4f4";
            displayAllMarkers(allMarkers)
            allMarkers.forEach(marker =>{
                if(marker['title'] != 'Fire'){
                    marker.setVisible(false)
                }
            })
        });

        return fireControlButton;

    }

    function createMedicalFilter(map, allMarkers){
        const medicalControlButton = document.createElement("button");

        medicalControlButton.style.backgroundColor = "#fff"; 
        medicalControlButton.style.border = "2px solid #fff";
        medicalControlButton.style.borderRadius = "3px";
        medicalControlButton.style.boxShadow = "0 2px 6px rgba(0,0,0,0.3)";
        medicalControlButton.style.color = "#323232";
        medicalControlButton.style.cursor = "pointer";
        medicalControlButton.style.fontFamily = "Roboto, sans-serif";
        medicalControlButton.style.lineHeight = "38px";
        medicalControlButton.style.margin = "5px 20px";
        medicalControlButton.style.padding = " 0 5px";
        medicalControlButton.style.textAlign = "center";   

        medicalControlButton.textContent = "Only Medical";
        medicalControlButton.title = "Click to display only fire emergency requests.";
        medicalControlButton.type = "button";

        
        medicalControlButton.addEventListener("click", () => {
            displayAllMarkers(allMarkers)
            allMarkers.forEach(marker =>{
                if(marker['title'] != 'Medical'){
                    marker.setVisible(false)
                }
            })
        });

        return medicalControlButton;

    }

    function createPoliceFilter(map, allMarkers){
        const policeControlButton = document.createElement("button");

        policeControlButton.style.backgroundColor = "#fff"; 
        policeControlButton.style.border = "2px solid #fff";
        policeControlButton.style.borderRadius = "3px";
        policeControlButton.style.boxShadow = "0 2px 6px rgba(0,0,0,0.3)";
        policeControlButton.style.color = "#323232";
        policeControlButton.style.cursor = "pointer";
        policeControlButton.style.fontFamily = "Roboto, sans-serif";
        policeControlButton.style.lineHeight = "38px";
        policeControlButton.style.margin = "15px 20px";
        policeControlButton.style.padding = " 0 5px";
        policeControlButton.style.textAlign = "center";   

        policeControlButton.textContent = "Only Police";
        policeControlButton.title = "Click to display only fire emergency requests.";
        policeControlButton.type = "button";
        policeControlButton.addEventListener("click", () => {
            displayAllMarkers(allMarkers)
            allMarkers.forEach(marker =>{
                if(marker['title'] != 'Police'){
                    marker.setVisible(false)
                }
            })
        });

        return policeControlButton;
    }

    function createResetFilter(map, allMarkers){
        const resetControlButton = document.createElement("button");

        resetControlButton.style.backgroundColor = "#fff"; 
        resetControlButton.style.border = "2px solid #fff";
        resetControlButton.style.borderRadius = "3px";
        resetControlButton.style.boxShadow = "0 2px 6px rgba(0,0,0,0.3)";
        resetControlButton.style.color = "#323232";
        resetControlButton.style.cursor = "pointer";
        resetControlButton.style.fontFamily = "Roboto, sans-serif";
        resetControlButton.style.lineHeight = "38px";
        resetControlButton.style.margin = "5px 20px";
        resetControlButton.style.padding = " 0 5px";
        resetControlButton.style.textAlign = "center";   

        resetControlButton.textContent = "Reset";
        resetControlButton.title = "Click to reset filters.";
        resetControlButton.type = "button";

        resetControlButton.addEventListener("click", () => {
            displayAllMarkers(allMarkers)
        });

        return resetControlButton;
    }

    //Created a separate function that 
    //sets each markers visibility to "true"
    function displayAllMarkers(allMarkers){
        allMarkers.forEach(marker =>{
                    marker.setVisible(true)
            })
    }

    function initMap(){
        var options = {
            center: {lat: 10.315724, lng:123.885419},
            zoom: 13,
            mapId: 'd1718992514fbee0',
            disableDefaultUI: true, //removes all default controls from the map
            zoomControl: true, //displays zoom in and zoom out control on map
            scaleControl: true // displays scaling measurements on map
        }
        map =  new google.maps.Map(document.getElementById('map'), options);
        
        //Create a DIV to attach control UI to the map.
        const fireFilterControlDiv = document.createElement("div")
        const medicalFilterControlDiv = document.createElement("div")
        const policeFilterControlDiv = document.createElement("div")
        const resetFilterControlDiv = document.createElement("div")

        //Create the control. This code calls a function that
        //creates a new instance of a button control.
        const fireFilterControl = createFireFilter(map, allMarkers)
        const medicalFilterControl = createMedicalFilter(map, allMarkers)
        const policeFilterControl = createPoliceFilter(map, allMarkers)
        const resetFilterControl = createResetFilter(map, allMarkers)

        //Append the control to the DIV
        fireFilterControlDiv.appendChild(fireFilterControl)
        medicalFilterControlDiv.appendChild(medicalFilterControl)
        policeFilterControlDiv.appendChild(policeFilterControl)
        resetFilterControlDiv.appendChild(resetFilterControl)

        //Add the control to the map at a designated control position
        //by pushing it on the position's array. This code will
        //implicity add the control to the DOM, through the map
        //object. You should not attach the control manually.
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(fireFilterControlDiv)
        map.controls[google.maps.ControlPosition.LEFT_TOP].push(medicalFilterControlDiv)
        map.controls[google.maps.ControlPosition.LEFT_TOP].push(policeFilterControlDiv)
        map.controls[google.maps.ControlPosition.LEFT_TOP].push(resetFilterControlDiv)
        
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
                    
                    addMarker({lat: lat, lng: lng}, requestType, status); //creates each map marker
                    
                });
            }).catch(err => console.log(err));
        }

        function addMarker(coordinates, type, status){

            // The conditional statement below distinguishes 
            // each markers by request type and assigns 
            // the corresponding marker icon.
            if(type == 'Police'){
                    iconMarker = 'https://img.icons8.com/stickers/100/000000/public-safety.png';
            }else 
            if(type == 'Medical'){
                    iconMarker = 'https://img.icons8.com/stickers/100/000000/doctors-bag.png';
            }else{
                iconMarker = 'https://img.icons8.com/stickers/100/000000/fires.png';
            }

            marker = new google.maps.Marker({
            position: coordinates,
            map: map,
            title: type,
            animation: google.maps.Animation.DROP,
            icon: {
                    url: iconMarker,
                    scaledSize: new google.maps.Size(31,33) // this customly sets the height and width dimensions of all icon markers on map
            },
            }); 
            
            allMarkers.push(marker)

            // console.log(marker['title'])
           
                var infoWindow = new google.maps.InfoWindow({
                    content: 
                    '<b>Request Type: </b><br>'+ type +
                    '<br><b>Assigned Responder:</b> <br>Juan L.'+
                    '<br><b>Request Status: </b><br>'+ status 
                });
                
                marker.addListener('click', function(){
                    infoWindow.open(map,marker);
                })

            }
            console.log(allMarkers)
    }
    
</script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTvsSu0ZGBeOQ_wLQu1Ochqlr8Yd8XPjg&map_ids=d1718992514fbee0&callback=initMap"
  defer
></script>
</x-layout>