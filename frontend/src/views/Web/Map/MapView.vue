<template>
  <div id="map"></div>
</template>

<script setup lang="ts">
import leaflet from "leaflet";
import { onMounted, watchEffect } from "vue";
import { useGeolocation } from "@vueuse/core";
import axios from "axios"; 

import { userMarker } from "../../../stores/map-store";

const { coords, error } = useGeolocation();

let map: leaflet.Map;
let userGeoMarker: leaflet.Marker;
let companyMarkers: leaflet.Marker[] = [];

onMounted(() => {
  map = leaflet
   .map("map")
   .setView([userMarker.value.latitude, userMarker.value.longitude], 13);

  leaflet
   .tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 19,
      attribution:
        '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    })
   .addTo(map);

  // Make API request to retrieve nearby companies
  getNearbyCompanies();
});

watchEffect(() => {
  if (error.value) {
    console.error("Error getting user location:", error.value);
    return;
  }

  if (
    coords.value.latitude!== Number.POSITIVE_INFINITY &&
    coords.value.longitude!== Number.POSITIVE_INFINITY
  ) {
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
});

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
</script>

<style scoped>
#map {
  width: 100%;
  height: 100vh;
}
</style>