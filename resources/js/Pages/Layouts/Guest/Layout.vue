<template>
    <div class="page-wrapper app">
        <Header />
        <div class="page-container">
            <div class="main-content">
                <slot />
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
        mounted() {
            this.$store.dispatch('initCart')
        }
    }
</script>
