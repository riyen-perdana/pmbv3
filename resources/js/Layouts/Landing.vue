<template>
    <div class="layout-wrapper landing">
        <Navbar />
        <Hero />
        <Pembayaran />
        <Jalur />
        <slot />
        <Footer />
    </div>
</template>

<script setup>
import Navbar from '@/Components/Landing/Navbar.vue';
import Hero from '@/Components/Landing/Hero.vue';
import Footer from '@/Components/Landing/Footer.vue';
import Pembayaran from '@/Components/Landing/Pembayaran.vue';
import Jalur from '@/Components/Landing/Jalur.vue';

</script>

<style lang="scss" scoped>

</style>
