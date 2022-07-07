import axios from "./api";

async function authUser(data) {
  const response = await axios.post("/login", data);
  return response.data;
}

async function getUser(id) {
  const response = await axios.get(`/user?id=${id}`);
  return response.data;
}

export {
  authUser,
  getUser,
}