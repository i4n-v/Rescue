<script>
  import { Router, Route } from "svelte-routing";
  import { Home, Cadastro } from "./pages";
  import { Header, Footer, Wrapper, FormInput } from "./components/";
  import Duvidas from "./pages/Duvidas/Duvidas.svelte";
  import Configuracoes from "./pages/Configuracoes/Config.svelte";
  export let urlRouter = window.location.pathname;
</script>

<Router url={urlRouter}>
  <Header />
  <Wrapper>
    <Route path="/" component={Home} />
    <Route path="/duvidas" component={Duvidas} />
    <Route path="/cadastro" component={Cadastro} />
    <Route path="/login" component={Home} />
    <Route path="/recuperar_senha" component={Home} />
    <Route path="/inicio" component={Home} />
    <Route path="/perfil" component={Home} />
    <Route path="/configuracoes" component={Configuracoes} />
  </Wrapper>
  <Footer />
</Router>
