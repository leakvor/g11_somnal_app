<template>
    <div>
      <div ref="map" style="width: 500px; height: 300px"></div>
      <input type="text" v-model="searchQuery" placeholder="Search location" />
      <button @click="searchLocation">Search</button>
    </div>
  </template>
  
  <script>
  import { Loader } from '@googlemaps/js-api-loader';
  
  export default {
    data() {
      return {
        map: null,
        searchQuery: '',
      };
    },
    mounted() {
      if (!window.google || !window.google.maps) {
        const loader = new Loader({
          apiKey: 'AIzaSyBn-jl-mAuSTf0JPsvRB7fJgIG6MT2M-Lc',
          version: 'weekly',
        });
  
        loader.load().then(
          (google) => {
            this.initializeMap(google);
          },
          (error) => {
            console.error('Error loading Google Maps:', error);
          }
        );
      } else {
        this.initializeMap(window.google);
      }
    },
    methods: {
      initializeMap(google) {
        this.map = new google.maps.Map(this.$refs.map, {
          center: { lat: 37.7749, lng: -122.4194 },
          zoom: 13,
        });
      },
      searchLocation() {
        if (this.searchQuery.trim() && this.map) {
          const service = new google.maps.places.PlacesService(this.map);
          service.textSearch(
            {
              query: this.searchQuery.trim(),
            },
            (results, status) => {
              if (status === 'OK' && results.length > 0) {
                const marker = new google.maps.Marker({
                  position: results[0].geometry.location,
                  map: this.map,
                  title: results[0].name,
                });
                this.map.setCenter(results[0].geometry.location);
              } else {
                console.error('Error searching for location:', status);
              }
            }
          );
        }
      },
    },
  };
  </script>
  
  
  