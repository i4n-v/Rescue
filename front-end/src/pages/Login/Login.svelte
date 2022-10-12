<script>
  import { Wrapper, Link, FormInput, SubmitButton } from "../../components/";
  import Message from "../../helper/Message.svelte";
  import { authUser } from "../../services/userService";
  import cookie from "js-cookie";
  import { navigate } from "svelte-routing";
  import asideLogo from "../../assets/img/aside-logo.png";

  let loading = false;
  let success = false;
  let error = false;
  let message = "";

  let email = {
    value: "",
  };
  let senha = {
    value: "",
  };

  function handleClose() {
    error = false;
    success = false;
    message = "";
  }

  async function handleSubmit() {
    const userData = {
      email: email.value,
      password: senha.value,
    };

    try {
      loading = true;
      const response = await authUser(userData);
      cookie.set("access-token", response.USER_TOKEN);
      cookie.set("user-id", response.USER_ID);
      cookie.set("user-name", response.USER_NAME);

      message = "Autenticação realizada com sucesso";
      success = true;

      email = {
        value: "",
      };
      senha = {
        value: "",
      };

      navigate("/inicio", { replace: true });
    } catch (error) {
      message = error.response.data.message;
    } finally {
      error = !success;
      loading = false;
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
      <img src={asideLogo} alt="Logo da Rescue" />
    </div>
    <div class="form-container anime-left">
      <h1 class="title">Login<span>.</span></h1>
      <form>
        <FormInput
          id="email"
          type="email"
          label="Email"
          placeholder="contato@email.com"
          className="col-span-2"
          value={email.value}
          setValue={(value) => {
            email = {
              value: value,
            };
          }}
        />
        <FormInput
          id="senha"
          type="password"
          label="Senha"
          minlength="8"
          className="col-span-2"
          value={senha.value}
          setValue={(value) => {
            senha = {
              value: value,
            };
          }}
        />
        <p class="col-span-2">
          Ainda não possui cadastro ? vem fazer parte da
          <Link href="/cadastro" className="action-link">nossa comunidade</Link
          >.
          <br />
          <Link href="/recuperar_senha" className="action-link"
            >Esqueceu a senha ?</Link
          >
        </p>
        <SubmitButton {loading} maxWidth="193px" onSubmit={handleSubmit}
          >Entrar
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
