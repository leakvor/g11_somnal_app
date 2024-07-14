<template>
  <div>
    <input type="text" v-model="searchQuery" @keypress.enter="searchLocation" placeholder="Search for a location in Cambodia" />
    <div id="map"></div>
  </div>
</template>

<script setup lang="ts">
import leaflet from "leaflet";
import { onMounted, watchEffect, ref } from "vue";
import { useGeolocation } from "@vueuse/core";
import axios from "axios";
import { userMarker } from "../../../stores/map-store";

const { coords, error } = useGeolocation();
let map: leaflet.Map;
let userGeoMarker: leaflet.Marker | null = null;
let companyMarkers: leaflet.Marker[] = [];
const searchQuery = ref("");

// Create a green marker icon
const greenIcon = leaflet.icon({
  iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-green.png',
  shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',
  iconSize: [38, 95], // size of the icon
  shadowSize: [50, 64], // size of the shadow
  iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
  shadowAnchor: [4, 62],  // the same for the shadow
  popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
});

onMounted(() => {
  initializeMap();
});

watchEffect(() => {
  if (error.value) {
    console.error("Error getting user location:", error.value);
    return;
  }
  
  updateGeoMarker();
});

function initializeMap() {
  map = leaflet.map("map").setView([userMarker.value.latitude, userMarker.value.longitude], 13);
  
  leaflet
    .tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    })
    .addTo(map);

  // Make API request to retrieve nearby companies
  getNearbyCompanies();
}

function updateGeoMarker() {
  if (coords.value.latitude !== Number.POSITIVE_INFINITY && coords.value.longitude !== Number.POSITIVE_INFINITY) {
    userMarker.value.latitude = coords.value.latitude;
    userMarker.value.longitude = coords.value.longitude;

    if (userGeoMarker) {
      map.removeLayer(userGeoMarker);
    }

    userGeoMarker = leaflet
      .marker([userMarker.value.latitude, userMarker.value.longitude])
      .addTo(map)
      .bindPopup("User Marker");
    
    map.setView([userMarker.value.latitude, userMarker.value.longitude], 13);
    
    const el = userGeoMarker.getElement();
    if (el) {
      el.style.filter = "hue-rotate(120deg)";
    }

    // Remove existing company markers
    companyMarkers.forEach(marker => map.removeLayer(marker));
    companyMarkers = [];

    // Make API request to retrieve nearby companies again
    getNearbyCompanies();
  }
}

function getNearbyCompanies() {
  axios.post("http://127.0.0.1:8000/api/company/near", {
    latitude: userMarker.value.latitude,
    longitude: userMarker.value.longitude,
  })
  .then(response => {
    const nearbyCompanies = response.data;
    console.log(response.data);
    nearbyCompanies.forEach(company => {
      const { latitude, longitude, name } = company;
      const lat = parseFloat(latitude);
      const lon = parseFloat(longitude);
      const companyMarker = leaflet
        .marker([lat, lon])
        .addTo(map)
        .bindPopup(`Company: ${name} (<strong>${lat.toFixed(2)},${lon.toFixed(2)}</strong>)`);
      
      companyMarkers.push(companyMarker);
    });
  })
  .catch(error => {
    console.error(error);
  });
}

function searchLocation() {
  if (searchQuery.value.trim() === "") return;

  const searchUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchQuery.value)}, Cambodia`;

  axios.get(searchUrl)
    .then(response => {
      if (response.data.length > 0) {
        const location = response.data[0];
        const lat = parseFloat(location.lat);
        const lon = parseFloat(location.lon);
        
        // Update the map to the searched location
        map.setView([lat, lon], 13);

        // Add a marker for the searched location with the green icon
        const searchMarker = leaflet
          .marker([lat, lon], { icon: greenIcon })
          .addTo(map)
          .bindPopup(`Searched Location: ${location.display_name}`);

        searchMarker.openPopup();
      } else {
        alert("Location not found.");
      }
    })
    .catch(error => {
      console.error("Error searching location:", error);
    });
}
</script>

<style scoped>
#map {
  width: 100%;
  height: 100vh;
}
input[type="text"] {
  position: absolute;
  top: 10px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 1000;
  width: 300px;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
</style>
