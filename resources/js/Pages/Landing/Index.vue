<template>
    <Head>
        <title>.:: E-admisi Universitas Islam Negeri Sultan Syarif Kasim Riau ::.</title>
    </Head>
    <Hero />
    <!-- <Kelulusan /> -->
    <Pembayaran />
    <Prodi :prodi="props.prodi" />
    <Jalur />
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import Layout from '@/Layouts/Landing.vue';
import Hero from '@/Components/Landing/Hero.vue';
import Pembayaran from '@/Components/Landing/Pembayaran.vue';
import Jalur from '@/Components/Landing/Jalur.vue';
import Kelulusan from '@/Components/Landing/Kelulusan.vue';
import Prodi from '@/Components/Landing/Prodi.vue';

defineOptions({ layout: Layout });

const props = defineProps({
    prodi: Object,
});

</script>
