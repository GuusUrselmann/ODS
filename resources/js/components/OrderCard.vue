<template>
    <div class="col-3">
        <div class="card order-card border-secondary">
            <div class="card-header bg-secondary text-white h5 p-2">#{{order.id}}<span class="float-right">{{ order.order_datetime | moment("HH:mm") }}</span></div>
            <div class="card-body p-2 ">
                <div class="order-info text-right mb-3">
                    €{{order.amount}}
                </div>
                <ul class="order-products">
                    <li v-for="order_product in order.order_products">
                        {{order_product.product.name}}
                    </li>
                </ul>
            </div>
            <div class="card-footer bg-light border-secondary p-1">OPTIES</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            order: null,
        },
        computed: {
            url() {
                return url();
            }
        },
    }
</script>
