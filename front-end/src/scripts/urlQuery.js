const urlQuery = (obj) => {
  Object.keys(obj).forEach((value) => {
    if (obj[value] === undefined) {
      obj[value] = "";
    }
  });

  const querystring = Object.entries(obj)
    .map((pair) => pair.map(encodeURIComponent).join("="))
    .join("&");
  return new URLSearchParams(querystring);
};

export default urlQuery;
