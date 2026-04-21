import {defineStore} from 'pinia'
import {useHttp} from "@inertiajs/vue3";



export const useActiveFiltersStore = defineStore('useActiveFiltersStore', {
    state: () => ({
        filters: {
            page: 1,
            search: '',
            category_id: null,
        },
        loading: false,
        per_page: 10,
        filteredData: null,
    }),

    actions: {
        async getFilteredData() {
            window.scrollTo({top: 0, behavior: 'smooth'})
            this.loading = true;

            const queryParams = {
                page: this.filters.page,
                search: this.filters.search,
                category_id: this.filters.category_id,
            };
            try {
                const http = useHttp(queryParams)
                this.filteredData = await http.get('/api/products')
                return this.filteredData
            }catch (err){
                console.error('Request error:', err);
            }finally {
                this.loading = false;
            }

        },
        resetFilterFields() {
            this.filters.page=1;
            this.filters.search = '';
            this.filters.category_id = null;
            this.loading = false;
        },

        async resetFilter() {
            this.resetFilterFields();
            this.getFilteredData();
        },
    },
})
