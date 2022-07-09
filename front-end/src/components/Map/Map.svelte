<script>
  import { Loader } from "@googlemaps/js-api-loader";

  export let id = "";
  export let className = "";
  export let markerName = "";
  export let value = null;
  export let setValue = () => {};

  // init map api
  const loader = new Loader({
    apiKey: "AIzaSyCQ9IYFRX0SvZ2GD3mdAeXl_KVrgQG4Wbw",
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
        zoomControl: true,
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
          title: markerName,
        });
      } else {
        navigator.geolocation.getCurrentPosition(({ coords }) => {
          map.setCenter({ lat: coords.latitude, lng: coords.longitude });
        });
      }

      // Add markers
      google.maps.event.addListener(map, "click", (event) => {
        const coordinate = event.latLng;
        const lat = coordinate.lat();
        const lng = coordinate.lng();
        const zoom = map.getZoom();

        if (!!marker) marker.setMap(null);

        marker = new google.maps.Marker({
          position: { lat, lng },
          map,
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
    });

    return "";
  }
</script>

<div {id} class={`map ${className}`} />
{initMap()}

<style>
  .map {
    width: 100%;
    height: 300px;
    border-radius: 5px;
    border: 1px solid var(--c03);
  }
</style>
