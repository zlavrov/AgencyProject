<template>
    <header>
        <RouterLink class="btn btn-outline-success" :to="{name: 'home'}">Home</RouterLink>
        <RouterLink class="btn btn-outline-success" :to="{name: 'about'}">About</RouterLink>
    </header>
    <RouterView />
</template>

<script>
    import { RouterLink, RouterView } from 'vue-router'
    export default {
        components: {
            RouterLink, RouterView
        }
    }
</script>

<style>

</style>
