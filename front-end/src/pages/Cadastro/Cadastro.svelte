<!-- código JavaScript -->
<script>

import { Link } from "../../components/";
import Button from "../../components/Buttons/BlueButton.svelte";


  // a variável irá guardar as informações preenchidas no form pelo usuário
  let newUser = {
    nome: '',
    cpf: '',
    email: '',
    pwd: '',
    confPwd: ''
  };

  // caso ocorra erros, os objetos dessa variável serão preenchidas e,
  // consequentemente, irá alertar ao usuário sobre o erro
  let erros = {
    nome: '',
    cpf: '',
    email: '',
    pwd: '',
    confPwd: ''
  };
  let validar = false;

  function submit() {
    validar = true;

    // se uma das checagens falhar, a validação será cancelada e
    // uma mensagem de erro será emitida

    // nome
    let nomeSplit = newUser.nome.split("");
    let nomeEspacamento = false;
    nomeSplit.forEach(function (nome) {
      if(nome === " ") {
        nomeEspacamento = true;
      }
    })

    if (newUser.nome.trim().length < 1) {
      validar = false;
      erros.nome = 'Insira seu nome.'
    } else if (nomeEspacamento == false) {
      validar = false;
      erros.nome = 'Insira seu nome e sobrenome.'
    } else if (newUser.nome.trim().length < 5) {
      validar = false;
      erros.nome = 'Caracteres insuficientes.'
    } else {
      erros.nome = ''
    }
    // cpf
    if (newUser.cpf.trim().length < 1) {
      validar = false;
      erros.cpf = 'Insira seu CPF.'
    } else if (newUser.cpf.trim().length != 11) {
      validar = false;
      erros.cpf = 'Insira um CPF válido de 11(onze) dígitos.'
    } else {
      erros.cpf = ''
    }
    // email
    if (newUser.email.trim().length < 1) {
      validar = false;
      erros.email = 'Insira seu Email.'
    } else {
      erros.email = ''
    }
    // pwd
    if (newUser.pwd.trim().length < 1) {
      validar = false;
      erros.pwd = 'Insira sua senha.'
    } else if (newUser.pwd.length < 8) {
      validar = false;
      erros.pwd = 'A senha deve conter pelo menos 8 dígitos.'
    } else {
      erros.pwd = ''
    }
    // confPwd
    if (newUser.pwd != newUser.confPwd) {
      validar = false;
      erros.confPwd = 'As senhas não batem.'
    } else {
      erros.confPwd = ''
    }

    // validar e criar cadastro
    if (validar) {
      console.log(newUser);
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

    <!-- Lista do formulário -->

    <form>
      <div class="form-field">
        <label for="nome">Nome</label>
        <input type="text" id="nome" placeholder="Seu nome" autocomplete="off" bind:value={newUser.nome}>
        <div class="error">{ erros.nome }</div>
      </div>
      <div class="form-field">
        <label for="cpf">CPF</label>
        <input type="text" id="cpf" placeholder="Insira somente números" autocomplete="off" bind:value={newUser.cpf}>
        <div class="error">{ erros.cpf }</div>
      </div>
      <div class="form-field">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="contato@email.com" autocomplete="off" bind:value={newUser.email}>
        <div class="error">{ erros.email }</div>
      </div>
      <div class="form-field">
        <label for="senha">Senha</label>
        <input type="password" id="senha" autocomplete="off" bind:value={newUser.pwd}>
        <div class="error">{ erros.pwd }</div>
      </div>
      <div class="form-field">
        <label for="confSenha">Confirmar senha</label>
        <input type="password" id="confSenha" autocomplete="off" bind:value={newUser.confPwd}>
        <div class="error">{ erros.confPwd }</div>
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
    flex-direction: row;
    height: 100%;
    margin: 0;
  }
  label {
    font: var(--roboto-s);
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
    font: var(--roboto-xs);
    color: #C65454;
  }
</style>