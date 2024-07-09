import { useLocalStorage } from "@vueuse/core";


type Marker = {
  latitude: number;
  longitude: number;
};

const userMarker = useLocalStorage<Marker>("USER_MARKER", {
  latitude: 0,
  longitude: 0,
});

const nearbyMarkers = useLocalStorage<Marker[]>("NEARBY_MARKERS", []);

export { userMarker, nearbyMarkers };