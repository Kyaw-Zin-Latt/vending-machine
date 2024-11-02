<template>
    <AppLayout title="Product">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product / Add New Product
            </h2>
        </template>

        <div class="py-12">
            <div class=" sm:px-6">
                <div class="bg-white px-2 overflow-hidden shadow-xl sm:rounded-lg">



                    <div class="max-w-sm my-3">
                        <div class="mb-4">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Product Name</label>
                            <input v-model="form.name" type="text" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-white" placeholder="Enter Product Name" />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors.name }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 ">Product's Price Currency</label>
                            <select v-model="form.currency_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option disabled value="">Select a currency</option>
                                <option v-for="currency in currencies" :key="currency.id" :value="currency.id">{{ currency.currency_symbol }}</option>
                            </select>
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors.currency_id }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                            <input v-model="form.price" type="text" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-white" placeholder="Enter Product Price" />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors.price }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="number" class="block mb-2 text-sm font-medium text-gray-900">Quantity</label>
                            <input v-model="form.quantity_available" type="text" id="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 text-white" placeholder="Enter Product Quantity" />
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors.quantity_available }}</p>
                        </div>

                        <div class="flex">
                            <button @click="handleCancel" class="text-gray-800 hover:text-white me-2 w-1/2 border hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 border-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center  dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cancel</button>
                            <button @click="handleSubmit" type="button" class="text-white w-1/2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
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
    name: "Create",
    components: {
        AppLayout,
        Link
    },
    props:['status', 'errors', 'currencies'],
    setup(props) {

        let form = useForm({
            name : '',
            price: '',
            quantity_available: '',
            currency_id: ''
        });


        function handleSubmit() {
            this.$inertia.post(route('admin.products.store', form))
        }

        function handleCancel() {
            this.$inertia.get(route('admin.products.index'))
        }

        return {
            form,
            handleSubmit,
            handleCancel
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
