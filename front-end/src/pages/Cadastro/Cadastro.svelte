<!-- código JavaScript -->
<script>

import { Link } from "../../components/";
import Button from "../../components/Buttons/OutlinedButton.svelte";


  let user = {
    nome: '',
    cpf: '',
    email: '',
    pwd: ''
  };
  let confPwd = '';

  let erros = {
    nome: '',
    cpf: '',
    email: '',
    pwd: ''
  };
  let validar = false;

  function submit() {
    validar = true;
    // nome
    if (user.nome.trim().length < 1) {
      validar = false;
      erros.nome = 'Insira seu nome.'
    } else {
      erros.nome = ''
    }
    // cpf
    if (user.cpf.trim().length < 1) {
      validar = false;
      erros.cpf = 'Insira seu CPF.'
    } else {
      erros.cpf = ''
    }
    // email
    if (user.email.trim().length < 1) {
      validar = false;
      erros.email = 'Insira seu Email.'
    } else {
      erros.email = ''
    }
    // pwd
    if (user.pwd.trim().length < 1) {
      validar = false;
      erros.pwd = 'Insira sua senha.'
    } else {
      erros.pwd = ''
    }
  }
  

</script>


<!-- código HTML -->
<main>
  <div class="img-container">
    <img src="/src/assets/img/aside-logo.png" alt="Logo da Rescue">
  </div>

  <div class="form-container">
    <h1 class="titulo">Cadastre-se<span class="dot">.</span></h1>

    <form>
      <div class="form-field">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" placeholder="Seu nome" bind:value={user.nome}>
        <div class="error">{ erros.nome }</div>
      </div>
      <div class="form-field">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" placeholder="Insira somente números" bind:value={user.cpf}>
        <div class="error">{ erros.cpf }</div>
      </div>
      <div class="form-field">
        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="contato@email.com" bind:value={user.email}>
        <div class="error">{ erros.email }</div>
      </div>
      <div class="form-field">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" bind:value={user.pwd}>
        <div class="error">{ erros.pwd }</div>
      </div>
      <div class="form-field">
        <label for="confSenha">Confirmar senha:</label>
        <input type="password" id="confSenha" bind:value={confPwd}>
        <div class="error">{ erros.pwd }</div>
      </div>
      <p>Já possui uma conta? Então <Link href="/login">interaja conosco</Link>.</p>
    <div class="botao" on:click={submit}>
      <Button>REGISTRAR-SE</Button>
    </div>
    </form>

  </div>

</main>



<!-- código CSS -->
<style>

  main {
    display: flex;
  }
  .titulo {
    font: var(--poppins-xxl);
  }
  .dot {
    color: #4892BC;
  }
  .botao {
    margin-top: 2rem;
  }
  .error{
    font: var(--poppins-xs);
    color: #C65454;
  }
</style>
