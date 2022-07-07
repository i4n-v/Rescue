<script>
  import Add from "../../assets/svg/Add.svelte";

  export let onClick = () => {};
</script>

<button
  type="button"
  class="add-button"
  on:click={(event) => {
    event.preventDefault();
    onClick;
  }}
>
  <Add />
</button>

<style>
  .add-button {
    border-radius: 5px;
    padding: 6px 12px;
    background-image: var(--gdr01);
    border: none;
    cursor: pointer;
  }

  :global(.add-button:hover > svg > *) {
    transition: 0.3s;
    fill: var(--w);
  }
</style>
