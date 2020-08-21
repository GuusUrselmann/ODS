<template>
    <div class="container-fluid orderwindow p-0">
        <nav class="orderwindow-header navbar navbar-expand-lg sticky-top navbar-light bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand float-left text-white" :href="url+'/admin/dashboard'">
                    <h5><i class="fas fa-arrow-left"></i> Terug</h5>
                </a>
            </div>
        </nav>
        <div class="orderwindow-body">
            <div class="orders row p-2 m-0">
                <OrderCard :order="order" :key="order.id" v-for="order in orders" />
            </div>
        </div>
    </div>
</template>

<script>
    import OrderCard from './OrderCard';
    export default {
        components: {
            OrderCard,
        },
        props: {
            orderlist: null,
        },
        data: function() {
            return {
                orders: Vue.util.extend({}, this.orderlist),
            };
        },
        methods: {
            updateOrderList() {
                axios.post(url()+'/api/orderlist', {
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                })
                .then(response => {
                    this.orders = response.data.orders;
                })
                .catch(error => {
                    console.log(error);
               });
            }
        },
        mounted: function () {
            this.$nextTick(function () {
                window.setInterval(() => {
                    this.updateOrderList();
                },3000);
            })
        },
        computed: {
            url() {
                return url();
            }
        },
    }
</script>
