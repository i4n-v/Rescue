<script>
  // Atributes
  export let id = "";
  export let disabled = false;
  export let maxWidth = "100%";
  export let defaultValue = "-";
  export let options = [];
  export let error = null;
  export let value = null;
  export let label = null;
  export let required = false;
  export let className = "";

  // Events
  export let setValue = () => {};
</script>

<div class={`field-container ${className}`} style={`max-width: ${maxWidth}`}>
  {#if !!label}
    <label class="label-form" for={id}>
      {label}
      <span>{required ? "*" : ""}</span>
    </label>
  {/if}
  <select
    {id}
    name={id}
    {value}
    {disabled}
    class="field-form"
    on:change={({ target }) => setValue(target.value)}
    on:blur={({ target }) => setValue(target.value)}
  >
    <option value={defaultValue} selected>{defaultValue}</option>
    {#each options as option}
      <option value={option}>{option}</option>
    {/each}
  </select>
  {#if !!error}
    <p>{error}</p>
  {/if}
</div>

<style>
  .field-container {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .label-form {
    font: var(--poppins-s);
    font-weight: 500;
    color: var(--c11);
  }

  .label-form > span {
    color: var(--v02);
  }

  .field-container > p {
    font: var(--roboto-xs);
    color: var(--v03);
  }

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
