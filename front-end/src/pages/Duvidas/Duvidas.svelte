<script>
 import {ComponetDuv} from "../../components";
</script>

<div class="box">
    <h1 id="titulo"> Perguntas Frequentes<span>.</span></h1>
     <div class="list-item-grey">
        <ComponetDuv pergunta="Como vocês nos ajudam ?" resposta="Ajudamos a comunidade através da visibilidade dos problemas expostos pelos usuários, onde as ongs e instituições cadastradas na plataforma tentarão solucionar a problemática."/>
    </div> 
    <div>
        <ComponetDuv pergunta="O que acontece com meus dados ?" resposta="Todos os seus dados são protegidos de acordo com a Lei Geral de Proteção de Dados Pessoais( LGPD). Garantindo privacidade e sigilo das informações."/>
    </div>
    <div class="list-item-grey">
        <ComponetDuv pergunta="Como vocês nos ajudam ?" resposta="Ajudamos a comunidade através da visibilidade dos problemas expostos pelos usuários, onde as ongs e instituições cadastradas na plataforma tentarão solucionar a problemática."/>
    </div>
    <div>
        <ComponetDuv pergunta="Para que servem minhas postagens ?" resposta="Suas postagens permitirão que instituições, e outros usuários, possam tomar conhecimento de problemas na região. "/>
    </div>
    <div class="list-item-grey">
        <ComponetDuv pergunta="O que as instituições fazem ?" resposta="Depois de identificar e validar a problemática, as instituições auxiliam na tentativa de minimizar os prejuízos causados.  "/>
    </div>
</div>

<style>
#titulo{
    color: var(--c11);
    font: var(--poppins-xxl);
    margin-bottom:30px;
}
.box{
    margin: 120px ;
}

.list-item-grey{
    background-color: var(--c01);
}

span {
    color: var(--p01);
}

@media(max-width:600px){
    .box{margin: 70px;}
    #titulo{
        font:var(--poppins-xl)
    }
}
@media(max-width:400px){
   
    .box{margin: 50px;}
}
</style>
