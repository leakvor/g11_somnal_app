<template>
  <div>
    <NavBar />
    <div>
      <div class="container mt-3">
        <div class="button-input-wrapper">
          <button class="btn" @click="fetchCompanies">All companies</button>
          <button class="btn" @click="resetMap">Start to destination Again</button>
          <div class="distance-input-wrapper">
            <label for="distanceInput" class="form-label" style="color: black">Put the distance: (km):</label>
            <input
              id="distanceInput"
              v-model.number="selectedDistance"
              type="number"
              min="0"
              step="0.1"
              placeholder="e.g., 1.5"
              class="form-control"
            />
          </div>
        </div>
        <hr />
      </div>

      <div id="map">
        <input
          type="text"
          v-model="searchQuery"
          style="font-size: 17px"
          @input="suggestLocations"
          placeholder="Search for a location in Cambodia"
        />
        <ul v-if="suggestions.length > 0" id="suggestions-list">
          <li
            v-for="(suggestion, index) in suggestions"
            :key="index"
            @click="selectSuggestion(suggestion)"
          >
            {{ suggestion.display_name }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import NavBar from '../../../Components/NavBar.vue'
import { ref, onMounted, watchEffect } from 'vue'
import leaflet from 'leaflet'
import axios from 'axios'
import 'leaflet-routing-machine'
import { useGeolocation } from '@vueuse/core'
import { userMarker } from '../../../stores/map-store'

const searchQuery = ref('')
const suggestions = ref([])
const selectedDistance = ref(0) // Default distance to 0
const { coords, error } = useGeolocation()
let map: leaflet.Map
let userGeoMarker: leaflet.Marker | null = null
let companyMarkers: leaflet.Marker[] = []
let routingControl: any = null
let companies: any[] = []

const simplePointIcon = leaflet.divIcon({
  className: 'custom-div-icon',
  html: '<div style="background-color: #000; width: 12px; height: 12px; border-radius: 50%;"></div>',
  iconSize: [12, 12],
  iconAnchor: [6, 6]
})

onMounted(() => {
  initializeMap()
})

watchEffect(() => {
  if (error.value) {
    console.error('Error getting user location:', error.value)
    return
  }
  updateGeoMarker()
})

function initializeMap() {
  map = leaflet.map('map').setView([userMarker.value.latitude, userMarker.value.longitude], 13)
  leaflet
    .tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    })
    .addTo(map)
  getNearbyCompanies()
}

function updateGeoMarker() {
  if (
    coords.value.latitude !== Number.POSITIVE_INFINITY &&
    coords.value.longitude !== Number.POSITIVE_INFINITY
  ) {
    userMarker.value.latitude = coords.value.latitude
    userMarker.value.longitude = coords.value.longitude
    if (userGeoMarker) {
      map.removeLayer(userGeoMarker)
    }
    userGeoMarker = leaflet
      .marker([userMarker.value.latitude, userMarker.value.longitude])
      .addTo(map)
      .bindPopup('User Marker')
    map.setView([userMarker.value.latitude, userMarker.value.longitude], 13)
    const el = userGeoMarker.getElement()
    if (el) {
      el.style.filter = 'hue-rotate(120deg)'
    }
    // Fetch companies based on distance when location is updated
    if (selectedDistance.value > 0) {
      getNearbyCompanies()
    } else {
      fetchCompanies()
    }
  }
}

function getNearbyCompanies() {
  axios
    .post('http://127.0.0.1:8000/api/company/near', {
      latitude: userMarker.value.latitude,
      longitude: userMarker.value.longitude,
      distance: selectedDistance.value
    })
    .then((response) => {
      const nearbyCompanies = response.data
      updateMarkers(nearbyCompanies)
    })
    .catch((error) => {
      console.error(error)
    })
}


function fetchCompanies() {
  axios
    .get('http://127.0.0.1:8000/api/company')
    .then((response) => {
      companies = response.data.data
      console.log(companies)
      updateMarkers(companies)
    })
    .catch((error) => {
      console.error('Error fetching companies:', error)
    })
}

function updateMarkers(companies: any[]) {
  companyMarkers.forEach((marker) => map.removeLayer(marker))
  companyMarkers = []

  companies.forEach((company) => {
    const { latitude, longitude, name } = company
    const lat = parseFloat(latitude)
    const lon = parseFloat(longitude)

    // Check if lat and lon are valid numbers
    if (isNaN(lat) || isNaN(lon)) {
      console.error(`Invalid LatLng object: (${latitude}, ${longitude})`)
      return
    }

    const companyMarker = leaflet
      .marker([lat, lon])
      .addTo(map)
      .bindPopup(`Company: ${name}`)
      .on('click', () =>
        calculateRoute([userMarker.value.latitude, userMarker.value.longitude], [lat, lon], name)
      )
    companyMarkers.push(companyMarker)
  })
}

