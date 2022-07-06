<script>
  import Close from "../assets/svg/Close.svelte";

  export let success = false;
  export let error = false;
  export let message = "";
  export let handleClose = () => {};

  function closeInTime() {
    setTimeout(handleClose, 10000);
    return "";
  }
</script>

{#if success || error}
  {closeInTime()}
  <div
    id="message-container"
    class={`anime-down ${success ? "success" : error ? "error" : ""}`}
  >
    <p>{message}</p>
    <span class="close-button" on:click={handleClose}>
      <Close />
    </span>
  </div>
{/if}

<style>
  #message-container {
    padding: 12px 24px;
    min-width: 220px;
    display: flex;
    justify-content: space-between;
    border-radius: 5px;
    font: var(--roboto-xs);
    position: absolute;
    top: 10px;
    right: 12px;
    z-index: 2000;
  }

  .success {
    background: var(--d01);
    color: var(--d05);
    border: 1px solid var(--d02);
  }

  .success :global(.close-button > svg > *) {
    fill: var(--d05);
  }

  .error {
    background: var(--v01);
    color: var(--v05);
    border: 1px solid var(--v02);
  }

  .error :global(.close-button > svg > *) {
    fill: var(--v05);
  }

  :global(.close-button) {
    cursor: pointer;
  }
</style>
