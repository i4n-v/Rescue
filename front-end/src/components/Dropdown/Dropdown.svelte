<script>
  import { Link } from "../";

  export let display = false;
  export let links = [];
</script>

{#if display}
  <ul id="dropdown">
    {#each links as { href, name }}
      <li>
        <Link {href} className="dropdown-links">{name}</Link>
      </li>
    {/each}
  </ul>
{/if}

<style>
  #dropdown {
    list-style: none;
    position: absolute;
    right: 0;
    bottom: -140px;
    padding: 20px;
    background: var(--c11);
    min-width: 260px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    border-radius: 5px;
    display: none;
    animation: scale 0.3s ease-in;
    z-index: 1000;
  }

  #dropdown::after {
    content: "";
    display: block;
    position: absolute;
    top: -10px;
    right: 2.8px;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: 12px solid var(--c11);
  }

  #dropdown > li {
    width: 100%;
    padding: 0px 8px;
    text-align: center;
  }

  #dropdown > li + li {
    border-top: 2px solid;
    border-color: var(--c10);
  }

  :global(.dropdown-links) {
    font: var(--poppins-m);
    text-decoration: none;
    color: var(--w);
    transition: 0.3s ease-in-out;
  }

  :global(.dropdown-links:hover) {
    color: var(--p01);
  }

  @media (max-width: 700px) {
    #dropdown {
      display: flex;
    }
  }
</style>
