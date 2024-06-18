<template>
    <Head>
        <title>.:: E-admisi Universitas Islam Negeri Sultan Syarif Kasim Riau ::.</title>
    </Head>
    <div class="col-lg-6 border-start border-dark mh-100">
        <div class="p-4">
            <div class="d-flex flex-row gap-2 mx-auto">
                <div>
                    <img src="../../../../public/images/logo-uin.png" height="67px" />
                </div>
                <div class="mt-1">
                    <h5 class="title">E-Admisi</h5>
                    <h5 class="sub-title">Universitas Islam Negeri Sultan Syarif Kasim Riau</h5>
                </div>
            </div>
            <div class="mt-4">
                <div class="container" style="height: 200px;">
                    <div class="row">
                        <h4>ID {{ props.peserta?.id }}</h4>
                        <p class="mt-3 justify-content-center">Terima Kasih Telah Melakukan Proses Pradaftar Jalur Undangan Mandiri,
                           Untuk Langkah Selanjutnya Silahkan Tekan Tombol <b>Cetak Pradaftar</b>
                           Untuk Melakukan Cetak Pradaftar Dan Lakukan Proses Pembayaran,
                           Kemudian Login Kembali Untuk Pengisian Data Pribadi, Prestasi Non Akademik dan Prestasi Akademik
                        </p>
                        <p class="mt-2">Selalu Ingat <b>ID</b> anda Untuk Memudahkan Proses Tracking Data</p>
                    </div>
                </div>
                <div class="mt-4 justify-content-end d-flex">
                    <a :href="`/pradaftar/pdf/${props.peserta.id}`" class="btn btn-success w-25 mx-2" target="_blank">Cetak Pradaftar</a>
                    <Link href="/" class="btn btn-warning w-25">Kembali</Link>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import Layout from '@/Layouts/Auth.vue';
import { ref, nextTick } from 'vue';

defineOptions({ layout: Layout });

const btnDisabled = ref(false);

const props = defineProps({
    peserta : Object
});

const cetakPradaftar = () => {
    router.get(`/pradaftar/pdf/${props.peserta.id}`)
}

</script>

