<script>
import BluePoint from  "../../assets/svg/BluePoint.svelte";
import Dropdown from  "../../assets/svg/Dropdown.svelte";
export let pergunta = "";
export let resposta = "";

let display = false;
function isRotated(){
    display = !display
}
function click(){
    display = !display
}
</script>
    <ul class="list">
        <li class="list-item">
            
            <div class="list-quest" >
                <span class="point">
                    <BluePoint/>
                </span>
                <h2>
                    {pergunta}
                </h2>
                <span class={`dropdown ${display ? "" : "rotate"}`}  on:click={click}  >
                    <Dropdown/>
                </span>
            </div>
            <div class={display ? "list-answer-off" : "list-answer-on"} >
                <p>{resposta}</p>
            </div>
        </li>
    </ul>
<style>
.list{
    padding: 20px;
    list-style: none;
    position: relative;
}

.list-item{
    padding:20px;
}

.list-quest{
    color: var(--c11);
    font: var(--poppins-m);
    margin-bottom:15px;
    display: flex;
    align-items:center ;
    gap: 8px;
}
.list-answer-on{
    color: var(--c09);
    font:var(--roboto-m);
    display: block;
}
.list-answer-off{
    color: var(--c09);
    font:var(--roboto-m);
    display: none;
}

 .list-item .dropdown{
    position: absolute;
    right: 12px;
    cursor: pointer;
}

.rotate{
    transform: rotate(180deg);
}

@media(max-width : 600px){
    .list-quest{
        font: var(--poppins-s);
    }
    .list-answer-on{
    font: var(--roboto-s);
    }
}

@media(max-width :400px){
    .list-quest{
        font: var(--poppins-xs);
    }
    .list-answer-on{
    font: var(--roboto-xs);
    }
}
</style>
