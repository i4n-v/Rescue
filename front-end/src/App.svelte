<script>
  import { Router, Route } from "svelte-routing";
  import { Home } from "./pages";
  import { Header, Footer, Wrapper } from "./components/";
  export let urlRouter = window.location.pathname;
</script>

<Router url={urlRouter}>
  <Header />
  <Wrapper>
    <Route path="/" component={Home} />
    <Route path="/duvidas" component={Home} />
    <Route path="/cadastro" component={Home} />
    <Route path="/login" component={Home} />
    <Route path="/recuperar_senha" component={Home} />
    <Route path="/inicio" component={Home} />
    <Route path="/perfil" component={Home} />
    <Route path="/configuracoes" component={Home} />
  </Wrapper>
  <Footer />
</Router>
