<template>
    <div>
        <div class="card ">
            <div class="card-header border-0 bg-primary">
                <h3 class="card-title">Products</h3>

            </div>
            <div class="card-body">
                <div class="row ">
                    <div class="col-5">
                        <form class="form-inline ">
                            <div class="input-group ">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" v-model="search_value">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit" @click.prevent="search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-7">
                        <select class="custom-select" style="width: auto;"  v-model="searchOptionIndex">
                            <option value="0" selected> Sort by Name </option>
                            <option value="1"> Sort by Price </option>
                            <option value="2"> Sort by Rating </option>
                        </select>
                        <div class="btn-group">
                            <a class="btn btn-outline-primary" :class="(ascending === 1) ? 'bg-primary':'' " @click.prevent="changeAscending"> Ascending </a>
                            <a class="btn btn-outline-primary" :class="(ascending === -1) ? 'bg-primary':''" @click.prevent="changeAscending"> Descending </a>
                        </div>
                        <button @click.prevent="sort" class="btn btn-primary">Ap dung</button>
                    </div>


                </div>
                <hr>
                <div>
                    <div class="filter-container p-0 row">
                        <product  v-for="product in listProduct" :product="product" class="col-3 mt-3" :key="product.id">
                        </product>
                    </div>
                </div>

                <div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Product from "./Product";
    export default {
        name: "Products",
        components:{
            Product
        },
        created() {
            this.products.forEach(
                product => this.listProduct.push(product)
            )
        },
        props:['products'],
        data(){
            return{
                searchOptionIndex:0,
                ascending:1,
                listProduct:[],
                search_value:null,
            }
        },
        methods:{
            search(){
                this.searchOptionIndex = 0;
                this.ascending = 1;
                if(this.search_value !== null)
                    this.fetch(`/products/search/value=${this.search_value}`);
                else
                    this.fetch('products/all/show');
            },
            changeAscending(){
                this.ascending *= -1;
            },
            sort(){
                var option = '';
                if(this.searchOptionIndex === "0" ){
                    option = 'name';
                }else if(this.searchOptionIndex === "1"){
                    option = 'price_out';
                }else{
                    option = 'avg_rate';
                }
                this.listProduct.sort((a,b)=> {
                    if(a[option] <b[option]){
                        return -this.ascending;
                    }else if(a[option]>b[option]){
                        return this.ascending;
                    }else{
                        return 0;
                    }
                });


            },
            fetch(endpoint){
                this.listProduct = [];
                axios.get(endpoint)
                .then(({data}) =>{
                    data.forEach(
                        product => this.listProduct.push(product)
                    );
                });

            }
        }
    }
</script>

<style scoped>

</style>
