<template>
    <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0 show">
      <div class="dropdown-cart-top-header p-4">
        <h6 class="mb-0">Brood2day</h6>
        <p class="text-secondary mb-0">310 S Front St, Memphis, USA</p>
      </div>
      <div class="dropdown-cart-top-body border-top p-4">
        <p class="mb-2" v-for="cart_item in cartItems">
            {{cart_item.name}} x {{cart_item.quantity}} <span class="float-right text-secondary">€{{cart_item.price.toFixed(2)}}</span>
        </p>
      </div>
      <div class="dropdown-cart-top-footer border-top p-4">
        <p class="mb-0 font-weight-bold text-secondary">Totaal <span class="float-right text-dark">€{{cartAmount.toFixed(2)}}</span></p>
      </div>
      <div class="dropdown-cart-top-footer border-top p-2">
        <a class="btn btn-success btn-block btn-lg" :href="url+'/bestellen'"> Afrekenen<i class="fas fa-shopping-cart"></i></a>
      </div>
    </div>
</template>

<script>
    export default {
        props: {
            cart: null,
            amounttotal: null,
        },
        data: function() {
            return {
                cartItems: Vue.util.extend({}, this.cart),
                cartAmount: this.amounttotal,
            };
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
