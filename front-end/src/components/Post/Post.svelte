<script>
  import { Map, ConfirmModal, CommentModal } from "../";
  import ProfileUnknown from "../../assets/svg/ProfileUnknown.svelte";
  import Delete from "../../assets/svg/Delete.svelte";
  import Edit from "../../assets/svg/Edit.svelte";
  import Like from "../../assets/svg/Like.svelte";
  import FillLike from "../../assets/svg/FillLike.svelte";
  import Comment from "../../assets/svg/Comment.svelte";
  import Verified from "../../assets/svg/Verified.svelte";
  import MinBluePoint from "../../assets/svg/MinBluePoint.svelte";
  import { limitName } from "../../scripts/utils";
  import { getPhotos, getLocation } from "../../services/postService";
  import cookie from "js-cookie";

  let token = cookie.get("access-token");
  let cookieUserId = cookie.get("user-id");
  let confirmModal = false;
  let commentModal = false;

  function togleConfirmModal() {
    confirmModal = !confirmModal;
  }

  function togleCommentModal() {
    commentModal = !commentModal;
  }

  export let id = "";
  export let userId = "";
  export let profileImage = null;
  export let profileName = "";
  export let title = "";
  export let description = "";
  let images = [];
  let map = null;
  export let likes = 0;
  export let comments = 0;
  export let verified = false;
  export let liked = false;

  // events
  export let onDelete = () => {};
  export let onEdit = () => {};
  export let onLike = () => {};

  async function getPhotosPost() {
    try {
      const response = await getPhotos({ postId: id });
      images = response;
    } catch (error) {
      images = [];
    }
  }

  async function getLocationPost() {
    try {
      const response = await getLocation({ postId: id });
      map = response;
    } catch (error) {
      map = null;
    }
  }

  getPhotosPost();
  getLocationPost();
</script>

<div {id} class="post-container">
  <div class="action-container">
    <div>
      {#if !!profileImage}
        <img src="" alt="Imagem de perfil" />
      {:else}
        <ProfileUnknown />
      {/if}
      <p class="profile-name">
        {limitName(profileName, 2)}
      </p>
    </div>
    <div>
      {#if !!token && userId == cookieUserId}
        <Delete onClick={() => (confirmModal = true)} />
        <Edit
          onClick={() =>
            onEdit({
              id,
              title,
              description,
              images,
              map,
            })}
        />
      {/if}
    </div>
  </div>
  <div class="content">
    <div>
      <h2>{title}</h2>
      {#if !!map?.LOC_REGION}
        <MinBluePoint />
        <p>{map.LOC_REGION}</p>
      {/if}
      {#if verified}
        <Verified />
      {/if}
    </div>
    <p>{description}</p>
  </div>
  {#if !!map || !!images?.length}
    <div class="container-map">
      <div class="images-container">
        {#each images as image}
          <img src={image.PHOT_URL} alt="Imagem da postagem" />
        {/each}
      </div>
      {#if !!map?.LOC_LATITUDE}
        <Map
          id={id + "-map"}
          width="220px"
          height="220px"
          markerName={title}
          value={{
            latitude: map.LOC_LATITUDE,
            longitude: map.LOC_LONGITUDE,
            zoom: map.LOC_ZOOM,
          }}
          zoomControl={false}
          disableMarker={true}
        />
      {/if}
    </div>
  {/if}
  <div class="actions">
    <div>
      {#if liked}
        <FillLike
          onClick={() => {
            likes--;
            liked = false;
            onLike(id, liked);
          }}
        />
      {:else}
        <Like
          onClick={() => {
            likes++;
            liked = true;
            onLike(id, liked);
          }}
        />
      {/if}
      <p>
        {likes}
      </p>
    </div>
    <div>
      <Comment onClick={togleCommentModal} />
      <p>Comentários</p>
    </div>
    <div />
    <p>
      {comments} pessoas comentaram nessa postagem
    </p>
  </div>
  <ConfirmModal
    title="Você realmente deseja excluir essa postagem ?"
    display={confirmModal}
    handleClick={togleConfirmModal}
    onCancel={() => (confirmModal = false)}
    onConfirm={() => onDelete(id)}
  />
  <CommentModal
    postId={id}
    {title}
    {profileName}
    display={commentModal}
    handleClick={togleCommentModal}
  />
</div>

<style>
  .post-container {
    background: var(--c01);
    border-radius: 5px;
    box-shadow: var(--shadow01);
    padding: 32px 40px;
    width: 100%;
    max-width: 960px;
  }

  .action-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid var(--c03);
    padding: 0px 0px 12px 0px;
  }

  .action-container > div {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .profile-name {
    font: var(--poppins-m);
    color: var(--c11);
  }

  .content {
    margin: 12px 0px 32px 0px;
  }

  .content > div {
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .content h2 {
    font: var(--roboto-l-b);
    color: var(--c11);
  }

  .content div > p {
    font: var(--roboto-s);
    color: var(--c08);
  }

  .content > p {
    font: var(--roboto-s);
    color: var(--c08);
  }

  .container-map {
    display: flex;
    align-items: center;
    width: 100%;
  }

  .images-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex: 1;
  }

  .images-container > img {
    width: 160px;
    height: 160px;
    border-radius: 5px;
    border: 1px solid var(--p01);
    box-shadow: var(--shadow01);
  }

  .actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    font: var(--roboto-m);
    color: var(--c08);
    margin-top: 32px;
  }

  .actions > div {
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .actions > p {
    font: var(--roboto-xs);
    color: var(--c06);
  }
</style>
