import {defineStore} from 'pinia'
import {useHttp} from "@inertiajs/vue3";
import {ref} from "vue";



export const useFiltersStore = defineStore('useFiltersStore', {
    state: () => ({
        categories: ref([])
    }),

    actions: {
        async getCategories() {

            if (this.categories.data?.length > 0  ) return this.categories.data
            console.log(this.categories.data)
            try {
                const http = useHttp()
                this.categories = await http.get(`/api/categories`)

                return this.categories
            }catch (err){
                console.error('Request error:', err);
            }finally {

            }

        },

    },
})


