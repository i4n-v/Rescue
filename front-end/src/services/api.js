import axios from "axios";
import cookie from "js-cookie";

const instance = axios.create({
  baseURL: "http://127.0.0.1:8000/api"
});

const token = cookie.get("access-token");

if (token) {
  instance.defaults.headers.common = { 'Authorization': `Bearer ${token}` }
}

export default instance;
