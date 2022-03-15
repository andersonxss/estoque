import axios from "axios";

const api = axios.create({
  baseURL: "http://127.0.0.1:8000/api",
});

api.interceptors.request.use(async (config) => {
  try {
    const token = localStorage.getItem("TOKEN_NAME");
    config.headers.Authorization = `Bearer ${token}`;
    return config;
  } catch (error) {
    console.log(error);
  }
});

export default api;
