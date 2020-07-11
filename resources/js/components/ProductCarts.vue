<template>
<div class="position-fixed" style="max-width: 32%;min-width: 32%">
    <div class="card" style="overflow-y: auto;max-height: 80vh">
        <div class="card-header border-0 bg-primary">
            <h3 class="card-title">Carts</h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Sales</th>
                    <th>More</th>
                </tr>
                </thead>
                <tbody>
                <product-selected  v-for="product in listProductSelected" :product="product" :key="product.id +'-'+product.quantity_selected"></product-selected>
                <tr>
                    <td></td>
                    <td colspan="3"><b>Total:</b></td>
                    <td><b>{{calculate_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")}}</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3"><b>Ship(5%~15%):</b></td>
                    <td>
                        <b>{{(calculate_total*5/100).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")}}</b>
                        <br>
                            ~
                        <br>
                        <b>{{(calculate_total*15/100).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")}}</b>
                    </td>
                </tr>
                </tbody>
            </table>
            <hr>
            <div class="card-body">
                <form @submit.prevent="addCart">
                    <div class="card-title"><h4>Your info:</h4></div>
                    <div class="form-group">
                        <label >Your name</label>
                        <input type="text"  class="form-control" placeholder="Nguyen.V.A" step="1" required v-model="customer_name" name="name">
                    </div>
                    <div class="form-group">
                        <label >Phonenumber:</label>
                        <input class="form-control" placeholder="0123.456.789" step="1" name="phone_number" required v-model="customer_phonenumber" >
                    </div>
                    <div class="form-group">
                        <label >Address:</label>
                        <textarea name="address" id=""  class="form-control" required v-model="customer_address" ></textarea>
                    </div>
                    <div class="form-group">
                        <strong class="text-danger"><i>You have to pay at least 10% for deposit.</i></strong>
                    </div>
                    <div class="form-group" v-if="signedIn">
                        <input type="submit" value="Confirm and pay!!" :disabled="isInvalid" :class="button_class">
                    </div>
                    <div class="form-group" v-else>
                        <a class="btn btn-danger">You have to login first</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import EventBus from "../event-bus";
    import ProductSelected from "./ProductSelected";
    export default {
        name: "ProductCarts",
        data(){
            return {
                listProductSelected:[],
                total:0,
                customer_name:'',
                customer_phonenumber:'',
                customer_address:'',
                customer_pay_id:'BIDV_TEST_ID_01',

            }
        },
        components:{
            ProductSelected
        },
        created() {
            EventBus.$on('addProToCart', (product,quantity)=>{
                var existed = false;
                this.listProductSelected.forEach(p => {
                    if(p.id === product.id){
                        existed = true;
                        this.$toast.error("Product alreadly seleted","Error",{
                            timeout:3000,
                            position:'center',
                            zindex:999999
                        })
                    }
                });
                if(!existed){
                    this.listProductSelected.push(this.addQuantityToProduct(product,quantity))
                    existed = false;
                }
            });

            EventBus.$on('changeSeletedQuantity', ()=>{
                this.total = 0;
            });
        },
        methods:{
            addQuantityToProduct(product,quantity){
                product['quantity_selected'] = quantity;
                return product;
            },
            addCart(){
                axios.post(`carts`,{
                    'listProductSelected':this.listProductSelected,
                    'customer_pay_id':this.customer_pay_id,
                    'deposit':parseInt(this.total)*0.1,
                    'sale_value':0,
                    'user_sale_id':0,
                    'customer_name':this.customer_name,
                    'customer_phonenumber':this.customer_phonenumber,
                    'customer_address':this.customer_address,
                })
                .catch(error=>{
                    this.$toast.error(error.response.data.message,"Error")
                })
                .then(({data}) =>{
                    this.$toast.success(data.message);
                    this.listProductSelected = [];
                });
            },
        },
        computed:{
            calculate_total(){
                this.total = 0;
                this.listProductSelected.forEach(p => {
                    this.total += p.quantity_selected*p.price_out;
                });
                return this.total;
            },
            isInvalid(){
                return !this.signedIn || (this.customer_name === '') || (this.customer_phonenumber === '') || (this.customer_address === '') || !RegExp('[0-9]+').test(this.customer_phonenumber);
            },
            button_class(){
                return this.isInvalid ? 'btn btn-outline-primary btn-sm' : 'btn btn-primary btn-sm';
            }
        }

    }
</script>

<style scoped>
    th,td{
       padding:0.25rem!important;
    }
</style>
