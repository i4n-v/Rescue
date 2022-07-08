<script>
    import {FormInput} from "../../../components/FormInput/FormInput.svelte"
    import {validate} from "../../../scripts/validateForm"
    
    let cep = {
        value: "",
        error: null,
    };
    let estado = {
        value: "",
        error: null,
    };
    let cidade ={
        value: "",
        error: null,
    };
    let logradouro = {
        value: "",
        error: null,
    };
</script>

<form name="Endereco">
    <FormInput
            id="cep"
            type="text"
            label="Cep"
            placeholder="00000-000"
            required
            value={cep.value}
            error={cep.error}
            setValue={(value) => {
                cep = {
                    value: value,
                    error: validate(value, "cep").describe,
            };
        }
    }
    />
    <FormInput
            id="Estado"
            type="text"
            label="Estado"
            placeholder="Pernambuco"
            required
            value={estado.value}
            error={estado.error}
            setValue={(value) => {
                estado = {
                    value: value,
                    error: validate(value, "estado").describe,
            };
        }
    }
    />
    <FormInput
            id="Cidade"
            type="text"
            label="Cidade"
            placeholder="Recife"
            required
            className="col-span-2"
            value={cidade.value}
            error={cidade.error}
            setValue={(value) => {
                cidade = {
                    value: value,
                    error: validate(value, "cidade").describe,
            };
        }
    }
    />
    <FormInput
            id="Logradouro"
            type="text"
            label="Logradouro"
            placeholder="Rua Madona"
            required
            className="col-span-2"
            value={logradouro.value}
            error={logradouro.error}
            setValue={(value) => {
                logradouro = {
                    value: value,
                    error: validate(value, "logradouro").describe,
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