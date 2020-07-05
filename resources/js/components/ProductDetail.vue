<template>
    <div class="modal-backdrop " >
        <div class="modal mt-5" style="overflow-y: auto;" >
            <header class="modal-header">
                <slot name="header">
                    <h1>THÔNG TIN SẢN PHẨM</h1>
                    <button
                        type="button"
                        class="btn-close"
                        @click="close"
                    >
                        x
                    </button>
                </slot>
            </header>
            <section class="modal-body">
                <slot name="body">
                    <div class="card card-solid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
                                    <div class="col-12">
                                        <img v-bind:src="img_src" class="product-image" alt="Product Image">
                                    </div>
                                    <div class="col-12 product-image-thumbs">
                                        <div class="product-image-thumb active"><img v-bind:src="img_src" alt="Product Image"></div>
                                        <div class="product-image-thumb" ><img v-bind:src="img_src" alt="Product Image"></div>
                                        <div class="product-image-thumb" ><img v-bind:src="img_src" alt="Product Image"></div>
                                        <div class="product-image-thumb" ><img v-bind:src="img_src" alt="Product Image"></div>
                                        <div class="product-image-thumb" ><img v-bind:src="img_src" alt="Product Image"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h3 class="my-3">{{name}}</h3>
                                    <star-rating
                                        v-bind:star-size="20"
                                        @rating-selected ="setRating"
                                        v-bind:rating="avg_rate"
                                        v-bind:increment="0.5"
                                    ></star-rating>
                                    <p>{{describe}}{{describe}}{{describe}}{{describe}}</p>
                                    <hr>

                                    <h4 class="mt-3">Size: <small>{{size}}</small></h4>
                                    <h6 class="mt-3"><i>SL còn: <small>{{quantity_in}}</small></i></h6>
                                    <div class="bg-gray mt-2">
                                        <h2 class="mb-0 text-danger">{{price_out}} đ</h2>
                                    </div>
                                    <div class="inputQuantity " st>
                                        <button class="btn-dark"
                                                type="button"
                                                @click="decrease" style="width: 20%">-</button>
                                        <input type="number" style="width: 60%" v-model="quantity">
                                        <button class="btn-dark"
                                                type="button"
                                                @click="increase" style="width: 20%">+</button>
                                    </div>
                                    <div class="mt-4">
                                        <div class="btn btn-primary btn-lg btn-flat">
                                            <a @click="addProToCart"><i class="fas fa-cart-plus fa-lg mr-2"></i>
                                                Add to Cart</a>

                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <nav class="w-100">
                                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                                <a @click.prevent="changeView('description')" class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                                                <a @click.prevent="changeView('comment')" class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                                                <a @click.prevent="changeView('rate')" class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content p-3" id="nav-tabContent" style="background-color: #22ff99">
                                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus. Duis varius finibus purus sed venenatis. Vivamus varius metus quam, id dapibus velit mattis eu. Praesent et semper risus. Vestibulum erat erat, condimentum at elit at, bibendum placerat orci. Nullam gravida velit mauris, in pellentesque urna pellentesque viverra. Nullam non pellentesque justo, et ultricies neque. Praesent vel metus rutrum, tempus erat a, rutrum ante. Quisque interdum efficitur nunc vitae consectetur. Suspendisse venenatis, tortor non convallis interdum, urna mi molestie eros, vel tempor justo lacus ac justo. Fusce id enim a erat fringilla sollicitudin ultrices vel metus.
                                            </div>
                                            <div v-if="view==='comment'"  class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                                                <comment  v-for="comment in listComments" :comment="comment" :key="comment.id"></comment>
                                                <div class="text-center mt-3" v-if="nextUrl">
                                                    <button @click.prevent="fetchComment(nextUrl)" class="btn btn-outline-secondary">Load more comments</button>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                                                <star-rating
                                                    v-if="signedIn"
                                                    v-bind:star-size="20"
                                                    v-bind:rating="avg_rate"
                                                    v-bind:increment="0.5"
                                                ></star-rating>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </slot>
            </section>
            <footer class="modal-footer">
                <slot name="footer">
                    I'm the default footer!

                    <button
                        type="button"
                        class="btn-green"
                        @click="close"
                    >
                        Close me!
                    </button>
                </slot>
            </footer>
        </div>
    </div>
