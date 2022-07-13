function cpfMask(cpf) {
  const splitedCpf = cpf.replace(/\W/g, "").split("");
  let formatedCpf = "";

  splitedCpf.forEach((num, index) => {
    if (index === 3 || index === 6) {
      formatedCpf += "." + num;
    } else if (index === 9) {
      formatedCpf += "-" + num;
    } else {
      formatedCpf += num;
    }
  });

  return formatedCpf;
}

function cnpjMask(cnpj) {
  const splitedCnpj = cnpj.replace(/\W/g, "").split("");
  let formatedCnpj = "";

  splitedCnpj.forEach((num, index) => {
    if (index === 2 || index === 5) {
      formatedCnpj += "." + num;
    } else if (index === 8) {
      formatedCnpj += "/" + num;
    } else if (index === 12) {
      formatedCnpj += "-" + num;
    } else {
      formatedCnpj += num;
    }
  });

  return formatedCnpj;
}

const validate = (value, type) => {
  const types = {
    email: {
      regex: /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
      message: 'Preencha um email válido',
    },
    password: {
      regex: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/,
      message:
        'A senha precisa ter 1 caracter maíusculo, 1 minúsculo e 1 digito. Com no mínimo 8 caracteres.',
    },
    number: {
      regex: /^\d+$/,
      message: 'Utilize números apenas.',
    },
    cpf: {
      regex: /^[0-9]{3}.?[0-9]{3}.?[0-9]{3}-?[0-9]{2}/,
      message: 'CPF inválido.',
    },
    cnpj: {
      regex: /^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/,
      message: 'CNPJ inválido.',
    }
  };

  if (type === false) return true;
  if (value.length === 0 || value === "-") {
    return {
      valide: false,
      describe: 'Preencha um valor.'
    };
  } else if (types[type] && !types[type].regex.test(value)) {
    return {
      valide: false,
      describe: types[type].message
    };
  } else {
    return {
      valide: true,
      describe: null,
    };
  }
}

export {
  validate,
  cpfMask,
  cnpjMask,
}