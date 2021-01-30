<template>
    <div>
    <slot />
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
