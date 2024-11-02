<template>
    <Head title="Home" />

    <Navbar />


    <div class="flex grid grid-cols-3 md:grid-cols-3 gap-4 mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 my-4">

        <div v-for="product in products" :key="product.id" class="cursor-pointer mb-4 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div @click="handleGoToProductDetail(product.id)" class="px-5 py-5">
                <div class="mt-2.5 mb-5" href="#">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        {{ product.name }}
                    </h5>
                </div>

                <div class="flex items-center justify-between">
                    <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ product.currency.currency_symbol }} {{ product.price }}</span>
                    <button @click="handleGoToProductDetail(product.id)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Detail</button>
                </div>
            </div>
        </div>

    </div>


</template>

<script>
import { defineComponent, ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Navbar from '@/Components/Navbar.vue'


export default defineComponent({
    name: "Index",
    components: {
        Dropdown,
        DropdownLink,
        Navbar,
        Head
    },
    props:['canLogin', 'products', 'canRegister'],
    setup(props) {

        const handleGoToProductDetail = (id) => {
            router.get(route('productDetail', id));
        }

        return {
            handleGoToProductDetail
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
