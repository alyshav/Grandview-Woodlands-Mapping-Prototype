////////////////////////////////////////////
//EDIT THESE VARIABLES FOR REPORT SECTIONS//
var reportTypeNames = ["Wildlife", "Public Safety", "Maintenance"];

//The following coloured icons are from https://github.com/pointhi/leaflet-color-markers
var redIcon = new L.Icon({
	iconUrl: 'img/markers/marker-icon-2x-red.png',	
	iconSize: [25, 41],
	iconAnchor: [12, 41],
	popupAnchor: [1, -34],
	shadowSize: [41, 41]
});

var greenIcon = new L.Icon({
	iconUrl: 'img/markers/marker-icon-2x-green.png',
	iconSize: [25, 41],
	iconAnchor: [12, 41],
	popupAnchor: [1, -34],
	shadowSize: [41, 41]
});

var orangeIcon = new L.Icon({
	iconUrl: 'img/markers/marker-icon-2x-orange.png',
	iconSize: [25, 41],
	iconAnchor: [12, 41],
	popupAnchor: [1, -34],
	shadowSize: [41, 41]
});

var incidentMarker = [greenIcon, redIcon, orangeIcon]; //colours for each type of incident
// end coloured icons section



////////////////////////////////////////////

//MAP VARIABLES
var map, newUser, users, mapBaseLayer, firstLoad;

firstLoad = true;

//Initialize users layer
//users = new L.MarkerClusterGroup({spiderfyOnMaxZoom: true, showCoverageOnHover: false, zoomToBoundsOnClick: true}); //FOR CLUSTERING
users = new L.FeatureGroup(); //FOR INDEPENDENT MARKERS

//Initialize new users layer
newUser = new L.LayerGroup();

//Intialize the map base layer with access tokens from mapbox (from Alysha van Duynhoven)
mapBaseLayer = new L.TileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    id: 'alyshav.03a86948',
    accessToken: 'pk.eyJ1IjoiYWx5c2hhdiIsImEiOiJjaW8wb2Nkc3ExOXRvdWFtMzZqYTllZDYxIn0.XgrSGZOvsg7owYCGCikM4g'
});

//Initialize map with layers from above, the center being the Grandview Woodland area
map = new L.Map('map', {
    center: new L.LatLng(49.275, -123.067),
    zoom: 3,
    layers: [mapBaseLayer, users, newUser]
}).setView([49.275, -123.063], 15);

//TODO: why does this only show up when you start to scroll in the map?
map.addControl(new L.Control.Scale());

function initRegistration() {
    map.addEventListener('click', onMapClick);
    $('#map').css('cursor', 'crosshair');
    return false;
}

function cancelRegistration() {
    newUser.clearLayers();
    $('#map').css('cursor', '');
    map.removeEventListener('click', onMapClick);
}

//GET USERS: displays ALL entries stored in the database on the map
function getUsers() {
    $.getJSON("get_users.php", {}, function (data) {
        console.log("data: ", data);
        for (var i = 0; i < data.length; i++) {
                
            var location = new L.LatLng(data[i].latitude, data[i].longitude);

            var reportType = reportTypeNames[parseInt(data[i].reportType)-1];
            var reportDate = data[i].reportDate;
            var incidentType = data[i].incidentType;
            var reportDescription = data[i].incidentDescription;

            var title = "<div style='font-size: 12px; '><b>Type: </b>"+ reportType + "</a></div>";
            var incident = "<div style='font-size: 12px;'><b>Incident: </b>" + incidentType + "</div>";
            var date = "<div style='font-size: 12px;'><b>Date: </b>" + reportDate + "</div>";            
            var description = "<div style='font-size: 12px;'><b>Description: </b>" + reportDescription + "</div>";  

            var marker = new L.Marker(location, {
                title: reportType,
                icon: incidentMarker[parseInt(data[i].reportType)-1]
            });
            marker.bindPopup("<div style='text-align: center; margin-left: auto; margin-right: auto;'>" + title + incident + date + description + "</div>", { maxWidth: '400' });
            users.addLayer(marker);
        }
    }).complete(function () {
        if (firstLoad == true) {
            map.fitBounds(users.getBounds());
            firstLoad = false;
        };
    });
} //end getUsers

function insertUser() {
    $("#loading-mask").show();
    $("#loading").show();
    var name = $("#name").val();
    var email = $("#email").val();
    var website = $("#website").val();
    var city = $("#city").val();
    var lat = $("#lat").val();
    var lng = $("#lng").val();
    if (name.length == 0) {
        alert("Name is required!");
        return false;
    }
    if (email.length == 0) {
        alert("Email is required!");
        return false;
    }
    var dataString = 'reportDescription='+ name + '&email=' + email + '&website=' + website + '&city=' + city + '&latitude=' + lat + '&longitude=' + lng;
    $.ajax({
        type: "POST",
        url: "insert_user.php",
        data: dataString,
        success: function() {
        cancelRegistration();
        users.clearLayers();
        getUsers();
        $("#loading-mask").hide();
        $("#loading").hide();
        $('#insertSuccessModal').modal('show');
        }
    });
    return false;
}

      function removeUser() {
        var email = $("#email_remove").val();
        var token = $("#token_remove").val();
        if (email.length == 0) {
          alert("Email is required!");
          return false;
        }
        if (token.length == 0) {
          alert("Token is required!");
          return false;
        }
        var dataString = 'email='+ email + '&token=' + token;
        $.ajax({
          type: "POST",
          url: "remove_user.php",
          data: dataString,
          success: function(data) {
            //console.log(data);
            if (data > 0) {
              $('#removemeModal').modal('hide');
              users.clearLayers();
              getUsers();
              $('#removeSuccessModal').modal('show');
            }
            else {
              alert("Incorrect email or token. Please try again.");
            }
          }
        });
        return false;
      }

      function onMapClick(e) {
        var markerLocation = new L.LatLng(e.latlng.lat, e.latlng.lng);
        var marker = new L.Marker(markerLocation);
        newUser.clearLayers();
        newUser.addLayer(marker);
        var form =  '<form id="inputform" enctype="multipart/form-data" class="well">'+
              '<label><strong>Name:</strong> <i>marker title</i></label>'+
              '<input type="text" class="span3" placeholder="Required" id="name" name="name" />'+
              '<label><strong>Email:</strong> <i>never shared</i></label>'+
              '<input type="text" class="span3" placeholder="Required" id="email" name="email" />'+
              '<label><strong>City:</strong></label>'+
              '<input type="text" class="span3" placeholder="Optional" id="city" name="city" />'+
              '<label><strong>Website:</strong></label>'+
              '<input type="text" class="span3" placeholder="Optional" id="website" name="website" value="http://" />'+
              '<input style="display: none;" type="text" id="lat" name="lat" value="'+e.latlng.lat.toFixed(6)+'" />'+
              '<input style="display: none;" type="text" id="lng" name="lng" value="'+e.latlng.lng.toFixed(6)+'" /><br><br>'+
              '<div class="row-fluid">'+
                '<div class="span6" style="text-align:center;"><button type="button" class="btn" onclick="cancelRegistration()">Cancel</button></div>'+
                '<div class="span6" style="text-align:center;"><button type="button" class="btn btn-primary" onclick="insertUser()">Submit</button></div>'+
              '</div>'+
              '</form>';
        marker.bindPopup(form).openPopup();
      }