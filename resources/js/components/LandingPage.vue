<template>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-4">
                <productCarts></productCarts>
            </div>
            <div class="col-8">
                <products :products="products"></products>
            </div>
        </div>
        <div>
            <product-detail
                :product="productViewing"
                v-show="isModalVisible"
                @close="closeModal"
                v-if="productViewing !== null"
            >
            </product-detail>
        </div>
    </div>
</template>

<script>
    import Products from "./Products";
    import ProductCarts from "./ProductCarts";
    import ProductDetail from "./ProductDetail";
    import EventBus from '../event-bus';
    export default {
        name: "LandingPage",
        props:['products'],
        created() {
            EventBus.$on('viewProDetail', product=>{
                this.isModalVisible = true;
                this.productViewing = product;
            });
        },
        components:{
            Products,ProductCarts,ProductDetail
        },
        data(){
            return {
                isModalVisible: false,
                productViewing: null,
            }
        },
        methods:{
            showModal() {
                this.isModalVisible = true;
            },
            closeModal() {
                this.isModalVisible = false;
                this.productViewing = null;

            }
        }
    }
</script>

<style scoped>

</style>
