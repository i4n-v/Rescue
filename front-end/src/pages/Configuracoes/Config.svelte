<script>
import Compconf from "../../components/Configuracoes/Compconf.svelte"
</script>

<div class="container">

    <div class="black-box">
        <Compconf buttonName="Conta"/>
        <div class="borda"></div>
        <Compconf buttonName="Endereço"/>
        <div class="borda"></div>
        <Compconf buttonName="Segurança"/>
        <div class="borda"></div>
    </div>
    <div class="grey-box">
        <input type="text" placeholder="teste">
        <input type="text" placeholder="teste">
        <input type="text" placeholder="teste">
    </div>
    
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