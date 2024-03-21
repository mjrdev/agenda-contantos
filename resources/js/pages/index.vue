<script setup>
    import { ref } from 'vue'
    import Header from '../components/Header.vue';
    import DefaultPage from '../components/DefaultPage.vue';
    import '../../css/app.css';
 
    const count = ref(0)
</script>
 
<template>
    <div class="app-main">
        <Header />
        <DefaultPage />
    </div>
</template>

<style>
</style>