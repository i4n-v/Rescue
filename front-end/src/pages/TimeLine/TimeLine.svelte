<script>
  import {
    Wrapper,
    FormSelect,
    FormSearch,
    AddButton,
    Modal,
    Post,
  } from "../../components/";
  import PostForm from "./components/PostForm.svelte";
  import { states } from "../../scripts/regions";
  import Message from "../../helper/Message.svelte";
  import cookie from "js-cookie";
  import { onMount, onDestroy } from "svelte";
  import {
    getPost,
    postLike,
    deleteLike,
    deletePost,
  } from "../../services/postService";

  // states
  let token = cookie.get("access-token");
  let userId = cookie.get("user-id");
  let loading = false;
  let error = false;
  let success = false;
  let message = "";
  let modal = false;
  let page = 1;
  let limit = 4;
  let totalPage = 1;
  let posts = [];
  let editPost = null;

  // filters
  let region = "-";
  let search = "";

  function handleClose() {
    success = false;
    error = false;
    message = "";
  }

  function togleModal() {
    modal = !modal;
    editPost = null;
  }

  //requests
  async function getPosts(type) {
    loading = true;
    try {
      const response = await getPost({
        userId: !!userId ? userId : null,
        page,
        limit,
        region: region === "-" ? null : region,
        title: search,
        filter: !!userId ? "all" : undefined,
      });
      message = "Postagens encontradas";
      success = true;
      totalPage = response.totalPage;

      if (type === "paginate") {
        posts = [...posts, ...response.result];
      } else {
        posts = response.result;
      }
    } catch (error) {
      message = error.response.data.message;
    } finally {
      error = !success;
      loading = false;
    }
  }

  async function deletePosts(postId) {
    try {
      const response = await deletePost({ postId, userId });
      message = response.message;
      success = true;
      page = 1;
      posts = [];
      getPosts();
    } catch (error) {
      message = error.response.data.message;
    } finally {
      error = !success;
    }
  }

  async function togleLike(postId, liked) {
    try {
      let response = null;
      if (liked) {
        response = await postLike({ postId, userId });
      } else {
        response = await deleteLike({ postId, userId });
      }
      message = response.message;
      success = true;
    } catch (error) {
      message = error.response.data.message;
    } finally {
      error = !success;
    }
  }

  let wait = false;
  function infiniteScroll() {
    if (page <= totalPage) {
      const scroll = window.scrollY;
      const height = document.body.offsetHeight - window.innerHeight;
      if (scroll > height * 0.75 && !wait) {
        page++;
        getPosts("paginate");
        wait = true;
        setTimeout(() => {
          wait = false;
        }, 500);
      }
    }
  }

  onMount(() => {
    getPosts("paginate");
    window.addEventListener("whell", infiniteScroll);
    window.addEventListener("scroll", infiniteScroll);
  });

  onDestroy(() => {
    window.removeEventListener("whell", infiniteScroll);
    window.removeEventListener("scroll", infiniteScroll);
  });
</script>

<Wrapper>
  <Message {success} {error} {message} {handleClose} />
  <div id="feed-container">
    <header class="filters-container">
      <h1 class="main-title">Linha do tempo<span>.</span></h1>
      <div>
        <FormSelect
          id="regions"
          defaultValue={"-"}
          options={states}
          value={region}
          setValue={(value) => {
            region = value;
            page = 1;
            getPosts();
          }}
        />
        <FormSearch
          id="search"
          maxWidth="300px"
          value={search}
          setValue={(value) => {
            search = value;
          }}
          onClick={() => {
            page = 1;
            getPosts("search");
          }}
        />
        {#if !!token}
          <AddButton onClick={togleModal} />
        {/if}
      </div>
    </header>
    <Modal display={modal} handleClick={togleModal}>
      <PostForm data={editPost} {togleModal} />
    </Modal>
    <section id="post-list">
      {#each posts as post}
        <Post
          id={post.POST_ID}
          userId={post.USER_ID}
          profileName={post.USER_NAME}
          profileImage={post.USER_PHOTO}
          title={post.POST_TITLE}
          description={post.POST_DESCRIPTION}
          verified={post.POST_VERIFIED === "true"}
          liked={post.LIKED === "true"}
          comments={post.TOTAL_COMMENTS}
          likes={post.TOTAL_LIKES}
          onLike={togleLike}
          onDelete={deletePosts}
          onEdit={(data) => {
            editPost = data;
            modal = true;
          }}
        />
      {/each}
      {#if page >= totalPage}
        <p>Não há mais postagens</p>
      {/if}
    </section>
  </div>
</Wrapper>

<style>
  #feed-container {
    max-width: 1160px;
    padding: 0px 12px;
    margin: 60px auto 0px auto;
  }

  .filters-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 40px;
    border-bottom: 2px solid var(--c02);
    padding-bottom: 12px;
  }

  .filters-container > div {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }

  .main-title {
    font: var(--poppins-xl);
    color: var(--c11);
  }

  .main-title > span {
    color: var(--p01);
  }

  #post-list {
    min-height: 520px;
    max-width: 1160px;
    padding: 0px 12px;
    margin: 60px auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 40px;
  }

  #post-list > p {
    font: var(--roboto-s);
    color: var(--c08);
  }
</style>
