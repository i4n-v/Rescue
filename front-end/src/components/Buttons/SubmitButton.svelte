<script>
  import LoadingIcon from "../../assets/svg/LoadingIcon.svelte";
  export let onSubmit = () => {};
  export let maxWidth = "100%";
  export let loading = false;

  export let disabled = false;
</script>

<button
  style={`max-width: ${maxWidth}`}
  class="submit-button"
  {loading}
  {disabled}
  on:click={(event) => {
    event.preventDefault();
    onSubmit();
  }}
>
  {#if loading}
    <LoadingIcon />
  {:else}
    <slot />
  {/if}
</button>

<style>
  .submit-button {
    font: var(--poppins-m);
    color: var(--p05);
    border-radius: 5px;
    border: none;
    background: var(--gdr01);
    padding: 0px 32px;
    height: 56px;
    transition: 0.3s ease-in-out;
    cursor: pointer;
  }

  .submit-button:hover {
    color: var(--w);
  }

  .submit-button:disabled {
    cursor: default;
    opacity: 0.6;
    color: var(--p05);
  }
</style>
