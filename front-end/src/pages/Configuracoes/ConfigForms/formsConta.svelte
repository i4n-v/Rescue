<script>
    import {FormInput} from "../../../components/FormInput/FormInput.svelte"
    import {validate,cpfMask} from "../../../scripts/validateForm"

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


<form name="Conta">
    <FormInput 
    id="nome"
          type="text"
          label="Nome"
          placeholder="Seu nome"
          required
          value={nome.value}
          error={nome.error}
          setValue={(value) => {
            nome = {
              value: value,
              error: validate(value).describe,
            };
        }
    }
    />
    <FormInput
            id="cpf"
            type="text"
            label="CPF"
            placeholder="000.000.000-00"
            required
            maxlength="14"
            value={cpf.value}
            error={cpf.error}
            setValue={(value) => {
              cpf = {
                value: cpfMask(value),
                error: validate(value, "cpf").describe,
            };
        }
    }
    />
    <FormInput
          id="email"
          type="text"
          label="Email"
          placeholder="contato@email.com"
          required
          className="col-span-2"
          value={email.value}
          error={email.error}
          setValue={(value) => {
            email = {
                value: value,
                error: validate(value, "email").describe,
            };
        }
    }
    />    
</form>

<style>
    :global(.col-span-2) {
      grid-column: 1/-1;
    }
    :global(.col-span-2) {
    grid-column: 1/3;
  }
</style>