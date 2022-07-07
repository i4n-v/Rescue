<script>
  // Atributes
  export let id = "";
  export let disabled = false;
  export let maxWidth = "100%";
  export let defaultValue = "-";
  export let options = [];
  export let value = null;

  // Events
  export let setValue = () => {};
</script>

<select
  {id}
  name={id}
  {value}
  {disabled}
  class="field-form"
  style={`max-width: ${maxWidth}`}
  on:change={({ target }) => setValue(target.value)}
>
  <option value={defaultValue} selected>{defaultValue}</option>
  {#each options as option}
    <option value={option}>{option}</option>
  {/each}
</select>

<style>
  .field-form {
    min-height: 48px;
    min-width: 270px;
    padding: 0px 20px;
    background: var(--c01);
    border: 1px solid var(--c02);
    border-radius: 5px;
    font: var(--roboto-s);
    color: var(--c11);
    transition: 0.3s;
    text-align: center;
  }

  .field-form::placeholder {
    font: var(--roboto-s);
    color: var(--c07);
  }

  .field-form:focus,
  .field-form:hover {
    outline: none;
    border-color: var(--p02);
    box-shadow: 0px 0px 0px 2px var(--p01);
  }
</style>
