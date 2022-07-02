<script>
  import { Link } from "../";

  export let href = "";
</script>

<Link {href} className="underline-button">
  <slot />
</Link>

<style>
  :global(.underline-button) {
    text-decoration: none;
    font: var(--roboto-l-b);
    color: var(--p01);
    border-bottom: 4px solid var(--p01);
    padding: 8px 0px;
    transition: 0.3s ease-in-out;
  }

  :global(.underline-button:hover) {
    color: var(--p03);
    border-color: var(--p03);
  }

  @media (max-width: 400px) {
    :global(.underline-button) {
      font: var(--roboto-m);
    }
  }
</style>
