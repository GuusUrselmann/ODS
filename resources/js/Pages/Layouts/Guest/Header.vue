<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <inertia-link class="navbar-brand float-left" :href="$page.paths.url+'/home'">
                <img :src="$page.paths.asset+$page.options.website_logo" height="30px" class="css-class" alt="alt text">
                {{$page.options.header_title}}
            </inertia-link>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarNavDropdown" style="">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown pr-3" v-if="$page.user">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mijn Account
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="">Instellingen</a>
                            <a class="dropdown-item" href="">Bestellingen</a>
                            <a class="dropdown-item" href=""onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Uitloggen
                            </a>
                            <form id="logout-form" :action="$page.paths.url+'/logout'" method="POST" style="display: none;">
                                <input type="hidden" name="_token" :value="csrf">
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-cart pr-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-shopping-basket"></i> Winkelwagen
                        </a>
                        <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
                            <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0 show">
                                <div class="dropdown-cart-top-header p-4">
                                    <img :src="$page.paths.asset+'images/site/logo-small.png'" class="css-class float-left mr-3">
                                    <h6 class="mb-0">{{$page.branch.name}}</h6>
                                    <p class="text-secondary mb-0">{{$page.branch.contact_information.street_name}} {{$page.branch.contact_information.house_number}}, {{$page.branch.contact_information.city}}</p>
                                </div>
                                <div class="dropdown-cart-top-body border-top p-4">
                                    <p class="mb-2" v-for="cart_item in cart">
                                        {{cart_item.name}} x {{cart_item.quantity}} <span class="float-right text-secondary">€{{cart_item.price.toFixed(2)}}</span>
                                    </p>
                                </div>
                                <div class="dropdown-cart-top-footer border-top p-4">
                                    <div v-for="condition in conditions" class="condition row">
                                        <div class="col-6 offset-6 d-inline-block">
                                            <h6 class="float-left"><b>{{condition.name}}</b></h6>
                                            <div class="text-right"><b>{{condition.value}}</b></div>
                                        </div>
                                    </div>
                                    <p class="mb-0 font-weight-bold text-secondary">Totaal <span class="float-right text-dark">€{{amount.toFixed(2)}}</span></p>
                                </div>
                                <div class="dropdown-cart-top-footer border-top p-2">
                                    <a class="btn btn-success btn-block btn-lg" :href="this.$page.paths.url+'/bestellen'"> Afrekenen<i class="fas fa-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item" v-if="$page.user">
                        <a class="nav-link" :href="$page.paths.url+'/admin'">Admin</a>
                    </li>
                    <li class="nav-item" v-if="!$page.user">
                        <a class="nav-link" :href="$page.paths.url+'/login'">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
  export default {
      data: function() {
          return {
              csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          }
      },
      computed : {
          cart() {
              return this.$store.getters.getCart
          },
          conditions() {
              return this.$store.getters.getConditions
          },
          amount() {
              return this.$store.getters.getAmount
          },
      }
  }
</script>
