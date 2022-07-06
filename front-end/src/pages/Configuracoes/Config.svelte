<script>
import Compconf from "../../components/Configuracoes/Compconf.svelte"
import FormInput from "../../components/FormInput/FormInput.svelte"
import { validate, cpfMask} from "../../scripts/validateForm";

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


</script>

<div class="container grey-box">
    
    <div class="black-box">
        <Compconf buttonName="Conta"/>
        <div class="borda"></div>
        <Compconf buttonName="Endereço"/>
        <div class="borda"></div>
        <Compconf buttonName="Segurança"/>
        <div class="borda"></div>
    </div>
    <form>
        <div class="form-field">
        <FormInput label="Nome"/>
        </div>

        
    </form>
    
</div>

<style>

*{
    box-sizing: border-box;
}

.container{
    margin-top: 60px;
    margin-bottom: 120px;
    margin-left: 189px;
    margin-right: 189px;
    display: flex;
    flex-direction: row;
    
    

}

.black-box{
    background-color: var(--c11);
    height: 600px;
    width: 275px;
    display: flex;
    flex-direction: column;
    align-items: center;
    
}

.grey-box{
    background-color: var(--c01);
}

.borda{
    background-color: var(--c10);
    height: 2px;
    width: 195px;
}


</style>