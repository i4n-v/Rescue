<script>
import Compconf from "../../components/Configuracoes/Compconf.svelte"
import formsConta from "./ConfigForms/formsConta.svelte";
import formsEndereco from "./ConfigForms/formsEndereco.svelte";
import formsSeg from "./ConfigForms/formsSeg.svelte";

const tabs = [
  {name: "Conta", component: formsConta},
  {name: "Endereço", component: formsEndereco},
  {name: "Segurança", component: formsSeg}
]
</script>





<style>


</style>