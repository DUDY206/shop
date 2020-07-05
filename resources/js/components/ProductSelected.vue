<template>
    <tr>
        <td>
            <input type="checkbox" checked>
        </td>
        <td>
            <img v-bind:src="product.main_image" class="img-circle img-size-32 mr-2"><br>
            {{product.name}}
        </td>
        <td >
            <div class="inputQuantity ">
                <button class="btn-dark"
                        type="button"
                        @click="decrease" style="width: 20%">-</button>
                <input v-on:change="setProductQuanitySelected" type="number" style="width: 30%" v-model="quantity">
                <button class="btn-dark"
                        type="button"
                        @click="increase" style="width: 20%">+</button></div>
        </td>
        <td>
            {{formatNumber(product.price_out)}}
        </td>
        <td >
            {{formatNumber(total)}}
        </td>
    </tr>
</template>

<script>
    import VueNumberInput from "@chenfengyuan/vue-number-input";
    import EventBus from "../event-bus";

    export default {
        name: "ProductSelected",
        props:['product'],
        created() {
            this.product.checked = true;
        },
        data(){
            return {
                quantity:this.product.quantity_selected,
                total:(parseInt(this.product.quantity_selected)*parseInt(this.product.price_out)),
            }
        },
        methods:{
            formatNumber(number){
                return number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            },
            isInvalid(){
                return this.quantity<=0 || this.quantity>this.product.quantity;
            },
            decrease(){
                if(!this.isInvalid()){
                    this.quantity=parseInt(this.quantity)-10;
                    if(this.isInvalid()){
                        this.quantity=parseInt(this.quantity)+10;
                        this.viewErrorQuantity();
                    }
                    this.setProductQuanitySelected();
                    this.total = this.formatNumber(parseInt(this.quantity)*parseInt(this.product.price_out))
                }
            },
            increase(){
                if(!this.isInvalid()){
                    this.quantity=parseInt(this.quantity)+10;
                    if(this.isInvalid()){
                        this.viewErrorQuantity();
                        this.quantity=parseInt(this.quantity)-10;
                    }
                    this.setProductQuanitySelected();
                    this.total = this.formatNumber(parseInt(this.quantity)*parseInt(this.product.price_out))
                }
            },
            setProductQuanitySelected(){
                if(!this.isInvalid()){
                    this.product.quantity_selected = parseInt(this.quantity);
                    EventBus.$emit('changeSeletedQuantity');
                }else{
                    this.quantity=100;
                    this.product.quantity_selected = 100;
                    this.viewErrorQuantity();
                }
            },
            viewErrorQuantity(){
                this.$toast.error("Quantity is invalid","Error",{
                    timeout:3000,
                    position:'center',
                })
            }
        }
    }
</script>

<style scoped>
    th,td{
        padding:0.25rem!important;
    }
    .img-size-32{
        max-width: 40px;
    }
</style>
