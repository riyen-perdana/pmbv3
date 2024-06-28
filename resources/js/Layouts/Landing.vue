<template>
    <div class="layout-wrapper landing">
        <Navbar />
        <slot />
        <Footer />
    </div>
</template>

<script setup>
import Navbar from '@/Components/Landing/Navbar.vue';
import Footer from '@/Components/Landing/Footer.vue';
</script>
