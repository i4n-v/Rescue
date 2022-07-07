<script>
  import {
    Wrapper,
    Link,
    FormInput,
    SubmitButton,
    SelectButton,
  } from "../../components/";
  import Message from "../../helper/Message.svelte";
  import { validate, cpfMask, cnpjMask } from "../../scripts/validateForm";
  import { postPeople } from "../../services/peopleService";
  import { postInstitution } from "../../services/institutionService";

  let loading = false;
  let error = false;
  let success = false;
  let message = "";
  let profile = "Pessoa física";
  let disableRegister = true;

  let nome = {
    value: "",
    error: null,
  };
  let cpf = {
    value: "",
    error: null,
  };
  let cnpj = {
    value: "",
    error: null,
  };
  let email = {
    value: "",
    error: null,
  };
  let senha = {
    value: "",
    error: null,
  };
  let confirmSenha = {
    value: "",
    error: null,
  };

  function handleClose() {
    error = false;
    success = false;
    message = "";
  }

  function allFieldValidate() {
    return (
      validate(nome.value).valide &&
      validate(email.value, "email").valide &&
      validate(senha.value, "password").valide &&
      validate(confirmSenha.value, "password").valide &&
      (validate(cpf.value, "cpf") || validate(cnpj.value, "cnpj"))
    );
  }

  async function handleSubmit() {
    if (allFieldValidate()) {
      const userData = {
        name: nome.value,
        email: email.value,
        password: senha.value,
        confirmPassword: confirmSenha.value,
      };

      try {
        loading = true;
        if (profile === "Pessoa física") {
          userData.cpf = cpf.value;
          const response = await postPeople(userData);
          message = response.message;
          success = true;
        } else {
          userData.cnpj = cnpj.value;
          const response = await postInstitution(userData);
          message = response.message;
          success = true;
        }

        nome = {
          value: "",
          error: null,
        };
        cpf = {
          value: "",
          error: null,
        };
        cnpj = {
          value: "",
          error: null,
        };
        email = {
          value: "",
          error: null,
        };
        senha = {
          value: "",
          error: null,
        };
        confirmSenha = {
          value: "",
          error: null,
        };
      } catch (error) {
        message = error.response.data.message;
      } finally {
        error = !success;
        loading = false;
      }
    }
  }
</script>

<svelte:head>
  <title>Rescue | Cadastro</title>
</svelte:head>

<Wrapper>
  <Message {success} {error} {message} {handleClose} />
  <section class="wrapper">
    <div class="img-container">
      <img src="/src/assets/img/aside-logo.png" alt="Logo da Rescue" />
    </div>
    <div class="form-container anime-left">
      <h1 class="title">Cadastre-se<span>.</span></h1>
      <form>
        <SelectButton
          value={profile}
          options={["Pessoa física", "Instituição"]}
          handleOption={(option) => (profile = option)}
          className="col-span-2"
        />
        <FormInput
          id="nome"
          type="text"
          label="Nome"
          placeholder="Seu nome"
          required
          value={nome.value}
          error={nome.error}
          setValue={(value) => {
            nome = {
              value: value,
              error: validate(value).describe,
            };
            disableRegister = !allFieldValidate();
          }}
        />
        {#if profile === "Pessoa física"}
          <FormInput
            id="cpf"
            type="text"
            label="CPF"
            placeholder="000.000.000-00"
            required
            maxlength="14"
            value={cpf.value}
            error={cpf.error}
            setValue={(value) => {
              cpf = {
                value: cpfMask(value),
                error: validate(value, "cpf").describe,
              };
              disableRegister = !allFieldValidate();
            }}
          />
        {:else}
          <FormInput
            id="cnpj"
            type="text"
            label="CNPJ"
            placeholder="00.000.000/0000-00"
            required
            maxlength="18"
            value={cnpj.value}
            error={cnpj.error}
            setValue={(value) => {
              cnpj = {
                value: cnpjMask(value),
                error: validate(value, "cnpj").describe,
              };
              disableRegister = !allFieldValidate();
            }}
          />
        {/if}
        <FormInput
          id="email"
          type="text"
          label="Email"
          placeholder="contato@email.com"
          required
          className="col-span-2"
          value={email.value}
          error={email.error}
          setValue={(value) => {
            email = {
              value: value,
              error: validate(value, "email").describe,
            };
            disableRegister = !allFieldValidate();
          }}
        />
        <FormInput
          id="senha"
          type="password"
          label="Senha"
          minlength="8"
          required
          className="col-span-2"
          value={senha.value}
          error={senha.error}
          setValue={(value) => {
            senha = {
              value: value,
              error: validate(value, "password").describe,
            };
            disableRegister = !allFieldValidate();
          }}
        />
        <FormInput
          id="confSenha"
          type="password"
          className="col-span-2"
          label="Confirmar senha"
          minlength="8"
          required
          value={confirmSenha.value}
          error={confirmSenha.error}
          setValue={(value) => {
            confirmSenha = {
              value: value,
              error: validate(value, "password").describe,
            };
            disableRegister = !allFieldValidate();
          }}
        />
        <p class="col-span-2">
          Já possui uma conta? Então <Link href="/login" className="action-link"
            >interaja conosco</Link
          >.
        </p>
        <SubmitButton
          disabled={disableRegister}
          {loading}
          maxWidth="193px"
          onSubmit={handleSubmit}
          >REGISTRAR-SE
        </SubmitButton>
      </form>
    </div>
  </section>
</Wrapper>

<style>
  .wrapper {
    display: flex;
    width: 100%;
    min-height: 800px;
    gap: 40px;
  }

  .img-container {
    width: 768px;
  }

  .wrapper > div > img {
    width: 100%;
    height: 100%;
  }

  .title {
    font: var(--poppins-xxl);
  }

  .title > span {
    color: var(--p01);
  }

  .form-container {
    display: flex;
    width: 768px;
    flex-direction: column;
    justify-content: center;
    gap: 60px;
  }

  .form-container > form {
    width: 100%;
    max-width: 560px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }

  .form-container p {
    font: var(--roboto-xs);
    color: var(--c11);
  }

  .form-container :global(.action-link) {
    font: var(--roboto-xs);
    font-weight: 500;
  }

  :global(.col-span-2) {
    grid-column: 1/3;
  }

  @media (max-width: 1100px) {
    .img-container {
      display: none;
    }

    .wrapper {
      justify-content: center;
      padding: 0px 12px;
    }

    .form-container {
      align-items: center;
    }
  }

  @media (max-width: 470px) {
    .form-container > form {
      grid-template-columns: 1fr;
    }

    :global(.col-span-2) {
      grid-column: 1/-1;
    }

    .wrapper {
      margin: 120px 0px;
    }

    .title {
      font: var(--poppins-xl);
    }
  }
</style>
