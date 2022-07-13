<script>
  import { Modal, FormSearch, Comment } from "../";
  import MinBluePoint from "../../assets/svg/MinBluePoint.svelte";
  import ProfileUnknown from "../../assets/svg/ProfileUnknown.svelte";
  import { limitName } from "../../scripts/utils";
  import { onMount } from "svelte";
  import {
    getComments,
    deleteComment,
    postComment,
  } from "../../services/postService";
  import cookie from "js-cookie";

  let token = cookie.get("access-token");
  let userId = cookie.get("user-id");

  export let display = false;
  export let postId = null;
  export let title = "";
  export let profileImage = null;
  export let profileName = "";

  let error = false;
  let success = false;
  let message = "";
  let page = 1;
  let limit = 3;
  let totalPage = 1;
  let comments = [];
  let description = "";

  //requests
  async function getCommentList(type) {
    try {
      const response = await getComments({
        postId,
        page,
        limit,
      });
      message = "Comentários encontrados";
      success = true;
      totalPage = response.totalPage;

      if (type === "paginate") {
        comments = [...comments, ...response.result];
      } else {
        comments = response.result;
      }
    } catch (error) {
      message = error.response.data.message;
    } finally {
      error = !success;
    }
  }

  // events
  export let handleClick = () => {};

  async function handleSubmit() {
    try {
      const response = await postComment({
        userId,
        postId,
        description,
      });
      message = response.message;
      success = true;
      page = 1;
      getCommentList();
      description = "";
    } catch (error) {
      message = error.response.data.message;
    } finally {
      error = !success;
    }
  }

  async function handleDelete(userId, commentId) {
    try {
      const response = await deleteComment({
        userId,
        commentId,
      });
      message = response.message;
      success = true;
      page = 1;
      getCommentList();
    } catch (error) {
      message = error.response.data.message;
    } finally {
      error = !success;
    }
  }

  let wait = false;
  function infiniteScroll({ target }) {
    if (page <= totalPage) {
      if (
        target.scrollTop + target.clientHeight >= target.scrollHeight - 2 &&
        !wait
      ) {
        page += 1;
        getCommentList("paginate");
        wait = true;
        setTimeout(() => {
          wait = false;
        }, 500);
      }
    }
  }

  onMount(() => {
    getCommentList("paginate");
  });
</script>

<Modal {display} {handleClick}>
  <div class="comment-modal">
    <div class="action-container">
      {#if !!profileImage}
        <img src="" alt="Imagem de perfil" />
      {:else}
        <ProfileUnknown />
      {/if}
      <p>
        {limitName(profileName, 2)}
      </p>
      <MinBluePoint />
      <h3>
        {title}
      </h3>
    </div>
    <div
      class="comment-list"
      on:scroll={infiniteScroll}
      on:whell={infiniteScroll}
    >
      {#each comments as comment, key}
        <Comment
          userId={comment.USER_ID}
          name={comment.USER_NAME}
          description={comment.COMT_DESCRIPTION}
          color={key % 2 === 0 ? "#FFF" : "#F7F7F7"}
          onDelete={() => handleDelete(comment.USER_ID, comment.COMT_ID)}
        />
      {/each}
    </div>
    {#if !!token}
      <form class="send-comment">
        {#if !!profileImage}
          <img src="" alt="Imagem de perfil" />
        {:else}
          <ProfileUnknown />
        {/if}
        <FormSearch
          id="search"
          type="send"
          placeholder="Escreva algo..."
          value={description}
          setValue={(value) => {
            description = value;
          }}
          onClick={handleSubmit}
        />
      </form>
    {/if}
  </div>
</Modal>

<style>
  .comment-modal {
    display: flex;
    flex-direction: column;
    width: 500px;
    gap: 24px;
  }

  .action-container {
    display: flex;
    align-items: center;
    gap: 12px;
    align-items: center;
    border-bottom: 2px solid var(--c03);
    padding: 0px 0px 12px 0px;
  }

  .action-container > p {
    font: var(--poppins-m);
    color: var(--c11);
  }

  .action-container > h3 {
    font: var(--poppins-m);
    color: var(--c08);
  }

  .comment-list {
    flex: 1;
    display: flex;
    flex-direction: column;
    max-height: 320px;
    overflow-y: auto;
  }

  .send-comment {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 8px;
  }
</style>
