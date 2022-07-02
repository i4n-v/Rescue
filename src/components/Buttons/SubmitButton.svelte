<script>
  export let onSubmit = () => {};
</script>

<button
  class="submit-button"
  on:click={(event) => {
    event.preventDefault();
    onSubmit();
  }}
>
  <slot />
</button>

<style>
  .submit-button {
    font: var(--poppins-m);
    color: var(--p05);
    border-radius: 5px;
    border: none;
    background: var(--gdr01);
    padding: 16px 32px;
    transition: 0.3s ease-in-out;
    cursor: pointer;
  }

  .submit-button:hover {
    color: var(--w);
  }
</style>
