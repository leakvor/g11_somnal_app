import { useLocalStorage } from "@vueuse/core";

type Marker = {
  latitude: number;
  longitude: number;
};

const userMarker = useLocalStorage<Marker>("USER_MARKER", {
  latitude: 11.5565521,
  longitude: 104.88805006,
});

const nearbyMarkers = useLocalStorage<Marker[]>("NEARBY_MARKERS", []);

export { userMarker, nearbyMarkers };