function suggestLocations() {
  if (searchQuery.value.trim() === '') return
  const searchUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchQuery.value)}&limit=5&addressdetails=1&countrycodes=KH&accept-language=km`
  axios
    .get(searchUrl)
    .then((response) => {
      suggestions.value = response.data
    })
    .catch((error) => {
      console.error('Error suggesting locations:', error)
    })
}

function selectSuggestion(suggestion: any) {
  searchQuery.value = suggestion.display_name
  suggestions.value = []
  const lat = parseFloat(suggestion.lat)
  const lon = parseFloat(suggestion.lon)

  // Check if lat and lon are valid numbers
  if (isNaN(lat) || isNaN(lon)) {
    console.error(`Invalid LatLng object: (${lat}, ${lon})`)
    return
  }

  map.setView([lat, lon], 13)
  const searchMarker = leaflet
    .marker([lat, lon], { icon: simplePointIcon })
    .addTo(map)
    .bindPopup(`Selected Location: ${suggestion.display_name}`)
  searchMarker.openPopup()
  calculateRoute(
    [userMarker.value.latitude, userMarker.value.longitude],
    [lat, lon],
    suggestion.display_name
  )
}

function calculateRoute(start: [number, number], end: [number, number], companyName: string) {
  if (routingControl) {
    map.removeControl(routingControl)
  }
  routingControl = leaflet.Routing.control({
    waypoints: [leaflet.latLng(start[0], start[1]), leaflet.latLng(end[0], end[1])],
    createMarker: function (i, waypoint, n) {
      return leaflet
        .marker(waypoint.latLng, { icon: simplePointIcon })
        .bindPopup(`Waypoint ${i + 1}`)
    },
    lineOptions: {
      styles: [{ color: '#6FA1EC', weight: 4 }]
    },
    show: false, // Disable default route instructions
    addWaypoints: false,
    draggableWaypoints: false,
    routeWhileDragging: false
  }).addTo(map)

  routingControl.on('routesfound', function (e) {
    const routes = e.routes
    const summary = routes[0].summary
    const distanceInKm = summary.totalDistance / 1000
    const travelTimeInMinutes = Math.round(summary.totalTime / 60)
    const directionInfo = `<strong>${companyName}</strong><br>Distance: ${distanceInKm.toFixed(2)} km, Travel time: ${travelTimeInMinutes} minutes`

    // Display the information in a custom popup
    const directionPopup = leaflet
      .popup()
      .setLatLng(end)
      .setContent(`<p>${directionInfo}</p>`)
      .openOn(map)
  })
  customizeRouteInstructionsStyle()
}


function customizeRouteInstructionsStyle() {
  setTimeout(() => {
    const routeInstructionsContainers = document.querySelectorAll('.leaflet-routing-container')
    routeInstructionsContainers.forEach((container) => {
      container.style.backgroundColor = 'orange'
      container.style.color = 'white'
      container.style.padding = '10px'
      container.style.borderRadius = '5px'
      container.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.2)'
      container.style.fontSize = '15px'
      container.style.maxHeight = '50vh' // Limit the height to 50% of the viewport height
      container.style.overflowY = 'auto' 
      container.style.marginTop= '80px' 
      const links = container.querySelectorAll('a')
      links.forEach((link) => {
        link.style.color = 'white'
      })
    })
  }, 1000)
}

function resetMap() {
  // Clear routing and recenter the map
  if (routingControl) {
    map.removeControl(routingControl)
    routingControl = null
  }
  if (userGeoMarker) {
    map.setView([userMarker.value.latitude, userMarker.value.longitude], 13)
  }
  fetchCompanies()
}
</script>

<style scoped>
.button-input-wrapper {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 12px;
  flex-wrap: wrap;
  width: 100%;
}

.distance-input-wrapper {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}

.btn {
  background-color: #177245;
  color: white;
  border: none;
  padding: 10px 16px;
  cursor: pointer;
}

.btn:hover {
  background-color: #0f5c36;
}

.form-label {
  margin-bottom: 0;
}

.form-control {
  width: 140px;
  display: inline-block;
}

.search-input {
  font-size: 17px;
  padding: 5px;
}

hr {
  border: 1px solid #ccc;
  margin: 20px 0;
}
.container{
  display: flex;
  flex-direction: column;
  align-items: center;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 8px 22px rgba(31, 41, 51, 0.09);
  padding: 16px;
}
.custom-div-icon {
  background-color: #000;
  width: 12px;
  height: 12px;
  border-radius: 50%;
}
#suggestions-list {
  position: absolute;
  top: 58px;
  left: 50%;
  transform: translateX(-50%);
  background-color: #fff;
  border: 1px solid #dfe7dc;
  padding: 6px;
  list-style: none;
  margin: 0;
  width: min(420px, calc(100% - 32px));
  z-index: 1000;
  color: black;
  border-radius: 8px;
  box-shadow: 0 12px 32px rgba(31, 41, 51, 0.14);
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
  height: calc(100vh - 158px);
  min-height: 520px;
  margin-top: 16px;
}

input[type='text'] {
  position: absolute;
  top: 14px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 1000;
  width: min(420px, calc(100% - 32px));
  padding: 11px 14px;
  border: 1px solid #dfe7dc;
  border-radius: 8px;
  box-shadow: 0 8px 22px rgba(31, 41, 51, 0.12);
}

@media (max-width: 768px) {
  .button-input-wrapper {
    align-items: stretch;
  }

  .button-input-wrapper .btn,
  .distance-input-wrapper,
  .form-control {
    width: 100%;
  }

  #map {
    height: calc(100vh - 240px);
    min-height: 460px;
  }
}
</style>
