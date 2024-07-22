<template>
    <!-- start faqs -->
    <section class="section bg-light" id="kelulusan">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h1 class="mb-3 fw-bold text-uppercase">Kelulusan Jalur Undangan Mandiri</h1>
                        <p class="text-muted mb-4">Silahkan Masukkan Nomor Pendaftaran atau NISN Anda Dan Tekan Tombol
                            Enter</p>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <form @submit.prevent="submitData()">
                <div class="row g-lg-5 g-4 justify-content-center">
                    <div class="text-center col-lg-6">
                        <input v-model="form.txt_NISN_No" type="text" class="form-control"
                            placeholder="Silahkan Masukkan Nomor Pendaftaran atau NISN Anda">
                    </div>
                    <button @click.prevent="submitData()" type="button" class="btn btn-primary" style="width: 100px;"
                        :disabled="btnDisabled">Cari</button>
                </div>
            </form>
            <div class="row g-lg-5 g-4 justify-content-center mt-1">
                <div class="text-center" v-if="dataMahasiswa">
                    <div v-if="dataMahasiswa.is_lulus == 'Y'">
                        <h5 class="mb-1 fw-bold text-uppercase">Selamat <span class="text-danger">{{
                                dataMahasiswa.nm_siswa }}</span> Anda Dinyatakan Lulus</h5>
                        <p class="text-muted mb-0 text-uppercase">Pada Program Studi {{ dataMahasiswa.prodi.nm_prodi }}
                        </p>
                        <p class="text-muted mb-0">Silahkan Melakukan Daftar Ulang Pada Aplikasi Sireg Dengan Mengklik
                            Link <a href="https://sireg.uin-suska.ac.id"
                                class="text-primary">https://sireg.uin-suska.ac.id</a></p>

                    </div>
                    <div v-else>
                        <h5 class="mb-1 fw-bold text-uppercase">Maaf <span class="text-danger">{{ dataMahasiswa.nm_siswa
                                }}</span> Anda Dinyatakan Tidak Lulus</h5>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end faqs -->
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';

let dataMahasiswa
const form = useForm({
    txt_NISN_No: '',
})
const btnDisabled = ref(false);
const submitData = async () => {
    if (form.txt_NISN_No.trim() != '') {
        btnDisabled.value = true
        await axios.get(`/kelulusan/${form.txt_NISN_No}`)
            .then((response) => {
                dataMahasiswa = response.data
            }).catch((error) => {
                console.log(error)
            })
        btnDisabled.value = false
    }
}

</script>
