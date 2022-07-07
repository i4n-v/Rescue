<script>
  import {
    Wrapper,
    FormSelect,
    FormSearch,
    AddButton,
  } from "../../components/";
  import { states } from "../../scripts/regions";
  import Message from "../../helper/Message.svelte";

  let loading = false;
  let success = false;
  let error = false;
  let message = "";

  let region = "-";
  let search = "";

  function handleClose() {}
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
          setValue={(value) => (region = value)}
        />
        <FormSearch
          id="search"
          value={search}
          setValue={(value) => (region = value)}
        />
        <AddButton />
      </div>
    </header>
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
    gap: 20px;
  }

  .main-title {
    font: var(--poppins-xl);
    color: var(--c11);
  }

  .main-title > span {
    color: var(--p01);
  }
</style>
