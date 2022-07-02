<script>
  import { Link } from "../";

  export let href = "";
</script>

<Link {href} className="outlined-button">
  <slot />
</Link>

<style>
  :global(.outlined-button) {
    text-decoration: none;
    font: var(--poppins-m);
    color: var(--p01);
    border: 1px solid var(--p01);
    border-radius: 5px;
    padding: 12px 16px;
    transition: 0.3s ease-in-out;
  }

  :global(.outlined-button:hover) {
    background: var(--p01);
    color: var(--w);
  }
</style>
