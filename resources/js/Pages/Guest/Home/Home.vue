<template>
    <layout >
        <div class="container-fluid banner background-cover p-0" :style="{backgroundImage: 'url('+$page.paths.asset+'images/site/banner-home.jpg)'}">
            <div class="row position-relative">
                <div class="col-12 banner-info">
                    <div class="info-name text-white">
                        Brood2day
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid productsmenu">
            <div class="row">
                <div class="col-12 col-xl-9">
                    <div class="menu-carousel rounded shadow-sm mb-5 sticky-top">
                        <Carousel :dots="false" :items="4" :nav="false" :touchDrag="true" :responsive="{0:{items:2},768:{items:3},1200:{items:4}}">
                            <div class="menu-category p-3 text-center" v-for="menu_category in menu"><a class="text-primary h5" :href="'#'+menu_category.category.slug">{{menu_category.category.name}}</a></div>
                        </Carousel>
                    </div>
                    <div class="menu-products">
                        <div class="product-category row" v-for="menu_category in menu">
                            <h4 :id="menu_category.category.slug" class="category col-12">
                                {{menu_category.category.name}}
                            </h4>
                            <div class="category-products row col-12">
                                <div class="product col-xl-4 col-md-6 p-3" v-for="menu_product in menu_category.menu_products">
                                    <div class="list-card bg-white rounded overflow-hidden position-relative shadow-sm p-3">
                                        <div class="product-image background-cover rounded-circle" :style="{backgroundImage: 'url('+$page.paths.asset+menu_product.product.image_path+')'}"></div>
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
                <div class="col-0  col-xl-3 d-none d-xl-block">
                    <div class="cart rounded shadow-sm col-10">
                        <div class="cart-header p-3">
                            <h5>Uw bestelling</h5>
                            <h6 v-if="!cartEmpty">{{Object.keys(cart).length}} items</h6>
                        </div>
                        <div class="cart-products bg-white rounded shadow-sm mb-2">
                            <div class="cart-product p-2 border-bottom row" v-for="cart_item in cart">
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
                                <h6 class="font-weight-bold text-right mb-2">Totaal : <span class="text-danger">€{{amount.toFixed(2)}}</span></h6>
                            </div>
                            <div class="cart-order p-2">
                                <inertia-link :href="$page.paths.url+'/bestellen'" class="btn btn-success btn-block btn-lg">Afrekenen <i class="fas fa-shopping-cart"></i></inertia-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-block d-xl-none fixed-bottom">
            <div class="row">
                <div class="col-12">
                    <inertia-link :href="$page.paths.url+'/bestellen'" class="btn btn-success btn-block btn-lg">Afrekenen <i class="fas fa-shopping-cart"></i></inertia-link>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
    import ProductsMenu from '../../../components/ProductsMenu';
    import Carousel from 'vue-owl-carousel';
    import Layout from '../../Layouts/Guest/Layout';
    export default {
        components: {
            Layout,
            Carousel,
        },
        props: {
            menu: null,
        },
        methods: {
            addProduct(productId) {
                axios.post(url()+'/api/addproducttocart', {
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    product_id: productId,
                })
                .then(response => {
                    this.$store.commit('updateCart', response.data.cart)
                    this.$store.commit('updateAmount', response.data.amount)
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
                   this.$store.commit('updateCart', response.data.cart)
                   this.$store.commit('updateAmount', response.data.amount)
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
                  this.$store.commit('updateCart', response.data.cart)
                  this.$store.commit('updateAmount', response.data.amount)
                })
                .catch(error => {
                  console.log(error);
                });
            },
        },
        computed: {
            cart() {
                return this.$store.getters.getCart
            },
            amount() {
                return this.$store.getters.getAmount
            },
            cartEmpty() {
                return Object.keys(this.$store.state.cart).length == 0 ? true : false;
            },
        },
    }
</script>
