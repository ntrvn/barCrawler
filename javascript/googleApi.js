function initMap() {
    var map = new google.maps.Map(
        document.querySelector("#map-container"),
        {center: {lat: 34.05,lng: -118.24},
        zoom : 15,
        zoomControl: true,
        styles:
        [{
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#6195a0"
                    }
                ]
            },
            {
                "featureType": "administrative.province",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [
                    {
                        "lightness": "0"
                    },
                    {
                        "saturation": "0"
                    },
                    {
                        "color": "#f5f5f2"
                    },
                    {
                        "gamma": "1"
                    }
                ]
            },
            {
                "featureType": "landscape.man_made",
                "elementType": "all",
                "stylers": [
                    {
                        "lightness": "-3"
                    },
                    {
                        "gamma": "1.00"
                    }
                ]
            },
            {
                "featureType": "landscape.natural.terrain",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#bae5ce"
                    },
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": -100
                    },
                    {
                        "lightness": 45
                    },
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#fac9a9"
                    },
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "color": "#4e4e4e"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#787878"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "transit.station.airport",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "hue": "#0a00ff"
                    },
                    {
                        "saturation": "-77"
                    },
                    {
                        "gamma": "0.57"
                    },
                    {
                        "lightness": "0"
                    }
                ]
            },
            {
                "featureType": "transit.station.rail",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#43321e"
                    }
                ]
            },
            {
                "featureType": "transit.station.rail",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "hue": "#ff6c00"
                    },
                    {
                        "lightness": "4"
                    },
                    {
                        "gamma": "0.75"
                    },
                    {
                        "saturation": "-68"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#eaf6f8"
                    },
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#c7eced"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "lightness": "-49"
                    },
                    {
                        "saturation": "-53"
                    },
                    {
                        "gamma": "0.79"
                    }
                ]
            }
        ]
        }
    );
    var marker = new google.maps.Marker(
        {map: map}
    );
    // map from user input
    document.querySelector("#google-form").onsubmit = function() {
        deleteRow();
        var input = document.querySelector("#address").value.trim();
        infowindow = new google.maps.InfoWindow();
        // turn address to lat and long
        var geocodeObj = new google.maps.Geocoder();
        var service = new google.maps.places.PlacesService(map);
        geocodeObj.geocode(
            {address: input},
            function(results) {
              // move the map to the search location
              map.setCenter(results[0].geometry.location);
              marker.setPosition(results[0].geometry.location);
              var latLng = results[0].geometry.location;
              var request = {
                location: latLng,
                radius: '1000',
                type: ['bar']
              };
              service.textSearch(request, callback);
            }
        );
        return false;
    }
  function callback(results, status) {
    console.log(results);
    if (status == google.maps.places.PlacesServiceStatus.OK) {
      for (var i = 0; i < results.length; i++) {
        var place = results[i];
        createMarker(results[i]);
      }
    }
  }
  function createMarker(place) {
    addRow(place);
    //console.log(place.photos[0].getUrl({'maxWidth': 35, 'maxHeight': 35}));
    var placeLoc = place.geometry.location;
    var imageIcon = {
      url: "http://www.iconarchive.com/download/i97927/flat-icons.com/flat/Beer.ico",
      size: new google.maps.Size(30, 30),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(0, 0),
      scaledSize: new google.maps.Size(30, 30)
    };
    var marker = new google.maps.Marker({
      map: map,
      position: place.geometry.location,
      icon: imageIcon
    });
    google.maps.event.addListener(marker, 'click', function() {
      var content = place.name + "<br>" + place.formatted_address + "<br>" + '<img src="' + place.photos[0].getUrl({'maxWidth': 200, 'maxHeight': 200}) +'" alt="">';
      infowindow.setContent(content);
      infowindow.open(map, this);
    });
  }
  function addRow(place) {
    var div = document.createElement('div');

    var button = document.createElement('button');
    var buttonText = document.createTextNode("add");
    button.appendChild(buttonText);
    button.classList.add("btn");
    button.classList.add("btn-outline-success");
    button.classList.add("my-2");
    button.classList.add("my-sm-0");
    button.classList.add("addButton");

    var text = document.createElement('h5');
    var node = document.createTextNode(place.name);
    text.appendChild(node);
    text.style.color = "#366e51";

    var address = document.createElement('h3');
    var addressText = place.formatted_address;
    var addressNode = document.createTextNode(addressText);
    address.appendChild(addressNode);
    address.style.color = "#366e51";
    address.style.fontSize = "15px";

    var rating = document.createElement('h3');
    var ratingText = "rating: " + place.rating + "/5.0";
    var ratingNode = document.createTextNode(ratingText);
    rating.appendChild(ratingNode);
    rating.style.color = "#366e51";
    rating.style.fontSize = "15px";

    var open = document.createElement('h3');
    var openText = "";
    if (place.opening_hours.open_now == false) {
        openText = "Closed";
        open.style.color = "Red";
    } else {
        openText = "Open";
        open.style.color = "#366e51";
    }
    var openNode = document.createTextNode(openText);
    open.appendChild(openNode);
    open.style.fontSize = "15px";

    var img = document.createElement("img");
    img.src = place.photos[0].getUrl({'maxWidth': 200, 'maxHeight': 200});
    img.style.marginBottom = "5px";

    div.appendChild(button);
    div.appendChild(text);
    div.appendChild(img);
    div.appendChild(address);
    div.appendChild(rating);
    div.appendChild(open);

    div.style.paddingBottom = "20px";
    div.style.paddingTop = "20px";
    div.style.border = "1px solid #366f52";

    document.getElementById('searchResults').appendChild(div);
    var test = document.querySelectorAll('.addButton');
    //console.log("test");
    for (var i = 0; i < test.length; ++i) {
        test[i].onclick = function() {
            var parent = this.parentNode;
            var name = parent.firstChild.nextSibling.innerText;
            var imgURL = parent.firstChild.nextSibling.nextSibling.src;
            var addressSend = parent.firstChild.nextSibling.nextSibling.nextSibling.innerText;
            var ratingSend = parent.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.innerText;
            var openSend = parent.lastChild.innerText;
            var urlSend = '../config/sendData.php?name='+encodeURI(name)+'&img='+imgURL+'&address='+encodeURI(addressSend)+'&rating='+encodeURI(ratingSend)+'&open='+openSend;
            ajaxGet(urlSend, function(results) {
                console.log(results);
            });
        }
    }
  }
  function deleteRow() {
    var myNode = document.getElementById('searchResults');
    while (myNode.firstChild) {
        myNode.removeChild(myNode.firstChild);
    }
  }
  function ajaxGet(endpointUrl, returnFunction){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', endpointUrl, true);
    xhr.onreadystatechange = function(){
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                // Convert JSON string into JS objects
                returnFunction(xhr.responseText);
            } else {
                alert('AJAX Error.');
                console.log(xhr.status);
            }
        }
    }
    xhr.send();
  };

}