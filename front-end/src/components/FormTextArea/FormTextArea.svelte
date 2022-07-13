<script>
  // Atributes
  export let id = "";
  export let type = "text";
  export let placeholder = "";
  export let className = "";
  export let disabled = false;
  export let required = false;
  export let maxlength = false;
  export let minlength = 0;
  export let rows = 0;
  export let cols = 0;
  export let maxWidth = "100%";
  export let label = "Label";
  export let value = null;
  export let error = null;

  // Events
  export let setValue = () => {};
</script>

<div class={`field-container ${className}`} style={`max-width: ${maxWidth}`}>
  <label class="label-form" for={id}>
    {label}
    <span>{required ? "*" : ""}</span>
  </label>
  <textarea
    {id}
    name={id}
    {type}
    {placeholder}
    {value}
    {disabled}
    {rows}
    {cols}
    {maxlength}
    {minlength}
    class="field-form"
    on:keypress={({ target }) => setValue(target.value)}
    on:change={({ target }) => setValue(target.value)}
    on:blur={({ target }) => setValue(target.value)}
  />
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

  .field-form {
    min-height: 48px;
    padding: 0px 10px;
    background: var(--c01);
    border: 1px solid var(--c02);
    border-radius: 5px;
    font: var(--roboto-s);
    color: var(--c11);
    transition: 0.3s;
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
</style>
