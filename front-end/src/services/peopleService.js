import axios from "./api";

async function postPeople(data) {
  const response = await axios.post("/people", data);
  return response.data;
}

export {
  postPeople,
}