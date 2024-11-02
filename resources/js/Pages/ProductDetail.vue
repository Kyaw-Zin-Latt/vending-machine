<template>
    <Head title="Product Detail" />

    <Navbar />

    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 my-4">



        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <button @click="handleToGoHome" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Home
                    </button>
                </li>

                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Product Detail</span>
                    </div>
                </li>
            </ol>
        </nav>


        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">

            <p class="text-3xl font-semibold leading-tight text-gray-900 dark:text-white">
                Product Name - {{ product.name }}
            </p>

            <p class="my-3 text-xl font-semibold text-gray-900 dark:text-white">
                Available Quantity - <span class="">{{ product.quantity_available }}</span>
            </p>

            <div class="mt-4 flex items-center justify-between gap-4">
                <p class="text-2xl font-extrabold text-gray-900 dark:text-white">
                    Price - {{ product.currency.currency_symbol }} {{ product.price }}
                </p>

                <button @click="handleToGoCheckout(product.id)" type="button" :class="[{'cursor-not-allowed' : product.quantity_available == 0}, 'inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 ']">
                    Buy Now
                </button>
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
    props:['canLogin', 'product', 'canRegister'],
    setup(props) {


        const handleToGoHome = () => {
            router.get(route('home'));
        }

        const handleToGoCheckout = (id) => {
            if(props.product.quantity_available == 0) {
                return ;
            }
            router.get(route('productCheckout', id));
        }



        return {
            handleToGoHome,
            handleToGoCheckout
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
