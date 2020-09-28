<template>
    <div class="content  pt-3">
            <div class="col-lg-12 ">
                <button class=" btn btn-default cs-btn" @click="sendData()" :disabled="isDisable('Submit')">CheckOut</button>
                <span class="bg-danger float-right" v-if="errorMessage">{{errorMessage}}</span>
                    <div class="mt-3">
                      <label class="w-25" >Choose Customer</label>
                      <select v-model="customer_id" class="form-control-sm show-menu-arrow  bd-bottom-mount bg-white col-md-2" @change="selectCustomer()">
                         <option selected disabled value="">Choose Customer</option>
                             <option  :value="cs.id" v-for="cs in data">{{cs.name}}</option>
                       </select>
                       </div>
            </div>
            <div class="left-div col-lg-5 bg-light  float-left mt-5 ">
                <div class="">
                    <label class="w-25"> Name</label>
                    <input type="text"  autocomplete="off" name="name"  v-model="search" @input="getProductName" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-6"  @focus="modal=true">
                </div>
                <div class="panel-footer col-md-8" v-if="results.length && modal">
                    <ul class="list-group"  >
                        <li class="list-group-item" v-for="result in results" @click="selectProduct(result.id,result.name,result.price,result.remain_qty)">{{ result.name }}</li>
                    </ul>
                </div>
                <span class="text-danger" id="name_error">
                                </span>

                <div class="mb-3 mt-3">
                    <label class="w-25">Qty</label>
                <input type="number" v-model="qty"  min="0" name="qty" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-6" @input="checkQty()" :disabled="isDisable('Qty')">
                </div>
                <span class="text-danger" id="qty_error">
                                </span>


                <div class="m-button pt-3 ">
                    <button   class="btn btn-nb-mount2 fontsize-mount22 px-3 col-md-4   cs-btn"  @click="addProduct()" :disabled="isDisable('AddToCart')">Add To Cart</button>
                </div>

            </div>
            <div class="col-lg-6 bg-light h-75 float-right mt-5">
                <p ><b>Total:</b>
                    <i v-if="total">
                        {{total}}

                    </i>
                    <i v-else="total">
                        0
                    </i>
                    <span v-if="avl_msg" class="bg-success float-right pl-5">{{this.old_qty}}{{this.avl_msg}}</span>
                </p>
<!--                <p v-else="total"><b>Total:</b>0</p>-->
                <div class="container" >
                    <table class="table table-hover">
                        <thead class="thead-light">
