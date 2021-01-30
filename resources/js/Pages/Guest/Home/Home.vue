<template>
    <layout >
        <div class="container-fluid banner background-cover p-0" :style="{backgroundImage: 'url('+$page.paths.asset+$page.options.home_background+')'}">
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
                            <template slot="prev"><div class="prev"><i class="fas fa-arrow-left"></i></div></template>
                            <div class="menu-category p-3 text-center" v-for="menu_category in menu"><a class="text-primary h5" :href="'#'+menu_category.category.slug">{{menu_category.category.name}}</a></div>
                            <template slot="next"><div class="next"><i class="fas fa-arrow-right"></i></div></template>
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
                                            <div class="btn btn-outline-secondary btn-sm float-right" v-on:click="addProduct(menu_product.product)">ADD</div>
                                        </div>
                                        <span class="badge rounded product-price badge-info p-1 pl-2 pr-2"><span class="font-weight-bold text-white" style="font-size: 13px">€</span> <span class="h6 font-weight-bold text-white">{{menu_product.product.price}}</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-0  col-xl-3 d-none d-xl-block">
                    <div class="cart sticky-top rounded shadow-sm col-10">
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
                                <div class="col-3 cart-product-price p-0 text-right pr-2"><b>€{{cart_item.price.toFixed(2)}}</b></div>
                                <div class="cart-product-remove bg-danger rounded shadow-sm text-center text-white" v-on:click="removeProduct(cart_item.id)"><i class="fas fa-times"></i></div>
                                <div class="col-12 p-0" v-for="extra_option in cart_item.attributes.extra_options">
                                    <div class="col-12 p-0">
                                        <div class="col-10 offset-2 p-0" v-for="(extra_option_name, i) in extra_option.name.split(',')"><b v-if="i == 0">-{{extra_option.option}}:</b><span class="float-right pr-2">{{extra_option_name}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cart-empty" v-if="cartEmpty">
                            Uw winkelwagen is leeg.
                        </div>
                        <div class="cart-amount bg-white" v-if="!cartEmpty">
                            <div class="mb-2 rounded p-2 clearfix">
                                <div v-for="condition in conditions" class="condition row">
                                    <div class="col-6 offset-6 p-0">
                                        <h6 class="float-left"><b>{{condition.name}}</b></h6>
                                        <div class="text-right"><b>{{condition.value}}</b></div>
                                    </div>
                                </div>
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

        <div class="modal modal-product-options" tabindex="-1" role="dialog" id="productExtraOptionsModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Kies uw type extra opties
                    </div>
                    <div class="modal-body">
                        <div class="extra-options" v-if="modalExtraOptions">
                            <div class="form-row" v-for="(extra_option, index) in modalExtraOptions.standard_extras.concat(modalExtraOptions.extra_options)">
                                <div class="form-group col-6" v-if="extra_option.standard_extra_id">
                                    <label><b>{{extra_option.standard_extra.name}}</b></label>
                                    <Select2 class="extra-option standard-extra" :data-id="extra_option.standard_extra.id" v-if="extra_option.standard_extra.type == 'dropdown'" :options="extra_option.standard_extra.options.map(function(option) {return {id: option.id, text: option.name+' (+ €'+option.extra_amount+')'}})" :settings="{ minimumResultsForSearch: 99}" />
                                    <div class="options extra-option standard-extra" :data-id="extra_option.id" v-if="extra_option.standard_extra.type == 'multiple'">
                                        <div class="form-check" v-for="option in extra_option.standard_extra.options">
                                            <input class="form-check-input" type="checkbox" name="extra_options" :value="option.id">
                                            <label class="form-check-label">{{option.name}} (+ €{{option.extra_amount}})</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6" v-if="extra_option.type">
                                    <label><b>{{extra_option.name}}</b></label>
                                    <Select2 class="extra-option" :data-id="extra_option.id" v-if="extra_option.type == 'dropdown'" :options="extra_option.options.map(function(option) {return {id: option.id, text: option.name+' (+ €'+option.extra_amount+')'}})" :settings="{ minimumResultsForSearch: 99}" />
                                    <div class="options extra-option" :data-id="extra_option.id" v-if="extra_option.type == 'multiple'">
                                        <div class="form-check" v-for="option in extra_option.options">
                                            <input class="form-check-input" type="checkbox" name="extra_options" :value="option.id">
                                            <label class="form-check-label">{{option.name}} (+ €{{option.extra_amount}})</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button v-on:click="addProductWithOptions()" class="btn btn-sm btn-success mt-3 mb-2 float-right">Aan winkelwagen toevoegen</button>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
    import ProductsMenu from '../../../components/ProductsMenu';
    import Carousel from 'vue-owl-carousel';
    import Layout from '../../Layouts/Guest/Layout';
    import Select2 from 'v-select2-component';
    export default {
        components: {
            Layout,
            Carousel,
            Select2,
        },
        props: {
            menu: null,
        },
        data: function () {
            return {
                modalExtraOptions: null,
            }
        },
        methods: {
            addProduct(product) {
                if(product.extra_options.concat(product.standard_extras).length) {
                    //launch extra options modal before adding to cart
                    $("#productExtraOptionsModal").modal('toggle');
                    this.modalExtraOptions = product;
                }
                else {
                    //No extra options, just add to cart
                    axios.post(url()+'/api/addproducttocart', {
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        product_id: product.id,
                    })
                    .then(response => {
                        this.$store.commit('updateCart', response.data.cart)
                        this.$store.commit('updateAmount', response.data.amount)
                    })
                    .catch(error => {
                        console.log(error);
                   });
                }
           },
           addProductWithOptions() {
               $("#productExtraOptionsModal").modal('toggle');
               var selected_options = [];
               $('.modal-product-options .extra-option').each(function(i, v) {
                  if($(v).find('select')[0]) {
                      //type is dropdown
                      if($(v).find('select')[0].value != '') {
                          if($(v).hasClass('standard-extra')) {
                              //standard extra
                              //value = standard_extras table id
                              selected_options.push({
                                  'type': 'standard_extra',
                                  'id': $(v).data("id"),
                                  'value': $(v).find('select')[0].value,
                              });
                          }
                          else {
                              //extra option
                              //value = extra_options table id
                              selected_options.push({
                                  'type': 'extra_option',
                                  'id': $(v).data("id"),
                                  'value': $(v).find('select')[0].value,
                              });
                          }
                      }
                  }
                  else {
                      //type is multiple
                      if($(v).find("input[name='extra_options']:checked").length != 0) {
                          if($(v).hasClass('standard-extra')) {
                              //standard extra
                              var optionsSelected = [];
                              $.each($(v).find("input[name='extra_options']:checked"), function(){
                                  optionsSelected.push($(this).val());
                              });
                              selected_options.push({
                                  'type': 'standard_extra',
                                  'id': $(v).data("id"),
                                  'value': optionsSelected,
                              });
                          }
                          else {
                              //extra option
                              var optionsSelected = [];
                              $.each($(v).find("input[name='extra_options']:checked"), function(){
                                  optionsSelected.push($(this).val());
                              });
                              selected_options.push({
                                  'type': 'extra_option',
                                  'id': $(v).data("id"),
                                  'value': optionsSelected,
                              });
                          }
                      }
                  }
               });
               axios.post(url()+'/api/addproducttocart', {
                   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                   product_id: this.modalExtraOptions.id,
                   extra_options: selected_options,
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
            conditions() {
                return this.$store.getters.getConditions
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
