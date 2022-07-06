<script>
    export let buttonName ="";
</script>

<div class="tab">
    <button class="select-button">{buttonName}</button> 
</div> 


<style>
.tab{
    display: flex;
    flex-direction: column;
    padding: 26px;
}
.select-button{
    font: var(--poppins-l);
    color: white;
    background-color:var(--c11);
    cursor: pointer;
    border-radius: 5px;
    width: 195px;
    border: none;

}

.select-button:focus,.select-button:hover{
    outline: none;
    border-color: var(--p02);
    box-shadow: 0px 0px 0px 2px white;
}
 </style>