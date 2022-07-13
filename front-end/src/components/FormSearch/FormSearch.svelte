<script>
  import Search from "../../assets/svg/Search.svelte";
  import Send from "../../assets/svg/Send.svelte";

  // Atributes
  export let id = "";
  export let type = "add";
  export let placeholder = "";
  export let className = "";
  export let disabled = false;
  export let maxWidth = "100%";
  export let value = null;

  // Events
  export let setValue = () => {};
  export let onClick = () => {};
</script>

<div class={`field-container ${className}`} style={`max-width: ${maxWidth}`}>
  <input
    {id}
    name={id}
    type="search"
    {placeholder}
    {value}
    {disabled}
    class="search-field"
    on:keypress={({ target }) => setValue(target.value)}
    on:change={({ target }) => setValue(target.value)}
    on:blur={({ target }) => setValue(target.value)}
  />
  <button
    class="search-button"
    type="button"
    on:click={(event) => {
      event.preventDefault();
      onClick();
    }}
  >
    {#if type === "add"}
      <Search />
    {:else}
      <Send />
    {/if}
  </button>
</div>

<style>
  .field-container {
    position: relative;
    width: 100%;
  }

  .search-field {
    min-height: 48px;
    width: 100%;
    min-width: 300px;
    padding: 0px 10px;
    background: var(--c01);
    border: 1px solid var(--c02);
    border-radius: 5px;
    font: var(--roboto-s);
    color: var(--c11);
    transition: 0.3s;
  }

  .search-field::placeholder {
    font: var(--roboto-s);
    color: var(--c07);
  }

  .search-field:focus,
  .search-field:hover {
    outline: none;
    border-color: var(--p02);
    box-shadow: 0px 0px 0px 2px var(--p01);
  }

  .label-form {
    font: var(--poppins-s);
    font-weight: 500;
    color: var(--c11);
  }

  .search-button {
    position: absolute;
    top: 1px;
    right: 0px;
    border-radius: 5px;
    padding: 5px 11px;
    background-image: var(--gdr01);
    border: none;
    cursor: pointer;
  }

  :global(.search-button:hover > svg > *) {
    transition: 0.3s;
    fill: var(--w);
  }
</style>
