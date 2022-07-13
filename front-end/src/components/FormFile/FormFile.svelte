<script>
  import AddFile from "../../assets/svg/AddFile.svelte";
  import { onMount } from "svelte";

  // Atributes
  export let id = "";
  export let className = "";
  export let imageUrl = null;
  export let disabled = false;

  // Events
  export let setValue = () => {};

  function readImage(target) {
    const img = document.getElementById(id + "-img");
    if (target?.files && target?.files[0]) {
      const file = new FileReader();
      file.onload = function (e) {
        img.src = e.target.result;
        img.style.display = "block";
      };
      file.readAsDataURL(target.files[0]);
    } else if (!!imageUrl) {
      img.src = imageUrl;
      img.style.display = "block";
    }
  }

  onMount(() => {
    readImage();
  });
</script>

<div class={`field-container ${className}`}>
  <input
    {id}
    name={id}
    type="file"
    accept="image/*"
    {disabled}
    class="field-form"
    on:change={({ target }) => {
      setValue(target.files[0]);
      readImage(target);
    }}
  />
  <div>
    <AddFile />
  </div>
  <img id={id + "-img"} src="" alt="preview de imagem" />
</div>

<style>
  .field-container {
    position: relative;
    height: 160px;
    width: 160px;
    background: var(--c01);
    border: 1px solid var(--c02);
    border-radius: 5px;
    transition: 0.3s;
  }

  .field-container > div {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1;
  }

  .field-container > img {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 2;
    display: none;
    border-radius: 5px;
  }

  .field-form {
    width: 100%;
    height: 100%;
    opacity: 0;
    position: relative;
    z-index: 10;
    cursor: pointer;
  }

  .field-container:focus,
  .field-container:hover {
    outline: none;
    border-color: var(--p02);
    box-shadow: 0px 0px 0px 2px var(--p01);
  }
</style>
