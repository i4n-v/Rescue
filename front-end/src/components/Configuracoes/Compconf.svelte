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
}
 </style>