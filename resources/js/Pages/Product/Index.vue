<template>
    <AppLayout title="Product">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white px-2 py-4 overflow-hidden shadow-xl sm:rounded-lg">

                    <div v-if="isShowAlert" :class="['p-2 mb-4 text-sm  dark:bg-gray-800 rounded-lg', {'text-green-500 bg-green-50' : status.flag == 'success'}, {'text-red-500 bg-red-50' : status.flag == 'error'}]" role="alert">
                        <p class="font-semibold text-xl">{{ status.msg }}</p>
                    </div>

                    <div class="flex justify-between">
                        <button @click="handleCreate()" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Add New Product
                        </button>

                        <div class="w-100">
                            <input v-model="params.searchKey" type="search" id="default-search" class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search ..." />
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            ID
                                            <div @click="handleSort('id')">
                                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Product Name
                                            <div @click="handleSort('name')">
                                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Available Quantity
                                            <div @click="handleSort('quantity_available')">
                                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Currency

                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Price
                                            <div @click="handleSort('price')">
                                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Action
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="products.data.length > 0" v-for="product in products.data" :key="product.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ product.id }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ product.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ product.quantity_available }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ product.currency.currency_symbol }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ product.price }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="">
                                            <button @click="handleEdit(product.id)" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-900">Edit</button>
                                            <button @click="handleDelete(product.id)" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="6" class="text-center px-6 py-4">
                                        There is no Project
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <div class="flex flex-col items-center justify-between mt-5 sm:flex-row sm:mt-6 lg:mt-8">
                            <p class="text-base font-normal text-secondary-600 " >
                                Showing
                                {{ " " }}
                                <span class="font-medium">{{ products.total > 0 ? ( products.current_page - 1) *  products.per_page + 1 : 0 }}</span>
                                {{ " " }}
                                to
                                {{ " " }}
                                <span class="font-medium">{{
                                        products.current_page * products.per_page > products.total ? products.total :  products.current_page * products.per_page
                                }}</span>
                                {{ " " }}
                                of
                                {{ " " }}
                                <span class="font-medium">{{ products.total }}</span>
                                {{ " " }}
                                entries
                            </p>

                            <div class="flex justify-center space-x-1 align-middle sm:mt-4 rtl:space-x-reverse" v-if="products.total > products.per_page " >
                                <Link v-for="(link,index) in products.links" :key="index" :href="link.url ? link.url : ''" class="h-8 bg-white rounded dark:bg-secondaryDark-black">
                                    <div class="flex">

                                        <button v-if="index == 0"  hover="" focus="" type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                                            <<
                                        </button>

                                        <button v-else-if="index == products.data.keys(products.links).length -1"  hover="" focus="" type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                                            >>
                                        </button>


                                        <button v-else-if="link.url"  hover="" focus="" type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                                            {{link.label}}
                                        </button>
                                    </div>
                                </Link>
                            </div>
                        </div>


                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { defineComponent, ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, useForm, Link } from "@inertiajs/vue3";
import {debounce} from "lodash";

export default defineComponent({
    name: "Index",
    components: {
        AppLayout,
        Link
    },
    props:['products', 'filteredValue', 'status'],
    setup(props) {
        const isShowAlert = ref(false);

        let params = useForm({
            searchKey : props.filteredValue?.searchKey,
            field: props.filteredValue?.field,
            direction: props.filteredValue?.direction,
            perPage: '10'
        });

        function handleSort(field) {
            params.field = field;
            params.direction = params.direction == 'asc' ? "desc" : "asc";
        }

        function handleCreate() {
            this.$inertia.get(route('admin.products.create'))
        }

        function handleEdit(id) {
            this.$inertia.get(route('admin.products.edit', id))
        }

        function handleDelete(id) {
            this.$inertia.delete(route('admin.products.destroy', id),{
                onSuccess: () => {
                    this.isShowAlert = true;

                    setTimeout(() => {
                        this.isShowAlert = false;
                    }, 4000);
                }
            })
        }

        return {
            isShowAlert,
            params,
            handleSort,
            handleCreate,
            handleEdit,
            handleDelete
        }
    },
    watch: {
        params: {
            handler : debounce(function (val){
                console.log(val);
                this.$inertia.get(route('admin.products.index'), this.params, {
                        replace : true,
                        preserveState: true
                    })

            }, 100),
            deep: true
        }
    },
    computed: {

    },
    methods: {

    },
    created() {


    },
})
</script>
