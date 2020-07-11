<template>
    <div>
        <div class="card product" >
            <div class="product-image">
                <img class="card-img-top p-2" v-bind:src="img_src" alt="Card image cap" @click="viewProDetail">
                <div class="sale-image"><p>Sale 50%</p></div>
            </div>
            <div class="card-body">
                <star-rating
                    v-bind:star-size="20"
                    v-bind:read-only="true"
                    v-bind:rating="avg_rate"
                    v-bind:increment="0.5"
                ></star-rating>
                <h5 class="card-title align-content-center" @click="viewProDetail"><strong>{{name}}</strong></h5>
                <p class="card-text"><strong>Size:</strong> {{size}}</p>
                <i class="text-sm-left">SL còn: {{quantity_in}}</i>
                <h4 style=""><b class="text-lg-left text-danger">{{price_out}} đ</b></h4>
            </div>
            <div class="pl-3 pr-3 pb-3">
                <div class="inputQuantity ">
                    <button class="btn-dark"
                            type="button"
                            @click="decrease" style="width: 20%">-</button>
                    <input type="number" style="width: 60%" v-model="quantity" v-on:change="setProductQuanitySelected">
                    <button class="btn-dark"
                            type="button"
                            @click="increase" style="width: 20%">+</button>
                </div>
                <br>
                <a  class="card-link text-primary" @click="addProToCart"><span class="fas fa-1x fa-plus-circle"></span> Them gio hang</a><br>
                <a  class="card-link text-success" @click="viewProDetail"><span class="fas fa-1x fa-eye"></span> Xem chi tiet</a>
            </div>
        </div>
    </div>
</template>

<script>
    import StarRating from 'vue-star-rating';
    import VueNumberInput from '@chenfengyuan/vue-number-input';
    import EventBus from '../event-bus';

    export default {
        name: "Product",
        components:{
            StarRating,VueNumberInput
        },
        created() {
            EventBus.$on('change', ()=>{
                this.quantity = newValue;
            });
        },
        props:['product'],
        data(){
            return {
                id:this.product.id,
                name:this.product.name,
                img_src:this.product.main_image,
                quantity:100,
                quantity_in:this.product.quantity,
                describe:this.product.describe,
                price_out:this.product.price_out,
                size:this.product.size,
                sharedItems: VueNumberInput.data
            }
        },
        methods:{
            addProToCart(){
                if(this.isInvalid === false)
                EventBus.$emit('addProToCart',this.product,this.quantity);
            },
            viewProDetail(){
                EventBus.$emit('viewProDetail',this.product);
            },

            decrease(){
                if(!this.isInvalid){
                    this.quantity=parseInt(this.quantity)-10;
                    if(this.isInvalid()){
                        this.quantity=parseInt(this.quantity)+10;
                    }
                }
            },
            increase(){
                if(!this.isInvalid){
                    this.quantity=parseInt(this.quantity)+10;
                    if(this.isInvalid()){
                        this.quantity=parseInt(this.quantity)-10;
                    }
                }
            },
            setProductQuanitySelected(){
                if(!this.isInvalid){
                    this.product.quantity = parseInt(this.quantity);
                }else{
                    this.quantity=100;
                    this.viewErrorQuantity();
                }
            },
            viewErrorQuantity(){
                this.$toast.error("Quantity is invalid","Error",{
                    timeout:3000,
                    position:'center',
                })
            }
        },
        computed:{
            avg_rate(){
                return Math.ceil(this.product.avg_rate*2)/2;
            },
            isInvalid(){
                return this.quantity<0 || this.quantity>this.quantity_in;
            },
        }
    }
</script>

<style scoped>
    .sale-image{
        position: absolute;
        background-color: #ff0000;
        content: 'SALE';
        text-align: center;
        color: #ffffff;
        margin-top: auto;
        width: 100%;
        /*border-radius: 9999px;*/
        height: 3em;
        padding: 0em 1em 0em 1em;
        line-height: 3em;
    }
    .product-image{
        display: flex;
        text-align: center;
    }
    .inputQuantity>*{
        float: left;
    }
    .inputQuantity:after{
        display: block;
        clear: both;
        content: "";
    }
    .card-title:hover{
        text-decoration: underline;
    }
</style>
