<template>
    <div class="row">
        <div class="col-9">
            <div class="menu-carousel rounded shadow-sm">
                <carousel :dots="false" :items="4" :nav="false">
                    <div class="menu-category p-3 text-center" v-for="menu_category in menu"><a class="text-primary h5" :href="'#'+menu_category.category.slug">{{menu_category.category.name}}</a></div>
                </carousel>
            </div>
            <div class="menu-products">
                <div class="product-category row" v-for="menu_category in menu">
                    <h5 :id="menu_category.category.slug" class="category col-12">
                        {{menu_category.category.name}}
                    </h5>
                    <div class="category-products row col-12">
                        <div class="product col-4 p-3" v-for="menu_product in menu_category.menu_products">
                            <div class="list-card bg-white rounded overflow-hidden position-relative shadow-sm p-3">
                                <div class="product-image background-cover rounded-circle" :style="{'background-image' : 'url(\''+menu_product.product.image_path+'\')'}"></div>
                                <div class="product-body">
                                    <h6>{{menu_product.product.name}}</h6>
                                    <p class="text-secondary mb-0">{{menu_product.product.description}}</p>
                                    <div class="btn btn-outline-secondary btn-sm float-right" v-on:click="addProduct(menu_product.product.id)">ADD</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="cart rounded shadow-sm col-10">
                <div class="cart-header p-3">
                    <h5>Uw bestelling</h5>
                    <h6 v-if="Object.keys(cartItems).length > 0">{{Object.keys(cartItems).length}} items</h6>
                </div>
                <div class="cart-products bg-white rounded shadow-sm mb-2">
                    <div class="cart-product p-2 border-bottom row" v-for="cart_item in cartItems">
                        <div class="col-5 cart-product-name p-0">{{cart_item.name}}</div>
                        <div class="col-4 cart-product-qty p-0">
                            <div class="qty-remove d-inline-block border border-secondary text-center" v-on:click="updateProductQuantity(cart_item.id, -1)">
                                <span>-</span>
                            </div>
                            <div class="qty-amount d-inline-block text-center bg-secondary text-white">
                                {{cart_item.quantity}}
                            </div>
                            <div class="qty-add d-inline-block border border-secondary text-center" v-on:click="updateProductQuantity(cart_item.id, 1)">
                                <span>+</span>
                            </div>
                        </div>
                        <div class="col-3 cart-product-price p-0 text-right pr-2">€{{cart_item.price.toFixed(2)}}</div>
                        <div class="cart-product-remove bg-danger rounded shadow-sm text-center text-white" v-on:click="removeProduct(cart_item.id)"><i class="fas fa-times"></i></div>
                    </div>
                </div>
                <div class="cart-empty" v-if="cartEmpty">
                    Uw winkelwagen is leeg.
                </div>
                <div class="cart-amount bg-white" v-if="!cartEmpty">
                    <div class="mb-2 rounded p-2 clearfix">
                        <img class="img-fluid float-left" src="images/site/wallet-icon.png">
                        <h6 class="font-weight-bold text-right mb-2">Totaal : <span class="text-danger">€{{cartAmount.toFixed(2)}}</span></h6>
                    </div>
                    <div class="cart-order p-2">
                        <a :href="url+'/bestellen'" class="btn btn-success btn-block btn-lg">Afrekenen <i class="fas fa-shopping-cart"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import carousel from 'vue-owl-carousel';
    export default {
        props: {
            menu: null,
            cart: null,
            amounttotal: null,
        },
        data: function() {
            return {
                cartItems: Vue.util.extend({}, this.cart),
                cartAmount: this.amounttotal,
            };
        },
        components: { carousel },
        methods: {
            addProduct(productId) {
                axios.post(url()+'/api/addproducttocart', {
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    product_id: productId,
                })
                .then(response => {
                    this.cartItems = response.data.cart;
                    this.cartAmount = response.data.amount;
                })
                .catch(error => {
                    console.log(error);
               });
           },
           removeProduct(rowId) {
               axios.post(url()+'/api/removeproductfromcart', {
                   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                   row_id: rowId,
               })
               .then(response => {
                   this.cartItems = response.data.cart;
                   this.cartAmount = response.data.amount;
               })
               .catch(error => {
                   console.log(error);
              });
            },
            updateProductQuantity(rowId, amount) {
                axios.post(url()+'/api/updateproductquantityincart', {
                  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                  row_id: rowId,
                  quantity: amount,
                })
                .then(response => {
                  this.cartItems = response.data.cart;
                  this.cartAmount = response.data.amount;
                })
                .catch(error => {
                  console.log(error);
                });
            },
        },
        computed: {
            cartEmpty() {
                return Object.keys(this.cartItems).length == 0 ? true : false;
            },
            url() {
                return url();
            }
        },
    }
</script>
