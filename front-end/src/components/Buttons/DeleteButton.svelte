<script>
  export let onClick = () => {};
  export let maxWidth = "100%";

  export let disabled = false;
</script>

<button
  style={`max-width: ${maxWidth}`}
  class="submit-button"
  {disabled}
  on:click={(event) => {
    event.preventDefault();
    onClick();
  }}
>
  <slot />
</button>

<style>
  .submit-button {
    font: var(--poppins-m);
    color: var(--w);
    border-radius: 5px;
    border: none;
    background: var(--v02);
    padding: 0px 32px;
    height: 56px;
    transition: 0.3s ease-in-out;
    cursor: pointer;
  }

  .submit-button:hover {
    background: var(--v04);
  }

  .submit-button:disabled {
    cursor: default;
    opacity: 0.6;
    color: var(--v04);
  }
</style>
