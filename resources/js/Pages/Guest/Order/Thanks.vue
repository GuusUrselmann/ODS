<template>
    <layout >
        <section class="section pt-5 pb-5 osahan-not-found-page">
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-center pt-5 pb-5">
                  <img class="img-fluid mb-5" :src="$page.paths.asset+'images/site/thanks.png'" alt="404">
                  <h1 class="mt-2 mb-2 text-success">Bedankt!</h1>
                  <p class="mb-5">Wij hebben Uw bestelling ontvangen!</p>
                  <inertia-link class="btn btn-primary btn-lg" :href="$page.paths.url+'/bestelling/volgen/'+order.uuid">Bestelling volgen</inertia-link>
               </div>
            </div>
         </div>
      </section>
    </layout>
</template>

<script>
    import Layout from '../../Layouts/Guest/Layout';
    export default {
        components: {
            Layout,
        },
        props: {
            order: Object
        }
    }
</script>
