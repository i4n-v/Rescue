<script>
  export let className = "";
  export let options = [];
  export let value = "";
  export let handleOption = () => {};
</script>

<div class={`buttons-container ${className}`}>
  {#each options as option}
    <button
      type="button"
      class={`select-button ${option === value ? "active" : ""}`}
      on:click={() => handleOption(option)}
    >
      {option}
    </button>
  {/each}
</div>

<style>
  .buttons-container {
    display: flex;
    gap: 20px;
  }

  .select-button {
    font: var(--poppins-m);
    color: var(--w);
    border-radius: 5px;
    border: none;
    background: var(--c05);
    padding: 8px 16px;
    transition: 0.3s ease-in-out;
    cursor: pointer;
    text-transform: uppercase;
  }

  .select-button:hover {
    background: var(--c11);
  }

  .active {
    background: var(--c11);
  }

  .select-button:hover {
    color: var(--w);
  }
</style>
