<script>
  import {
    FormInput,
    FormTextArea,
    FormFile,
    SubmitButton,
    FormSelect,
    Map,
  } from "../../../components";
  import Message from "../../../helper/Message.svelte";
  import BluePoint from "../../../assets/svg/BluePoint.svelte";
  import { validate } from "../../../scripts/validateForm";
  import { states } from "../../../scripts/regions";
  import { postPost, putPost } from "../../../services/postService";
  import cookie from "js-cookie";

  export let data = null;
  export let togleModal = () => {};

  // states
  let loading = false;
  let success = false;
  let error = false;
  let message = "";
  let disablePost = true;

  let title = {
    value: !!data ? data.title : "",
    error: null,
  };

  let regionForm = {
    value: !!data?.map ? data.map.LOC_REGION : "-",
    error: null,
  };

  let description = {
    value: !!data ? data.description : "",
    error: null,
  };

  let files = [null, null, null];

  let location = {
    latitude: data?.map?.LOC_LATITUDE || null,
    longitude: data?.map?.LOC_LONGITUDE || null,
    zoom: data?.map?.LOC_ZOOM || null,
  };

  // handle functions
  function allFieldValidate() {
    return (
      validate(title.value).valide &&
      validate(regionForm.value).valide &&
      validate(description.value).valide
    );
  }

  function handleClose() {
    error = false;
    success = false;
    message = "";
  }

  async function handleSubmit() {
    if (allFieldValidate()) {
      const formData = new FormData();
      formData.append("title", title.value);
      formData.append("region", regionForm.value);
      formData.append("description", description.value);
      files.forEach((file) => {
        if (!!file) formData.append("photos[]", file);
      });
      formData.append("latitude", location.latitude);
      formData.append("longitude", location.longitude);
      formData.append("zoom", location.zoom);

      loading = true;
      try {
        const userId = cookie.get("user-id");
        if (!!data) {
          data.images?.forEach((file) => {
            if (!!file) {
              formData.append("photosId[]", file.PHOT_ID);
              formData.append("photosPreviousPath[]", file.PHOT_PATH);
            }
          });
          const response = await putPost(formData, { userId, postId: data.id });
          message = response.message;
        } else {
          const response = await postPost(formData, { userId });
          message = response.message;
        }
        success = true;
        togleModal();
      } catch (error) {
        message = error.response.data.message;
      } finally {
        error = !success;
        loading = false;
      }
    }
  }
</script>

<Message {success} {error} {message} {handleClose} />
<div class="form-container">
  <h1 class="main-title">
    {!!data ? "Editar postagem" : "Criar postagem"}<span>.</span>
  </h1>
  <form>
    <FormInput
      id="title"
      type="text"
      label="Título"
      required
      value={title.value}
      error={title.error}
      setValue={(value) => {
        title = {
          value: value,
          error: validate(value).describe,
        };
        disablePost = !allFieldValidate();
      }}
    />
    <FormSelect
      id="regions"
      label="Região"
      defaultValue={"-"}
      required
      options={states}
      value={regionForm.value}
      error={regionForm.error}
      setValue={(value) => {
        regionForm = {
          value: value,
          error: validate(value).describe,
        };
        disablePost = !allFieldValidate();
      }}
    />
    <FormTextArea
      id="description"
      type="text"
      label="Descrição"
      className="col-span-2"
      maxlength={255}
      rows={8}
      required
      value={description.value}
      error={description.error}
      setValue={(value) => {
        description = {
          value: value,
          error: validate(value).describe,
        };
        disablePost = !allFieldValidate();
      }}
    />
    <div class="form-subtitle">
      <BluePoint />
      <h3>Fotos</h3>
    </div>
    <div class="images-container">
      {#each files as file, key}
        <FormFile
          id={"file-" + key}
          imageUrl={data?.images[key]?.PHOT_URL || null}
          setValue={(value) => {
            files[key] = value;
          }}
        />
      {/each}
    </div>
    <div class="form-subtitle">
      <BluePoint />
      <h3>Localização</h3>
    </div>
    <Map
      id="form-map"
      className="col-span-2"
      height="300px"
      markerName={title.value}
      value={data?.map?.LOC_LATITUDE ? location : null}
      setValue={(lat, lng, zoom) => {
        location = {
          latitude: lat,
          longitude: lng,
          zoom,
        };
      }}
      onZoomChange={(zoom) => {
        location = {
          ...location,
          zoom,
        };
      }}
    />
    <SubmitButton
      {loading}
      disabled={disablePost}
      maxWidth="193px"
      onSubmit={handleSubmit}
    >
      {!!data ? "Salvar" : "Compartilhar"}
    </SubmitButton>
  </form>
</div>

<style>
  .main-title {
    font: var(--poppins-xl);
    color: var(--c11);
  }

  .main-title > span {
    color: var(--p01);
  }

  .form-container {
    display: flex;
    width: 100%;
    max-width: 560px;
    flex-direction: column;
    gap: 40px;
  }

  .form-container > form {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  .form-subtitle {
    color: var(--c11);
    font: var(--roboto-m);
    display: flex;
    align-items: center;
    gap: 8px;
    grid-column: 1/3;
  }

  .images-container {
    display: flex;
    justify-content: space-between;
    grid-column: 1/3;
  }

  @media (max-width: 500px) {
    .form-container > form {
      max-width: 300px;
      grid-template-columns: 1fr;
    }
  }
</style>
