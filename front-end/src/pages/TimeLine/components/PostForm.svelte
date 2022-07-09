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

  // states
  let loading = false;
  let success = false;
  let error = false;
  let message = "";

  let title = {
    value: "",
    error: null,
  };

  let regionForm = {
    value: "-",
    error: null,
  };

  let description = {
    value: "",
    error: null,
  };

  let files = [null, null, null];

  let location = {
    latitude: null,
    longitude: null,
    zoom: null,
  };

  // handle functions
  function handleClose() {}

  function handleSubmit() {}
</script>

<Message {success} {error} {message} {handleClose} />
<div class="form-container">
  <h1 class="main-title">Criar postagem<span>.</span></h1>
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
      markerName={title.value}
      setValue={(lat, lng, zoom) => {
        location = {
          latitude: lat,
          longitude: lng,
          zoom,
        };
      }}
    />
    <SubmitButton {loading} maxWidth="193px" onSubmit={handleSubmit}>
      Compartilhar
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
