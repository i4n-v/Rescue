<script>
    import { Link } from "../";
  
    export let href = "";
</script>
  
<Link {href} className="blue-button">
    <slot />
</Link>
  
<style>
    /*:global(.blue-button) {
      text-decoration: none;
      font: var(--poppins-m);
      color: var(--p01);
      border: 1px solid var(--p01);
      border-radius: 5px;
      padding: 12px 16px;
      transition: 0.3s ease-in-out;
    }*/
  
    /*:global(.blue-button:hover) {
      background: var(--p01);
      color: var(--w);
    }*/
    :global(.blue-button) {
        margin: 1rem;
        text-decoration: none;
        font: var(--poppins-m-b);
        background: linear-gradient(180deg, #4892BC 0%, #1F668D 100%);
        color: var(--p05);
        border: 1px solid var(--w);
        border-radius: 5px;
        box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1);
        padding: 16px 32px;
        transition: 0.1s ease-in-out;
    }
    :global(.blue-button:hover) {
        color: var(--p03);
    }
</style>
  