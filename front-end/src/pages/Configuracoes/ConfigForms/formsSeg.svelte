<script>
 import {FormInput} from "../../../components/FormInput/FormInput.svelte"
 import {validate} from "../../../scripts/validateForm"
 
 let senhaAnterior = {
    value: "",
    error: null,
  };
  let novaSenha = {
    value: "",
    error: null,
  };
  let confirmSenha = {
    value: "",
    error: null,
  };
</script>

<form id="Seguranca">

    <FormInput
            id="senhaAnterior"
            type="password"
            label="Senha Anterior"
            minlength="8"
            required
            className="col-span-2"
            value={senhaAnterior.value}
            error={senhaAnterior.error}
            setValue={(value) => {
              senhaAnterior = {
                value: value,
                error: validate(value, "password").describe,
            };
        }
    }
    />
    <FormInput
            id="novaSenha"
            type="password"
            label="Nova Senha"
            minlength="8"
            required
            className="col-span-2"
            value={novaSenha.value}
            error={novaSenha.error}
            setValue={(value) => {
              novaSenha = {
                value: value,
                error: validate(value, "password").describe,
            };
        }
    }
  />
    <FormInput
            id="confirmSenha"
            type="password"
            label="Confirmar Senha"
            minlength="8"
            required
            className="col-span-2"
            value={confirmSenha.value}
            error={confirmSenha.error}
            setValue={(value) => {
              confirmSenha = {
                value: value,
                error: validate(value, "password").describe,
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