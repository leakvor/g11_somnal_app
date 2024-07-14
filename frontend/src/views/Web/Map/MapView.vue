<template>
  <div>
    <input type="text" v-model="searchQuery" @input="suggestLocations" placeholder="Search for a location in Cambodia" />
    <div id="map"></div>
    <ul v-if="suggestions.length > 0" id="suggestions-list">
      <li v-for="(suggestion, index) in suggestions" :key="index" @click="selectSuggestion(suggestion)">
        {{ suggestion.display_name }}
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, watchEffect } from 'vue';
import leaflet from 'leaflet';
import axios from 'axios';
import { useGeolocation } from '@vueuse/core';
import { userMarker } from '../../../stores/map-store';

const searchQuery = ref('');
const suggestions = ref([]);
const { coords, error } = useGeolocation();
let map: leaflet.Map;
let userGeoMarker: leaflet.Marker | null = null;
let companyMarkers: leaflet.Marker[] = [];

// Create a green marker icon
const greenIcon = leaflet.icon({
  iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-green.png',
  shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',
  iconSize: [38, 95],
  shadowSize: [50, 64],
  iconAnchor: [22, 94],
  shadowAnchor: [4, 62],
  popupAnchor: [-3, -76]
});

onMounted(() => {
  initializeMap();
});

watchEffect(() => {
  if (error.value) {
    console.error('Error getting user location:', error.value);
    return;
  }

  updateGeoMarker();
});

function initializeMap() {
  map = leaflet.map('map').setView([userMarker.value.latitude, userMarker.value.longitude], 13);

  leaflet.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);

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

    userGeoMarker = leaflet.marker([userMarker.value.latitude, userMarker.value.longitude])
      .addTo(map)
      .bindPopup('User Marker');

    map.setView([userMarker.value.latitude, userMarker.value.longitude], 13);

    const el = userGeoMarker.getElement();
    if (el) {
      el.style.filter = 'hue-rotate(120deg)';
    }

    // Remove existing company markers
    companyMarkers.forEach(marker => map.removeLayer(marker));
    companyMarkers = [];

    // Make API request to retrieve nearby companies again
    getNearbyCompanies();
  }
}

function getNearbyCompanies() {
  axios.post('http://127.0.0.1:8000/api/company/near', {
    latitude: userMarker.value.latitude,
    longitude: userMarker.value.longitude,
  }).then(response => {
    const nearbyCompanies = response.data;
    nearbyCompanies.forEach(company => {
      const { latitude, longitude, name } = company;
      const lat = parseFloat(latitude);
      const lon = parseFloat(longitude);
      const companyMarker = leaflet.marker([lat, lon])
        .addTo(map)
        .bindPopup(`Company: ${name} (<strong>${lat.toFixed(2)},${lon.toFixed(2)}</strong>)`);

      companyMarkers.push(companyMarker);
    });
  }).catch(error => {
    console.error(error);
  });
}

function suggestLocations() {
  if (searchQuery.value.trim() === '') return;

  const searchUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchQuery.value)}&limit=5&addressdetails=1`;

  axios.get(searchUrl)
    .then(response => {
      suggestions.value = response.data;
    })
    .catch(error => {
      console.error('Error suggesting locations:', error);
    });
}

function selectSuggestion(suggestion: any) {
  searchQuery.value = suggestion.display_name;
  suggestions.value = [];
  const lat = parseFloat(suggestion.lat);
  const lon = parseFloat(suggestion.lon);
  map.setView([lat, lon], 13);

  // Add a marker for the selected suggestion with the green icon
  const searchMarker = leaflet.marker([lat, lon], { icon: greenIcon })
    .addTo(map)
    .bindPopup(`Selected Location: ${suggestion.display_name}`);

  searchMarker.openPopup();
}
</script>

<style scoped>
#suggestions-list {
  position: absolute;
  top: 40px;
  left: 50%;
  transform: translateX(-50%);
  background-color: #fff;
  border: 1px solid #ddd;
  padding: 10px;
  list-style: none;
  margin: 0;
  width: 300px;
  z-index: 1000;
  color: black;
}

#suggestions-list li {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  cursor: pointer;
  color: black;
}

#suggestions-list li:hover {
  background-color: #f0f0f0;
  color: black;
}

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
