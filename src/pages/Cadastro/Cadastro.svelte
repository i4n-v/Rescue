<!-- código JavaScript -->
<script>
  import { Link, FormInput, SubmitButton } from "../../components/";
  import { validate, cpfMask, cnpjMask } from "../../scripts/validateForm";


  let nome = {
    value: "",
    error: null
  }
  let cpf = {
    value: "",
    error: null
  }
  let email = {
    value: "",
    error: null
  }
  let senha = {
    value: "",
    error: null
  }
  let confSenha = {
    value: "",
    error: null
  }

  let newUser = {
    nome: {
      value: "",
      error: null
    },
    cpf: {
      value: "",
      error: null
    },
    email: {
      value: "",
      error: null
    },
    senha: {
      value: "",
      error: null
    },
    confSenha: {
      value: "",
      error: null
    }
  }


  function handleSubmit() {
    if(
      validate(newUser.nome.value, "nome").valide &&
      validate(newUser.cpf.value, "cpf").valide &&
      validate(newUser.email.value, "email").valide &&
      validate(newUser.senha.value, "password").valide &&
      newUser.senha.value === newUser.confSenha.value
      ){

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
  <div id="img-container">
    <!--<img src="/src/assets/img/aside-logo.png" alt="Logo da Rescue" />-->
  </div>

  <div class="form-container">
    <h1 class="titulo">Cadastre-se<span class="dot">.</span></h1>

    <form>
    <div class="divInline">
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
              error: validate(value, "nome").describe
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
              error: validate(value, "cpf").describe
            };
          }}
        />
      </div>
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
              error: validate(value, "email").describe
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
              error: validate(value, "password").describe
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
              error: validate(value, "password").describe
            };
          }}
        />
      </div>
      <p>
        Já possui uma conta? Então <Link href="/login">interaja conosco</Link>.
      </p>
      <div class="botao">
        <SubmitButton
          onSubmit={handleSubmit}
        >
          REGISTRAR-SE
        </SubmitButton>
      </div>
    </form>
  </div>
</main>

<!-- código CSS -->
<style>
  main {
    display: flex;
    flex-direction: row;
    height: 100%;
    margin: 0;
  }
  p{
    font: var(--roboto-xs);
  }
  .titulo {
    font: var(--poppins-xxl);
  }
  .dot {
    color: var(--p01);
  }
  .botao {
    margin: 2rem;
  }

  .form-field{
    margin-top: 15px;
    margin-bottom: 5px;
  }
  .form-container {
    display: flex;
  } 
  /*.divInline{
    float: right;
    display: flex;
    margin-bottom: auto;
  }*/
  #img-container {
    width: 50%;
    height: 900px;
    position: relative;
    background: url("/src/assets/img/aside-logo.png") center no-repeat;
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0px;
  }
  @media(min-width:1200px){
    .form-container{
      margin-top: 100px;
      margin-left: 155px;
      margin-bottom: 40px;
      display: inline-block;
    }
    
  
  }

</style>
