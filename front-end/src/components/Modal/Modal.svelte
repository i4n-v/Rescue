<script>
  export let display = false;
  export let handleClick = () => {};

  // events
  function togleModal({ target }) {
    const modal = document.querySelector("#modal");

    if (target === modal) {
      handleClick();
    }
  }
</script>

{#if display}
  <div id="modal" on:click={togleModal}>
    <div class="anime-down">
      <slot />
    </div>
  </div>
{/if}

<style>
  #modal {
    width: 100%;
    height: 100vh;
    position: absolute;
    z-index: 3000;
    top: 0px;
    left: 0px;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #modal > div {
    background: var(--w);
    padding: 40px 100px;
    border-radius: 5px;
    box-shadow: var(--shadow01);
    border: 1px solid var(--p01);
    max-height: 650px;
    overflow-y: scroll;
  }

  :global(#wrapper) {
    position: static !important;
  }

  :global(body) {
    overflow-y: hidden;
  }

  @media (max-width: 720px) {
    #modal > div {
      padding: 40px 12px;
    }
  }
</style>
