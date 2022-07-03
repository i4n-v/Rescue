<script>
    import { Link, SubmitButton } from "../../components/";

    let user = {
    email: "",
    pwd: "",
  };
  let confPwd = "";

  let erros = {
    email: "",
    pwd: "",
  };

  let validar = false;

  function submit() {
    validar = true;

    // email
    if (user.email.trim().length < 1) {
      validar = false;
      erros.email = "Insira seu Email.";
    } else {
      erros.email = "";
    }
    // pwd
    if (user.pwd.trim().length < 1) {
      validar = false;
      erros.pwd = "Insira sua senha.";
    } else {
      erros.pwd = "";
    }
  }
    
  </script>
  
  <main>
    <div class="img-container">
        <img src="/src/assets/img/aside-logo.png" alt="Logo da Rescue">
      </div>
    
      <div class="form-container">
        <h1 class="titulo">Login<span class="dot">.</span></h1>
  
        <br>
        
        <form>
          
          <div class="label">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="contato@email.com" bind:value={user.email}>
            <div class="error">{erros.email}</div>
          </div>
          <br>
          <div class="label">
            <label for="senha">Senha</label>
            <input type="password" id="senha" bind:value={user.pwd}>
            <div class="error">{erros.pwd}</div>
          </div>
  
          <br>
         
          <p>Ainda não possui cadastro? Vem fazer parte da <Link href="cadastro#/">nossa comunidade </Link>.</p>
          
          <br>
  
          <p><Link href="cadastro#/">Esqueceu a senha?</Link></p>
  
          <br>
  
          <div class="botao" on:click={submit}>
            <SubmitButton
              onSubmit={function () {
                console.log("Enviou");
              }}
            >
              ENTRAR
            </SubmitButton>
          </div>
  
        </form>
        </div>  
  </main>
  
  <style>
    main {
      display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr;
    grid-column-gap: 50px;
    grid-row-gap: 2px
    }
    .label {
      font: var(--poppins-s);
    }
  
    .dot {
      color: #4892BC;
    }
  
    .form-container{
        margin-top: 8rem;
    }
  
    h1.titulo{
        font-size: 3.5rem;
        font-family: poppins;
    }
  
    input{
        font-size: 1.5rem;
        display: block;
        background-color: #f7f7f7;
        padding-right: 8rem;
        padding-left: 0.5rem;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        border-color: aliceblue;
        border-radius: 5px;
        }
  
  .error {
    font: var(--poppins-xs);
    color: #c65454;
  }
  
  </style>