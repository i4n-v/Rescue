<script>
  import { ConfirmModal } from "../";
  import Delete from "../../assets/svg/Delete.svelte";
  import ProfileUnknown from "../../assets/svg/ProfileUnknown.svelte";
  import { limitName } from "../../scripts/utils";
  import cookie from "js-cookie";

  let token = cookie.get("access-token");
  let cookieUserId = cookie.get("user-id");

  export let profileImage = null;
  export let userId = null;
  export let name = "";
  export let description = "";
  export let color = "#FFF";

  // events
  export let onDelete = () => {};
</script>

<div class="comment" style="background-color: {color};">
  <div class="action-container">
    <div>
      {#if !!profileImage}
        <img src="" alt="Imagem de perfil" />
      {:else}
        <ProfileUnknown />
      {/if}
      <p>
        {limitName(name, 2)}
      </p>
    </div>
    <div>
      {#if !!token && userId == cookieUserId}
        <Delete onClick={onDelete} />
      {/if}
    </div>
  </div>
  <p>{description}</p>
</div>

<style>
  .comment {
    display: flex;
    flex-direction: column;
    border-radius: 5px;
    padding: 12px;
  }

  .action-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .action-container > div > p {
    color: var(--c11);
    font: var(--poppins-m);
  }

  .action-container > div {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .comment > p {
    margin-left: 68px;
    color: var(--c08);
    font: var(--roboto-s);
  }
</style>
