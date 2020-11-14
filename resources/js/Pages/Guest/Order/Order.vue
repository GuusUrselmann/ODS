<template>
    <layout >
        <!-- <div class="container order">
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col-10">
                    <div class="order-form">
                        <div class="order-header mt-4 mb-3 pl-3">
                            <h4>Mijn bestelling</h4>
                        </div>
                        <div class="order-cart">
                            <div class="cart-item border-bottom border-dark row" v-for="cart_item in cartItems">
                                <div class="col-7 item p-2">
                                    <div class="item-image background-cover rounded" :style="{'background-image' : 'url(\''+cart_item.attributes.image+'\')'}"></div>
                                    <div class="item-info p-2 pl-4">
                                        <h5>{{cart_item.name}}</h5>
                                        <p>{{cart_item.description}}</p>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="item-qty">
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
                                    <div class="item-price pl-4">
                                        €{{cart_item.price.toFixed(2)}}
                                    </div>
                                </div>
                            </div>
                            <div class="cart-checkout row">
                                <div class="col-7">
                                </div>
                                <div class="col-5">
                                    <h6 class="font-weight-bold mb-2">Totaal : <span class="text-danger">€{{cartAmount.toFixed(2)}}</span></h6>
                                    <form action="" method="post">
                                        <input type="hidden" name="_token" :value="csrf">
                                        <button class="btn btn-md btn-success">Bestelling plaatsen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                </div>
            </div>
        </div> -->
        <form @submit.prevent="submitOrderForm" ref="orderForm" method="post">
            <section class="offer-dedicated-body mt-4 mb-4 pt-2 pb-2">
             <div class="container">
                <div class="row">
                   <div class="col-md-8">
                      <div class="offer-dedicated-body-left">
                         <!-- <div class="bg-white rounded shadow-sm p-4 mb-4">
                            <h6 class="mb-3">You may also like</h6>
                         </div>
    					 <div class="pt-2"></div> -->
    					 <div class="bg-white rounded shadow-sm p-4 mb-4">
                            <h4 class="mb-4">Bezorg adres</h4>
                            <!-- <div class="row">
                               <div class="col-md-6">
                                  <div class="bg-white card addresses-item mb-4 border border-success">
                                     <div class="gold-members p-4">
                                        <div class="media">
                                           <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                           <div class="media-body">
                                              <h6 class="mb-1 text-black">Home</h6>
                                              <p class="text-black">291/d/1, 291, Jawaddi Kalan, Ludhiana, Punjab 141002, India
                                              </p>
                                              <p class="mb-0 text-black font-weight-bold"><a class="btn btn-sm btn-success mr-2" href="#"> DELIVER HERE</a>
                                                 <span>30MIN</span>
                                              </p>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class="col-md-6">
                                  <div class="bg-white card addresses-item mb-4">
                                     <div class="gold-members p-4">
                                        <div class="media">
                                           <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i></div>
                                           <div class="media-body">
                                              <h6 class="mb-1 text-secondary">Work</h6>
                                              <p>NCC, Model Town Rd Town, Ludhiana, Punjab 141002, India
                                              </p>
                                              <p class="mb-0 text-black font-weight-bold"><a class="btn btn-sm btn-secondary mr-2" href="#"> DELIVER HERE</a>
                                                 <span>40MIN</span>
                                              </p>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            <div class="row">
                               <div class="col-md-6">
                                  <div class="bg-white card addresses-item">
                                     <div class="gold-members p-4">
                                        <div class="media">
                                           <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                           <div class="media-body">
                                              <h6 class="mb-1 text-secondary">Other</h6>
                                              <p>Delhi Bypass Rd, Jawaddi Taksal, Ludhiana, Punjab 141002, India
                                              </p>
                                              <p class="mb-0 text-black font-weight-bold"><a class="btn btn-sm btn-secondary mr-2" href="#"> DELIVER HERE</a>
                                                 <span>45MIN</span>
                                              </p>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class="col-md-6">
                                  <div class="bg-white card addresses-item">
                                     <div class="gold-members p-4">
                                        <div class="media">
                                           <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                           <div class="media-body">
                                              <h6 class="mb-1 text-secondary">Other</h6>
                                              <p>Pritm Nagar, Model Town, Ludhiana, Punjab 141002, India
                                              </p>
                                              <p class="mb-0 text-black font-weight-bold"><a data-toggle="modal" data-target="#add-address-modal" class="btn btn-sm btn-primary mr-2" href="#"> ADD NEW ADDRESS</a>
                                              </p>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div> -->
                            <div class="form-row">
                               <div class="form-group col-md-6">
                                   <label for="order_address">Straat</label>
                                   <div class="input-group">
                                       <input class="form-control" v-model="formOrder.streetName" name="streetname">
                                   </div>
                               </div>
                               <div class="form-group col-md-2">
                                   <label for="order_house_number">Huisnr.</label>
                                   <div class="input-group">
                                       <input class="form-control" v-model="formOrder.houseNumber" name="housenumber">
                                   </div>
                               </div>
                            </div>
                            <div class="form-row">
                               <div class="form-group col-md-4">
                                   <label for="order_zipcode">Postcode</label>
                                   <div class="input-group">
                                       <input class="form-control" v-model="formOrder.zipcode" name="zipcode">
                                   </div>
                               </div>
                               <div class="form-group col-md-4">
                                   <label for="order_city">Plaats</label>
                                   <div class="input-group">
                                       <input class="form-control" v-model="formOrder.city" name="city">
                                   </div>
                               </div>
                            </div>
                         </div>
    					 <div class="pt-2"></div>
                         <div class="bg-white rounded shadow-sm p-4 mb-4">
                            <h4 class="mb-4">Heeft U een CouponCode?</h4>
                            <div class="form-row">
                               <div class="form-group col-md-8">
                                   <label for="order_zipcode">Code:</label>
                                   <div class="input-group">
                                       <input id="couponcode" class="form-control" name="couponcode"><button type="button" class="btn btn-success btn-md ml-3" v-on:click="addCoupon()">indienen</button>
                                   </div>
                               </div>
                            </div>
                         </div>
                         <div class="pt-2"></div>
                         <div class="bg-white rounded shadow-sm p-4 osahan-payment">
                            <h4 class="mb-4">Kies Uw betaalmethode</h4>
                            <div class="row">
                               <div class="col-sm-4 pr-0">
                                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                     <a class="nav-link active" id="v-pills-ideal-tab" data-toggle="pill" href="#v-pills-ideal" role="tab" aria-controls="v-pills-ideal" aria-selected="true" @click="setPaymentMethod('iDEAL')"><i class="icofont-credit-card"></i> iDEAL</a>
                                     <a class="nav-link" id="v-pills-cash-tab" data-toggle="pill" href="#v-pills-cash" role="tab" aria-controls="v-pills-cash" aria-selected="false" @click="setPaymentMethod('cash')"><i class="icofont-credit-card"></i> Contant</a>
                                     <!-- <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="icofont-card"></i> Credit</a>
                                     <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="icofont-bank-alt"></i> Netbanking</a>
                                     <a class="nav-link" id="v-pills-cash-tab" data-toggle="pill" href="#v-pills-cash" role="tab" aria-controls="v-pills-cash" aria-selected="false"><i class="icofont-money"></i> Pay on Delivery</a> -->
                                  </div>
                               </div>
                               <div class="col-sm-8 pl-0">
                                  <div class="tab-content h-100" id="v-pills-tabContent">
                                     <div class="tab-pane fade show active" id="v-pills-ideal" role="tabpanel" aria-labelledby="v-pills-ideal-tab">
                                        <h6 class="mb-3 mt-0 mb-3">iDEAL</h6>
                                       <div class="form-row">
                                          <div class="form-group col-md-12 mb-0">
                                             <button class="btn btn-success btn-block btn-lg">BESTELLING PLAATSEN</button>
                                          </div>
                                       </div>
                                     </div>

                                     <div class="tab-pane fade" id="v-pills-cash" role="tabpanel" aria-labelledby="v-pills-cash-tab">
                                         <h6 class="mb-3 mt-0 mb-3">Contant</h6>
                                         <p>Probeer A.U.B. gepast te kunnen betalen</p>
                                         <hr>
                                         <button class="btn btn-success btn-block btn-lg">BESTELLING PLAATSEN</button>
                                    </div>

                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="generator-bg rounded-sm shadow-sm mb-4 p-4 ml-0 osahan-cart-item">
                         <div class="d-flex mb-4 osahan-cart-item-profile">
                            <img class="img-fluid mr-3 rounded-pill" src="images/site/logo-small.png">
                            <div class="d-flex flex-column">
                               <h6 class="mb-1 text-white">{{$page.branch.name}}
                               </h6>
                               <p class="mb-0 text-white"><i class="icofont-location-pin"></i>{{$page.branch.contact_information.street_name}} {{$page.branch.contact_information.house_number}}, {{$page.branch.contact_information.city}}</p>
                            </div>
                         </div>
                         <div class="bg-white rounded-sm shadow-sm mb-2">
                            <div class="gold-members p-2" v-for="cart_item in cart">
                               <p class="text-gray mb-0 float-right ml-2">€{{cart_item.price.toFixed(2)}}</p>
                               <span class="count-number float-right">
                               <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                               <input class="count-number-input" type="text" value="1" readonly="">
                               <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                               </span>
                               <div class="media">
                                  <div class="media-body">
                                     <p class="mt-1 mb-0 text-black">{{cart_item.name}}</p>
                                  </div>
                               </div>
                               <div class="col-12 p-0" v-for="extra_option in cart_item.attributes.extra_options">
                                   <div class="col-12 p-0">
                                       <div class="col-10 offset-2 p-0 d-inline-block" v-for="(extra_option_name, i) in extra_option.name.split(',')"><b v-if="i == 0">-{{extra_option.option}}:</b><span class="float-right pr-2">{{extra_option_name}}</span></div>
                                   </div>
                               </div>
                            </div>
                         </div>
                         <!-- <div class="mb-2 bg-white rounded p-2 clearfix">
                            <div class="input-group input-group-sm mb-2">
                               <input type="text" class="form-control" placeholder="Enter promo code">
                               <div class="input-group-append">
                                  <button class="btn btn-primary" type="button" id="button-addon2"><i class="icofont-sale-discount"></i> APPLY</button>
                               </div>
                            </div>
                            <div class="input-group mb-0">
                               <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="icofont-comment"></i></span>
                               </div>
                               <textarea class="form-control" placeholder="Any suggestions? We will pass it on..." aria-label="With textarea"></textarea>
                            </div>
                         </div> -->
                         <div class="mb-2 bg-white rounded-sm p-2 clearfix">
                            <!-- <p class="mb-1">Item Total <span class="float-right text-dark">$3140</span></p>
                            <p class="mb-1">Restaurant Charges <span class="float-right text-dark">$62.8</span></p>
                            <p class="mb-1">Delivery Fee <span class="text-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Total discount breakup">
                               <i class="icofont-info-circle"></i>
                               </span> <span class="float-right text-dark">$10</span>
                            </p>
                            <p class="mb-1 text-success">Total Discount
                               <span class="float-right text-success">$1884</span>
                            </p> -->
                            <!-- <hr> -->
                            <div v-for="condition in conditions" class="condition row">
                                <div class="col-6 offset-6 d-inline-block">
                                    <h6 class="float-left"><b>{{condition.name}}</b></h6>
                                    <div class="text-right"><b>{{condition.value}}</b></div>
                                </div>
                            </div>
                            <h6 class="font-weight-bold mb-0">TE BETALEN  <span class="float-right">€{{amount.toFixed(2)}}</span></h6>
                         </div>
                         <input id="input_payment_method" type="hidden" name="payment_method" value="iDEAL">
                         <input type="hidden" name="_token" :value="csrf">
                         <!-- <button class="btn btn-success btn-block btn-lg">BETALEN</button> -->
                         <!-- <a href="thanks.html" class="btn btn-success btn-block btn-lg">BETALEN<i class="icofont-long-arrow-right"></i></a> -->
                      </div>
    				  <!-- <div class="pt-2"></div>
                      <div class="alert alert-success" role="alert">
                         You have saved <strong>$1,884</strong> on the bill
                      </div> -->
    				  <div class="pt-2"></div>
    				  <div class="text-center pt-2">
    				  </div>
                   </div>
                </div>
             </div>
          </section>
      </form>
    </layout>
</template>

<script>
    import Layout from '../../Layouts/Guest/Layout';
    import Select2 from 'v-select2-component';
    export default {
        components: {
            Layout,
            Select2,
        },
        data: function() {
            return {
                cartItems: Vue.util.extend({}, this.cart),
                cartAmount: this.amount,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                formOrder: {
                    streetName: null,
                    houseNumber: null,
                    zipcode: null,
                    city: null,
                },
            };
        },
        methods: {
            addCoupon() {
                var coupon_input = $('#couponcode')[0].value;
                if(coupon_input) {

                    axios.post(url()+'/api/addCouponcode', {
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        code: coupon_input,
                    })
                    .then(response => {
                        console.log(response.data)
                        this.cartItems = response.data.cart;
                        this.cartAmount = response.data.amount;
                    })
                    .catch(error => {
                        console.log(error);
                   });
                }
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
            submitOrderForm() {
                this.$refs.orderForm.submit()
            },
            setPaymentMethod(method) {
                $('#input_payment_method').val(method)
            }
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
                return Object.keys(this.cartItems).length == 0 ? true : false;
            },
        },
    }
</script>
