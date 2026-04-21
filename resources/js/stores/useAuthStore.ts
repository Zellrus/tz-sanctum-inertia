import { defineStore } from "pinia"
import api from "@/api/axios"

export const useAuthStore = defineStore("auth", {
    state: () => ({
        token: localStorage.getItem("token") as string | null,
        user: null as any
    }),

    getters: {
        isAuthenticated: (state) => !!state.token
    },

    actions: {

        async login(credentials: { email: string; password: string }) {
            try {
                const { data } = await api.post("/login", credentials)

                this.token = data.token
                this.user = data.user

                localStorage.setItem("token", data.token)

                api.defaults.headers.common["Authorization"] =
                    `Bearer ${data.token}`

                return { success: true }
            } catch (error: any) {

                if (error.response?.status === 422) {
                    return {
                        success: false,
                        errors: error.response.data.errors
                    }
                }

                return {
                    success: false,
                }
            }
        },

        async fetchUser() {
            const { data } = await api.get("/user")
            this.user = data
        },

        async logout() {

            try {
                await api.post("/logout")
            } catch {}

            this.token = null
            this.user = null

            localStorage.removeItem("token")

            delete api.defaults.headers.common["Authorization"]
        }
    }
})
