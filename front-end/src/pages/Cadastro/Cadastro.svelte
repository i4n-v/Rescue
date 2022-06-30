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

  // let erros = {
  //   nome: '',
  //   cpf: '',
  //   email: '',
  //   pwd: ''
  // };
  let validar = false;

  

</script>


<!-- código HTML -->
<main>
  <div class="img-container">
    <img src="/src/assets/img/aside-logo.png" alt="Logo da Rescue">
  </div>

  <div class="form-container">
    <h2>Cadastre-se<span class="dot">.</span></h2>

    <form>
      <div class="form-field">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" placeholder="Seu nome" bind:value={user.nome}>
      <!--  <div class="error">{ errors.question }</div> -->
      </div>
      <div class="form-field">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" placeholder="Insira somente números" bind:value={user.cpf}>
      <!--  <div class="error">{ errors.question }</div> -->
      </div>
      <div class="form-field">
        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="contato@email.com" bind:value={user.email}>
      <!--  <div class="error">{ errors.question }</div> -->
      </div>
      <div class="form-field">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" bind:value={user.pwd}>
      <!--  <div class="error">{ errors.question }</div> -->
      </div>
      <div class="form-field">
        <label for="confSenha">Confirmar senha:</label>
        <input type="password" id="confSenha" bind:value={confPwd}>
      <!--  <div class="error">{ errors.question }</div> -->
      </div>
      <p>Já possui uma conta? Então <Link href="/login">interaja conosco</Link>.</p>
    <div class="botao">
      <Button href="">REGISTRAR-SE</Button>
    </div>
    </form>

  </div>

</main>



<!-- código CSS -->
<style>

  main {
    display: flex;
  }
  .dot {
    color: #4892BC;
  }
  .botao {
    margin-top: 2rem;
  }
</style>