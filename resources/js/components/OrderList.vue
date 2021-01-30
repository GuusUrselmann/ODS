<template>
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
</template>

<script>
    import carousel from 'vue-owl-carousel';
    export default {
        props: {
            cart: null,
            amounttotal: null,
        },
        data: function() {
            return {
                cartItems: Vue.util.extend({}, this.cart),
                cartAmount: this.amounttotal,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            };
        },
        methods: {
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
