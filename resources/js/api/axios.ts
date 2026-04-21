import axios from "axios"

const api = axios.create({
    baseURL: "/api",
    headers: {
        "X-Requested-With": "XMLHttpRequest"
    }
})

const token = localStorage.getItem("token")

if (token) {
    api.defaults.headers.common["Authorization"] = `Bearer ${token}`
}

api.interceptors.response.use(
    response => response,
    error => {
        if (error.response?.status === 401) {
            localStorage.removeItem("token")
            delete api.defaults.headers.common["Authorization"]
        }

        return Promise.reject(error)
    }
)

export default api
