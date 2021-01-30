<template>
    <div class="page-wrapper app">
        <Header />
        <div class="page-container">
            <div class="main-content">
                <slot />
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" data-backdrop="static" :data-order-type="$page.order_type == null ? 'false' : 'true'" id="selectOrderTypeModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <h3>Wilt U afhalen of bezorgen?</h3>
                        </div>
                        <!-- <div class="row">
                            <div class="col-5 offset-1 text-center">
                                <button type="button" class="btn btn-info" v-on:click="selectOrderType('takeaway')">
                                    <i class="fas fa-home"></i><br/>
                                    Afhalen
                                </button>
                            </div>
                            <div class="col-5 text-center">
                                <button type="button" class="btn btn-danger" v-on:click="selectOrderType('delivery')">
                                    <i class="fas fa-motorcycle"></i><br/>
                                    Bezorgen
                                </button>
                            </div>
                        </div> -->
                        <div class="order-type-selector mt-3">
                            <ul class="nav nav-pills">
                                <li class="mr-2 active selector-button btn btn-success"><a data-toggle="tab" href="#delivery">Bezorgen</a></li>
                                <li class="selector-button btn btn-success"><a data-toggle="tab" href="#takeaway">Afhalen</a></li>
                            </ul>
                            <div class="tab-content mt-1 p-1">
                                <div id="delivery" class="tab-pane active order-type-delivery">
                                    <h4>Vul je postcode in:</h4>
                                    <div class="input-group col-8 mt-3 pl-1">
                                        <input class="form-control zipcode-input mr-2" v-model="order_zipcode" name="zipcode"><button type="button" class="btn btn-info" v-on:click="validateZipcode()">Bestellen</button>
                                    </div>
                                </div>
                                <div id="takeaway" class="tab-pane order-type-takeaway">
                                    <h6>Je vind ons aan de</h6>
                                    <h3>{{$page.branch.contact_information.street_name}} {{$page.branch.contact_information.house_number}}</h3>
                                    <h5>in {{$page.branch.contact_information.city}}</h5>
                                    <button type="button" class="btn btn-info" v-on:click="selectOrderType('takeaway')">Bestellen</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Header from './Header';
    export default {
        components: {
            Header
        },
        data: function() {
            return {
                order_zipcode: null,
            };
        },
        methods: {
            selectOrderType(orderType) {
                axios.post(url()+'/api/setOrderType', {
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    order_type: orderType,
                })
                .then(response => {
                    $('#selectOrderTypeModal').modal('toggle')
                })
                .catch(error => {
                    console.log(error);
               });
           },
            validateZipcode() {
                axios.post(url()+'/api/validateZipcode', {
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    zipcode: this.order_zipcode,
                })
                .then(response => {
                    if(response.data.validated == true) {
                        $('#selectOrderTypeModal').modal('toggle')
                    }
                    else {
                        alert('foute postcode');
                    }
                })
                .catch(error => {
                    console.log(error);
               });
            }
        },
        // mounted() {
        //     this.$store.dispatch('initCart')
        //     if(!$('#selectOrderTypeModal').data('order-type')) {
        //         $('#selectOrderTypeModal').modal('toggle')
        //     }
        // }
    }
</script>
