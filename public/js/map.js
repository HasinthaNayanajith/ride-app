// Initialize and add the map
let map;

async function initMap() {
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  // Try to get the user's current location
  navigator.geolocation.getCurrentPosition(
    (position) => {
      // The location of the user
      const userPosition = {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
      };

      getAddressFromLatLng(userPosition.lat, userPosition.lng);
      console.log("User's location: ", userPosition);

      // The map, centered at the user's location
      map = new Map(document.getElementById("map"), {
        zoom: 14,
        center: userPosition,
        mapId: "DEMO_MAP_ID",
      });

      // The marker, positioned at the user's location
      const marker = new AdvancedMarkerElement({
        map: map,
        position: userPosition,
        title: "Your Location",
      });
    },
    () => {
      // Handle errors or default to a specific location
      console.error(
        "Error getting user location. Defaulting to Kurunegala, Sri Lanka."
      );

      // The location of Kurunegala, Sri Lanka
      const defaultPosition = { lat: 7.4712, lng: 80.3548 };

      // The map, centered at Kurunegala, Sri Lanka
      map = new Map(document.getElementById("map"), {
        zoom: 14,
        center: defaultPosition,
        mapId: "DEMO_MAP_ID",
      });

      // The marker, positioned at Kurunegala, Sri Lanka
      const marker = new AdvancedMarkerElement({
        map: map,
        position: defaultPosition,
        title: "Kurunegala, Sri Lanka",
      });

      // Set up Places Autocomplete for the locationInput field
      const locationInput = document.getElementById("locationInput");
      const autocomplete = new google.maps.places.Autocomplete(locationInput);
      autocomplete.bindTo("bounds", map);

      // Optionally, you can add an event listener to handle the Enter key
      locationInput.addEventListener("keydown", (event) => {
        if (event.key === "Enter") {
          event.preventDefault();
          searchLocation();
        }
      });
    }
  );
}

initMap();

function getAddressFromLatLng(lat, lng) {
  const geocoder = new google.maps.Geocoder();

  const latlng = { lat: parseFloat(lat), lng: parseFloat(lng) };

  geocoder.geocode({ location: latlng }, (results, status) => {
    if (status === "OK") {
      if (results[0]) {
        const address = results[0].formatted_address;
        console.log("Address:", address);

        // You can use the obtained address in your application as needed
      } else {
        console.error("No results found");
      }
    } else {
      console.error("Geocoder failed due to:", status);
    }
  });
}

// Function to search for a location using Places Autocomplete
function searchLocation() {
  const locationInput = document.getElementById("locationInput");
  const locationName = locationInput.value;

  if (locationName.trim() === "") {
    alert("Please enter a location name");
    return;
  }

  const geocoder = new google.maps.Geocoder();

  // Use Places Autocomplete to get location details
  const placesService = new google.maps.places.PlacesService(map);

  placesService.findPlaceFromQuery(
    { query: locationName, fields: ["geometry"] },
    (results, status) => {
      if (status === "OK" && results && results.length > 0) {
        const location = results[0].geometry.location;
        map.setCenter(location);

        // Optionally, you can add a marker for the searched location
        const marker = new google.maps.Marker({
          map: map,
          position: location,
          title: locationName,
        });
      } else {
        alert("Location not found. Please enter a valid location name.");
      }
    }
  );
}
