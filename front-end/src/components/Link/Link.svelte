<script>
  import { link } from "svelte-routing";
  export let href = "";
  export let className = "";
</script>

<a {href} use:link class={className}>
  <slot />
</a>

<style>
  a {
    color: #4892bc;
    text-decoration: none;
  }
</style>
