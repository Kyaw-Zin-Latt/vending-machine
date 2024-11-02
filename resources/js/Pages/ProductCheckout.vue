<template>
    <Head title="Product Checkout" />

    <Navbar />

    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 my-4">

        <div v-if="isShowAlert" :class="['p-2 mb-4 text-sm  dark:bg-gray-800 rounded-lg', {'text-green-500 bg-green-50' : status.flag == 'success'}, {'text-red-500 bg-red-50' : status.flag == 'error'}]" role="alert">
            <p class="font-semibold text-xl">Checkout Success!</p>
        </div>

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
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Product Checkout</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="container mx-auto mt-10">
        <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl">Product Details</h1>
                </div>
                <div class="flex mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Name</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                    <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
                </div>
                <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">

                    <div class="flex w-2/5"> <!-- product -->
                        <div class="flex flex-col justify-between ml-4 flex-grow">
                            <span class="font-bold text-xl">{{ product.name }}</span>
                            <span class="font-bold text-red-500 text-xs">Only {{ product.quantity_available }} Quantity In Stock</span>
                        </div>
                    </div>

                    <div class="flex justify-center w-1/5">
                        <button @click="decreaseQuantity">
                            <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                            </svg>
                        </button>

                        <span class="mx-2 border text-center w-8">{{ quantity }}</span>

                        <button @click="increaseQuantity">
                            <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                            <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                            </svg>
                        </button>

                    </div>
                    <span class="text-center w-1/5 font-semibold text-sm">
                        {{ product.currency.currency_symbol }} {{ product.price }}
                    </span>
                    <span class="text-center w-1/5 font-semibold text-sm">{{ product.currency.currency_symbol }} {{ product.price }}</span>
                </div>


                <button @click="handleToGoHome" class="flex font-semibold text-indigo-600 text-sm mt-10">

                    <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
                    Continue Shopping
                </button>
            </div>

            <div id="summary" class="w-1/4 px-8 py-10">
                <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>

                <div class="border-t mt-8">
                    <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                        <span>Total cost</span>
                        <span>{{ product.currency.currency_symbol }} {{ totalPrice }}</span>
                    </div>
                    <button @click="handleCheckout(product.id)" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
                </div>
            </div>

            </div>
        </div>



    </div>

</template>

<script>
import { defineComponent, ref } from 'vue'
import { Head, Link, router, useForm } from '@inertiajs/vue3';
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
    props:['canLogin', 'product', 'status', 'canRegister'],
    setup(props) {

        const quantity = ref(1);
        const totalPrice = ref(props.product.price);
        const isShowAlert = ref(false);

        let form = useForm({
            quantity : '',
            totalPrice : ''
        });


        const handleToGoHome = () => {
            router.get(route('home'));
        }

        const calculatePrice = () => {
            const price = quantity.value * props.product.price;
            totalPrice.value = parseFloat(price.toFixed(2));
            form.totalPrice = totalPrice.value;
        }

        const increaseQuantity = () => {
            if (quantity.value < props.product.quantity_available) {
                quantity.value++;
                form.quantity = quantity.value;
                calculatePrice();
            }
        }

        const decreaseQuantity = () => {
            if (quantity.value > 1) {
                quantity.value--;
                form.quantity = quantity.value;
                calculatePrice();
            }
        }

        const handleCheckout = (id) => {
            router.post(route('admin.products.checkout', id), form,{
                onSuccess: () => {
                    isShowAlert.value = true;

                    setTimeout(() => {
                        isShowAlert.value = false;
                    }, 5000);

                    router.get(route('home'));

                }
            })
        }

        return {
            handleToGoHome,
            increaseQuantity,
            decreaseQuantity,
            calculatePrice,
            quantity,
            totalPrice,
            handleCheckout,
            isShowAlert
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
