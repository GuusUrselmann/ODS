<template>
    <layout >
        <pre>
            {{order}}
        </pre>
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
