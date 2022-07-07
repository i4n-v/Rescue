<script>
  import { link } from "svelte-routing";
  export let href = "";
  export let onClick = () => {};
  export let className = "";
</script>

<span on:click={onClick}>
  <a {href} use:link class={className}>
    <slot />
  </a>
</span>
