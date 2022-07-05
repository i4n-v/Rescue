<!-- código JavaScript -->
<script>
  import { Link, FormInput, SubmitButton } from "../../components/";
  import { validate, cpfMask, cnpjMask } from "../../scripts/validateForm";

  let nome = {
    value: "",
    error: null,
  };
  let cpf = {
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
  let confSenha = {
    value: "",
    error: null,
  };

  let newUser = {
    nome: {
      value: "",
      error: null,
    },
    cpf: {
      value: "",
      error: null,
    },
    email: {
      value: "",
      error: null,
    },
    senha: {
      value: "",
      error: null,
    },
    confSenha: {
      value: "",
      error: null,
    },
  };

  function handleSubmit() {
    if (
      validate(newUser.nome.value, "nome").valide &&
      validate(newUser.cpf.value, "cpf").valide &&
      validate(newUser.email.value, "email").valide &&
      validate(newUser.senha.value, "password").valide &&
      newUser.senha.value === newUser.confSenha.value
    ) {
      console.log(
        newUser.nome.value,
        newUser.cpf.value,
        newUser.email.value,
        newUser.senha.value
      );
    }
  }
</script>

<!-- código HTML -->
<main>
  <div class="img-container">
    <img
      src="/src/assets/img/aside-logo.png"
      alt="Logo da Rescue"
      width="100%"
      height="100%"
    />
  </div>

  <div class="form-container">
    <h1 class="titulo">Cadastre-se<span class="dot">.</span></h1>

    <!-- <br>
    <br>
    <br> -->

    <form>
      <div class="form-field">
        <FormInput
          id="nome"
          type="text"
          label="Nome"
          placeholder="Seu nome"
          value={newUser.nome.value}
          error={newUser.nome.error}
          setValue={(value) => {
            newUser.nome = {
              value: value,
              error: validate(value, "nome").describe,
            };
          }}
        />
      </div>
      <div class="form-field">
        <FormInput
          id="cpf"
          type="text"
          label="CPF"
          placeholder="000.000.000-00"
          maxlength="14"
          value={newUser.cpf.value}
          error={newUser.cpf.error}
          setValue={(value) => {
            newUser.cpf = {
              value: cpfMask(value),
              error: validate(value, "cpf").describe,
            };
          }}
        />
      </div>
      <div class="form-field">
        <FormInput
          id="email"
          type="text"
          label="Email"
          placeholder="contato@email.com"
          value={newUser.email.value}
          error={newUser.email.error}
          setValue={(value) => {
            newUser.email = {
              value: value,
              error: validate(value, "email").describe,
            };
          }}
        />
      </div>
      <div class="form-field">
        <FormInput
          id="senha"
          type="password"
          label="Senha"
          value={newUser.senha.value}
          error={newUser.senha.error}
          setValue={(value) => {
            newUser.senha = {
              value: value,
              error: validate(value, "password").describe,
            };
          }}
        />
      </div>
      <div class="form-field">
        <FormInput
          id="confSenha"
          type="password"
          label="Confirmar senha"
          value={newUser.confSenha.value}
          error={newUser.confSenha.error}
          setValue={(value) => {
            newUser.confSenha = {
              value: value,
              error: validate(value, "password").describe,
            };
          }}
        />
      </div>
      <p class="interaja">
        Já possui uma conta? Então <Link href="/login">interaja conosco</Link>.
      </p>
      <div class="botao">
        <SubmitButton onSubmit={handleSubmit}>REGISTRAR-SE</SubmitButton>
      </div>
    </form>
  </div>
</main>

<!-- código CSS -->
<style>
  main {
    display: flex;
    flex-wrap: wrap;
    max-width: 1308px;
    margin: auto;
    align-items: center;
  }
  .titulo {
    font: var(--poppins-xxl);
  }
  .dot {
    color: var(--p01);
  }
  .interaja {
    font: var(--roboto-s);
    margin: 2rem auto;
  }
  .form-field {
    margin-top: 1rem;
    margin-bottom: 1rem;
  }
  .img-container {
    /*margin-right: 30rem;
     max-height: 820px;*/
    display: flex;
    flex-wrap: wrap;
    margin-right: auto;
    max-width: auto;
  }
  .form-container {
    display: inline-block;
    margin: auto;
  }
</style>
