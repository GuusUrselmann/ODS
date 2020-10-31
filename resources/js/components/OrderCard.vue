<template>
    <div class="col-3">
        <div class="card order-card border-secondary rounded-0">
            <div class="card-header rounded-0 bg-secondary text-white h5 p-1">#{{order.id}}<span class="float-right">{{ order.order_datetime | moment("HH:mm") }}</span></div>
            <div class="card-body p-2 ">

                <div class="order-contact h6">
                    <span class="h5">Adres</span>: {{order.contact_information.street_name}} {{order.contact_information.house_number}}, {{order.contact_information.zipcode}} {{order.contact_information.city}}
                </div>
                <hr/>
                <ul class="order-products list-group border-0">
                    <li class="list-group-item border-0 p-1" v-for="order_product in order.order_products">
                        <span class="badge badge-primary badge-pill">{{order_product.quantity}}x</span> {{order_product.product.name}}<span class="float-right">€{{order_product.product.price}}</span>
                    </li>
                </ul>
                <hr/>
                <div class="order-info text-right mb-3 pr-1 text-secondary">
                    Subtotaal: €{{order.amount}}<br/>
                    Bezorgskosten: €{{order.amount}}<br/><br/>
                    Totaal: €{{order.amount}}
                </div>
            </div>
            <div class="card-footer bg-light border-secondary p-1">
                <button v-bind:class="{ 'd-none': status != 'received' }" v-on:click="setOrderStatus('in_process')" type="button" class="btn btn-success p-1 ml-1 float-right"><i class="fas fa-plus mr-1"></i>Bereiden</button>
                <button v-bind:class="{ 'd-none': status != 'in_process' || order.type != 'delivery' }" v-on:click="setOrderStatus('on_the_way')" type="button" class="btn btn-info p-1 ml-1 float-right"><i class="fas fa-bicycle mr-1"></i>Bezorgen</button>
                <button v-bind:class="{ 'd-none': status != 'in_process' || order.type != 'takeaway' }" v-on:click="setOrderStatus('ready')" type="button" class="btn btn-success p-1 ml-1 float-right"><i class="fas fa-pizza-slice mr-1"></i>Klaar</button>
                <button v-bind:class="{ 'd-none': status != 'on_the_way' || order.type != 'delivery' }" v-on:click="setOrderStatus('delivered')" type="button" class="btn btn-success p-1 ml-1 float-right"><i class="fas fa-map-marker-alt mr-1"></i></i>Bezorgd</button>
                <button v-bind:class="{ 'd-none': status == 'ready' || status == 'delivered' }" v-on:click="setOrderStatus('canceled')" type="button" class="btn btn-danger p-1 ml-1 float-right"><i class="fas fa-ban mr-1"></i></i>Annuleren</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            order: null,
        },
        data: function() {
            return {
                status: Vue.util.extend(this.order.status),
            };
        },
        methods: {
            setOrderStatus(status) {
                axios.post(url()+'/api/setorderstatus', {
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    order_id: this.order.id,
                    order_status: status,
                })
                .then(response => {
                    this.status = status;
                    console.log(response.data.order)
                })
                .catch(error => {
                    console.log(error);
               });

            },
        },
        computed: {
            url() {
                return url();
            }
        },
    }
</script>
