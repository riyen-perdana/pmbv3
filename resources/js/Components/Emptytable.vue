<template>
    <div class="noresult" style="display: none" :class="{ 'd-block': data.data.length == 0 }">
        <div class="text-center">
            <lottie
                class="avatar-xl"
                colors="primary:#121331,secondary:#08a88a"
                :options="defaultOptions"
                :height="200"
                :width="200"
            />
            <h5 class="mt-2">Maaf, Data Yang Anda Cari Tidak Ditemukan</h5>
            <p class="text-muted mb-0">
                Kami telah mencari data ke seluruh perangkat yang terkoneksi, tetapi data yang anda cari tidak kami temukan.
            </p>
        </div>
    </div>
</template>

<script setup>

import { ref } from 'vue';
import Lottie from "@/Components/Widgets/Lottie.vue";
import animationData from "@/Components/Widgets/searching.json";

const defaultOptions = ref({animationData: animationData})

const props = defineProps ({
    data : Object
})

</script>