<!--                        <tr ><p style="background-color: gray">Cart</p></tr>-->
                        <tr>
                            <th >Name</th>
                            <th class="text-center">Qty</th>
                            <th>Price</th>
                            <th>Available</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr  v-for="(p,index) in product_list" >
                            <td>
                                <strong>{{p.name}}</strong>
                            </td>
                            <td>
                                <div class="input-group mb-3 input-group-sm">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-danger" v-on:click="qtyUpdate(product_list,index,'decrease')">
                                            <span class="fa fa-minus" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" v-model="p.qty" @input="qtyUpdate(product_list,index,'custom_qty')" style="width:5px">
                                    <div class="input-group-append">
                                        <button class="btn btn-success"  v-on:click="qtyUpdate(product_list,index,'increase')" >
                                            <span class="fa fa-plus" aria-hidden="true"></span>

                                        </button>
                                    </div>
                                </div>

                            </td>
                            <td>{{p.price}}</td>
                            <td class="text-center text-success">{{p.available}}</td>
                            <td class="text-center">
                                <button v-on:click="deleteProduct(product_list,index)" class="btn btn-danger btn-sm">
                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


            </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        // mounted() {
        //     console.log('Component mounted.')
        // }
        props: ['customers'],

        data:function () {
            return{
                search:'',
                data:JSON.parse(this.customers),
                product_id:'',
                results:[],
                old_qty:'',
                qty:'',
                price:'',
                modal:false,
                product_list:[],
                total:'',
                errorMessage:'',
                qty_error:true,
                submit_error:true,
                add_cart_error:true,
                qty_available:false,
                avl_msg:'',
                custom_qty:'',
                customer_id:'',
            }
        },
        mounted() {
            // console.log(this.item_list);
            // if(this.item_list.length<=0){
            //     console.log('error');
            // }
        },
        methods:{
            getProductName(){
                this.results=[];
                this.avl_msg='';
                if(this.search.length>0){
                    axios.get('/sale_invoice/get_product_name',{
                        params:{
                            search:this.search
                        }
                    }).then(response=>{
                        // console.log(response.data);
                        if(response.data.is_success==true){
                            this.results=response.data.products;
                            this.errorMessage='';
                        }else{
                            this.errorMessage='Somethings Wrong';
                        }
                    })
                }
            },
            selectProduct($id,product_name,price,old){
                this.modal=false;
                this.search=product_name;
                this.product_id=$id;
                this.price=price;
                this.old_qty=old;
                this.qty_error=false;
                                console.log(this);

            },
            addProduct(){
                this.avl_msg='';
                this.submit_error=false;
                this.qty_error=true;
                this.add_cart_error=true;
                    this.product_list.push({
                        id:this.product_id,
                        name:this.search,
                        qty:this.qty,
                        price:this.price,
                        available:this.old_qty,
                    });
                this.getTotal(this.product_list);
                this.custom_qty=this.qty;

                this.modal=false;
                    this.search='';
                    this.qty='';
            },
            deleteProduct(products,index){
                products.splice(index,1);
                this.getTotal(products);
                if(products.length<=0){
                    this.submit_error=true;
                    this.add_cart_error=true;
                    this.qty_error=true;
                }
            },
            // selectCustomer(){
            // console.log(this.customer_id);
            //
            // },
            getTotal(products){
                var total=0;
                $.each(products,function(key,value){
                    total+=parseInt(value.qty,10) * value.price;
                });
                this.total=total;
            },
            sendData(){
                var products=this.product_list;
                var total=this.total;
                var customer_id=this.customer_id;
                if(this.customer_id!=""){
                 axios.post('/sale_invoice/create', {
                                        products:products,
                                    total:total,
                                    customer_id:customer_id,
                                }).then(response=>{
                                    if(response.data.is_success==true){
                                        window.location.replace('/sale_invoice/sale_record');
                                    }else{
                                      this.isDisable("Submit");
                                      this.errorMessage='Something ddd';
                                    }
                                });
                }else{
                 this.errorMessage='Please choose customer';
                }

            },
            // selectCustomer(){
            //
            // },
            checkQty(){
                var old=parseInt(this.old_qty);
                if(old<this.qty ){
                    this.errorMessage='Not Enough Quantity ';
                    this.add_cart_error=true;
                }else if(this.qty==0 || this.qty<1){
                    this.errorMessage='Quantity is not availiable ';
                    this.add_cart_error=true;
                }else
                    {
                    this.errorMessage='';
                    this.add_cart_error=false;
                }
            },
            qtyUpdate(products,index,type){
                if(type=='increase'){
                    vm=this;
                    $.each(products,function (key,value) {
                        if(key==index){

                            value.qty=parseInt(value.qty,10)+1;
                            vm.total=vm.total+ value.price;

                            if(value.qty>=vm.old_qty){
                                vm.submit_error=true;
                                vm.errorMessage="You can't checkout because of exceed quantity of available."
                            }
                        }

                    });
                }else if(type=='decrease'){

                    var vm=this
                    $.each(products,function (key,value) {
                        if(key==index){
                            value.qty=parseInt(value.qty,10)-1;
                            vm.total=vm.total- value.price;
                                vm.submit_error=false;
                            vm.errorMessage='';
                            if(value.qty<=0){
                                vm.deleteProduct(products,index);
                            }
                        }

                    });
                }else if(type=='custom_qty') {
                    var vm = this;
                    $.each(products, function (key, value) {
                        if (key == index) {
                            if(value.qty>=vm.old_qty){
                                vm.submit_error=true;
                                vm.errorMessage="You can't checkout because of exceed quantity of available."
                            }else if(value.qty<=0){
                                vm.deleteProduct(products,index);
                            }
                            vm.total=parseInt(value.qty,10)* value.price;

                        }
                    });
                }

            },
            isDisable(text){
                if(text=='Submit'){
                    return this.submit_error==true;
                }else if(text=='Qty'){
                    return this.qty_error==true;

                }else if(text=='AddToCart'){
                    return this.add_cart_error==true;

                }
            },

        },

    }
</script>
