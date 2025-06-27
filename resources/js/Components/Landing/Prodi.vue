<template>
    <section class="section bg-light" id="prodi">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h1 class="mb-3 fw-bold text-uppercase">Program Studi</h1>
                        <p class="text-muted mb-4">Daftar Program Studi Universitas Islam Negeri Sultan Syarif Kasim Riau Jalur Masuk Undangan Mandiri</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6" v-for="item in prodi" :key="prodi.id">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shink-0">
                                        <img src="../../../../public/images/logo-uin.png" alt=""
                                            class="avatar-sm object-cover rounded" />
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <!-- <a href="pages-profile"> -->
                                        <h5 class="mb-3 fw-bold" style="font-size: 13px !important;">{{ item.nm_prodi }}</h5>
                                    <!-- </a> -->
                                    <p class="mb-0 fw-semibold text-muted" style="font-size: 13px;">Akreditasi {{ item.akreditasi.jns_akreditasi }}</p>
                                    <p class="mb-0 fw-semibold text-danger" style="font-size: 13px;">Kuota Penerimaan : {{ item.quota }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const props = defineProps({
    prodi: Object
});
</script>