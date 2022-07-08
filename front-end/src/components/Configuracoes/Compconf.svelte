<script>
    export let buttonName ="";
</script>

<div class="container grey-box">
    <div class="black-box tab">
        <button class="select-button">{buttonName}</button> 
        <div class="borda"></div>
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
    background-color: var(--c01);
    
    

}

.black-box{
    background-color: var(--c11);
    height: 600px;
    width: 275px;
    display: flex;
    flex-direction: column;
    align-items: center;
    
}
.borda{
    background-color: var(--c10);
    height: 2px;
    width: 195px;
}

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