import axios from "./api";
import cookie from "js-cookie";
import urlQuery from "../scripts/urlQuery";

async function postPost(data, params) {
  const token = cookie.get("access-token");

  const response = await axios.post("/post", data, {
    params: urlQuery(params),
    headers: {
      'Content-Type': 'multipart/form-data',
      Authorization: !!token ? `Bearer ${token}` : null
    }
  });
  return response.data;
}

async function putPost(data, params) {
  const token = cookie.get("access-token");

  const response = await axios.post("/update/post", data, {
    params: urlQuery(params),
    headers: {
      'Content-Type': 'multipart/form-data',
      Authorization: !!token ? `Bearer ${token}` : null
    }
  });
  return response.data;
}

async function getPost(params) {
  const response = await axios.get("/post", {
    params: urlQuery(params),
  });
  return response.data;
}

async function deletePost(data) {
  const token = cookie.get("access-token");

  const response = await axios.delete("/post", {
    data,
    headers: {
      Authorization: !!token ? `Bearer ${token}` : null
    }
  });
  return response.data;
}

async function getPhotos(params) {
  const response = await axios.get("/photos", {
    params: urlQuery(params),
  });
  return response.data;
}

async function getLocation(params) {
  const response = await axios.get("/location", {
    params: urlQuery(params),
  });
  return response.data;
}

async function postLike(data) {
  const token = cookie.get("access-token");

  const response = await axios.post("/like", data, {
    headers: {
      Authorization: !!token ? `Bearer ${token}` : null
    }
  });
  return response.data;
}

async function deleteLike(data) {
  const token = cookie.get("access-token");

  const response = await axios.delete("/like", {
    data,
    headers: {
      Authorization: !!token ? `Bearer ${token}` : null
    }
  });
  return response.data;
}

async function getComments(params) {
  const response = await axios.get("/comments", {
    params: urlQuery(params),
  });
  return response.data;
}

async function postComment(data) {
  const token = cookie.get("access-token");

  const response = await axios.post("/comments", data, {
    headers: {
      Authorization: !!token ? `Bearer ${token}` : null
    }
  });
  return response.data;
}

async function deleteComment(data) {
  const token = cookie.get("access-token");

  const response = await axios.delete("/comments", {
    data,
    headers: {
      Authorization: !!token ? `Bearer ${token}` : null
    }
  });
  return response.data;
}

export {
  postPost,
  putPost,
  getPost,
  deletePost,
  getPhotos,
  getLocation,
  postLike,
  deleteLike,
  getComments,
  postComment,
  deleteComment,
}