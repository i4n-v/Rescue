import axios from "./api";

async function postInstitution(data) {
  const response = await axios.post("/institution", data);
  return response.data;
}

export {
  postInstitution,
}