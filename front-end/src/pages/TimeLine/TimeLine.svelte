<script>
  import {
    Wrapper,
    FormSelect,
    FormSearch,
    AddButton,
    Modal,
  } from "../../components/";
  import PostForm from "./components/PostForm.svelte";
  import { states } from "../../scripts/regions";
  import Message from "../../helper/Message.svelte";
  import cookie from "js-cookie";

  // states
  let loading = false;
  let error = false;
  let message = "";
  let modal = false;

  // filters
  let region = "-";
  let search = "";

  function handleClose() {}

  function togleModal() {
    modal = !modal;
  }

  function handleSubmit() {}
</script>

<Wrapper>
  <Message {error} {message} {handleClose} />
  <div id="feed-container">
    <header class="filters-container">
      <h1 class="main-title">Linha do tempo<span>.</span></h1>
      <div>
        <FormSelect
          id="regions"
          defaultValue={"-"}
          options={states}
          value={region}
          setValue={(value) => (region = value)}
        />
        <FormSearch
          id="search"
          value={search}
          setValue={(value) => (region = value)}
        />
        <AddButton onClick={togleModal} />
      </div>
    </header>
    <Modal display={modal} handleClick={togleModal}>
      <PostForm />
    </Modal>
    <section id="post-list" />
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
    margin: 60px auto 0px auto;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
</style>
