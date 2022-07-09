<script>
  import { Header, Footer } from "../";
  import { onMount } from "svelte";

  onMount(() => {
    window.scrollTo(0, 0);
  });
</script>

<Header />
<main id="wrapper">
  <slot />
</main>
<Footer />

<style>
  :global(#wrapper) {
    flex: 1;
    position: relative;
  }
</style>
