<script>
  import { Loader } from "@googlemaps/js-api-loader";
  import MarkerSvg from "../../assets/svg/Marker.svg";

  export let id = "";
  export let className = "";
  export let width = "100%";
  export let height = "";
  export let markerName = "";
  export let value = null;
  export let zoomControl = true;
  export let disableMarker = false;
  export let setValue = () => {};
  export let onZoomChange = () => {};

  // init map api
  const loader = new Loader({
    apiKey: "",
    version: "weekly",
    language: "pt-BR",
  });

  function initMap() {
    loader.load().then(() => {
      const target = document.getElementById(id);
      let marker = null;

      // Creating map
      const map = new google.maps.Map(target, {
        center: { lat: 0, lng: 0 },
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoomControl: zoomControl,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: true,
      });

      // Set default value
      if (!!value) {
        map.setCenter({ lat: value.latitude, lng: value.longitude });
        map.setZoom(value.zoom);
        marker = new google.maps.Marker({
          position: { lat: value.latitude, lng: value.longitude },
          map,
          icon: MarkerSvg,
          title: markerName,
        });
      } else {
        navigator.geolocation.getCurrentPosition(({ coords }) => {
          map.setCenter({ lat: coords.latitude, lng: coords.longitude });
        });
      }

      // On change zoom
      google.maps.event.addListener(map, "zoom_changed", () => {
        const zoom = map.getZoom();
        onZoomChange(zoom);
      });

      // Add markers
      if (!disableMarker) {
        google.maps.event.addListener(map, "click", (event) => {
          const coordinate = event.latLng;
          const lat = coordinate.lat();
          const lng = coordinate.lng();
          const zoom = map.getZoom();

          if (!!marker) marker.setMap(null);

          marker = new google.maps.Marker({
            position: { lat, lng },
            map,
            icon: MarkerSvg,
            title: markerName,
          });

          // Removing markers
          marker.addListener("dblclick", () => {
            if (!!marker) {
              marker.setMap(null);
              marker = null;
            }
          });

          setValue(lat, lng, zoom);
        });
      }
    });

    return "";
  }
</script>

<div
  {id}
  class={`map ${className}`}
  style={`height: ${height}; width: ${width};`}
/>
{initMap()}

<style>
  .map {
    width: 100%;
    border-radius: 5px;
    border: 1px solid var(--c03);
  }
</style>
