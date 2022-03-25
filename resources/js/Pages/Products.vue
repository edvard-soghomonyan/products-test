<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="container mx-auto sm:px-6 lg:px-8">
                <div
                    class="
                        overflow-hidden
                        bg-white
                        shadow-sm
                        max-w-7xl
                        sm:rounded-lg
                    "
                >
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table>
                            <thead class="font-bold bg-gray-300 border-b-2">
                            <td class="px-4 py-2">ID</td>
                            <td class="px-4 py-2">Author</td>
                            <td class="px-4 py-2">Title</td>
                            <td class="px-4 py-2">Published Date</td>
                            </thead>
                            <tbody>
                            <tr v-for="product in products.data" :key="product.id">
                                <td class="px-4 py-2">{{ product.id }}</td>
                                <td class="px-4 py-2">{{ product.author.name }}</td>
                                <td class="px-4 py-2">{{ product.name }}</td>
                                <td class="px-4 py-2">{{ product.publish_date }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div v-if="products.links.length > 3">
                            <div class="flex flex-wrap -mb-1">
                                <template v-for="(link, key) in products.links">
                                    <div
                                        v-if="link.url === null"
                                        :key="key"
                                        class="
                                            px-4
                                            py-3
                                            mb-1
                                            mr-1
                                            text-sm
                                            leading-4
                                            text-gray-400
                                            border
                                            rounded
                                        "
                                        v-html="link.label"
                                    />
                                    <button
                                        v-else
                                        class="
                                            px-4
                                            py-3
                                            mb-1
                                            mr-1
                                            text-sm
                                            leading-4
                                            border
                                            rounded
                                            hover:bg-white
                                            focus:border-indigo-500 focus:text-indigo-500
                                        "
                                            :class="{ 'bg-gray-300': link.active }"
                                            @click.prevent="fetchProducts(link.label)"
                                            v-html="link.label"
                                    ></button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    data() {
        return {
            page: 1,
            products: {
                data: [],
                links: []
            }
        }
    },

    created() {
        this.fetchProducts()
    },

    methods: {
        fetchProducts(page = 1) {
            console.debug(page);
            if (page == 'Next &raquo;') {
                this.page ++;
            } else if (page == '&laquo; Previous') {
                this.page --;
            } else {
                this.page = page
            }
            axios.get(`/api/products?page=${this.page}`)
                .then(response => {
                    this.products.data = response.data.data
                    this.products.links = response.data.links
                })
        }
    }
};
</script>