</template>

<script>

    import EventBus from "../event-bus";
    import StarRating from 'vue-star-rating';
    import Comment from "./Comment";

    export default {
        name: "ProductDetail",
        props:['product'],
        components:{
            StarRating,Comment
        },
        data(){
            return {
                id:this.product.id,
                name:this.product.name,
                img_src:this.product.main_image,
                quantity:100,
                quantity_in:this.product.quantity.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."),
                describe:this.product.describe,
                price_out:this.product.price_out.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."),
                size:this.product.size,
                rating:0,
                view:'description',
                listComments:[],
                nextUrl: null,
            }
        },
        created() {
            this.fetchComment(` products/${this.product.id}/comments`);
        },
        methods:{
            close() {
                this.$emit('close');
            },
            decrease(){
                if(!this.isInvalid()){
                    this.quantity=parseInt(this.quantity)-10;
                    if(this.isInvalid()){
                        this.quantity=parseInt(this.quantity)+10;
                    }
                }
            },
            increase(){
                if(!this.isInvalid()){
                    this.quantity=parseInt(this.quantity)+10;
                    if(this.isInvalid()){
                        this.quantity=parseInt(this.quantity)-10;
                    }
                }
            },
            isInvalid(){
                return this.quantity<0 || this.quantity>this.quantity_in;
            },
            addProToCart(){
                EventBus.$emit('addProToCart',this.product,this.quantity);
            },
            setRating: function(rating){
                this.rating = rating;
            },
            changeView(view){
                this.view = view;
            },
            fetchComment(endpoint){
                axios.get(endpoint)
                .then(({data}) =>{
                    this.listComments.push(...data.data);
                    this.nextUrl = data.next_page_url;
                })
            }
        },
        computed:{
            avg_rate(){
                return Math.ceil(this.product.avg_rate*2)/2;
            }
        }
    }
</script>

<style scoped>
    .modal-backdrop {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: center;

    }

    .modal {
        margin-left: 10%;
        width: 80%;
        max-height: 90vh;
        justify-self: center;
        background: #FFFFFF;
        box-shadow: 2px 2px 20px 1px;
        overflow-x: auto;
        display: flex;
        flex-direction: column;
    }

    .modal-header,
    .modal-footer {
        display: flex;
    }

    .modal-header {
        border-bottom: 1px solid #eeeeee;
        color: #4AAE9B;
        justify-content: space-between;
    }

    .modal-footer {
        border-top: 1px solid #eeeeee;
        justify-content: flex-end;
    }

    .modal-body {
        position: relative;
        padding: 20px 10px;
    }

    .btn-close {
        border: none;
        font-size: 20px;
        cursor: pointer;
        font-weight: bold;
        color: #4AAE9B;
        background: transparent;
    }

    .btn-green {
        color: white;
        background: #4AAE9B;
        border: 1px solid #4AAE9B;
        border-radius: 2px;
    }
    .product-image {
        max-width: 100%;
        height: auto;
        width: 100%;
    }
    .product-image-thumbs {
        -ms-flex-align: stretch;
        align-items: stretch;
        display: -ms-flexbox;
        display: flex;
        margin-top: 2rem;
    }
    .product-image-thumb {
        box-shadow: 0 1px 2px rgba(0,0,0,.075);
        border-radius: .25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        display: -ms-flexbox;
        display: flex;
        margin-right: 1rem;
        max-width: 7rem;
        padding: .5rem;
    }
    .product-image-thumb img {
        max-width: 100%;
        height: auto;
        -ms-flex-item-align: center;
        align-self: center;
    }
    .inputQuantity{
        width: 40%;
    }
    .inputQuantity>*{
        float: left;
    }
    .inputQuantity:after{
        display: block;
        clear: both;
        content: "";
    }
</style>
