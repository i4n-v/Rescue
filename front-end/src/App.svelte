<script>
  import { Router, Route } from "svelte-routing";
  import {
    Home,
    Cadastro,
    Login,
    Duvidas,
    TimeLine,
    Configuracoes,
  } from "./pages";

  let urlRouter = window.location.pathname;
</script>

<Router url={urlRouter}>
  <Route path="/" component={Home} />
  <Route path="/duvidas" component={Duvidas} />
  <Route path="/cadastro" component={Cadastro} />
  <Route path="/login" component={Login} />
  <Route path="/recuperar_senha" component={Home} />
  <Route path="/inicio" component={TimeLine} />
  <Route path="/perfil" component={Home} />
  <Route path="/configuracoes" component={Configuracoes} />
</Router>
