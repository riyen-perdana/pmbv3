<template>
    <div class="tab-pane fade" id="v-tab-verifikasi" role="tabpanel" aria-labelledby="v-tab-verifikasi">
        <div>
            <h5>{{ props.title }}</h5>
            <p class="text-danger">Mohon Periksa Kembali Data Yang Anda Masukkan Pada Setiap Langkah, Kesalahan Dalam Proses Input Data Akan Menyebabkan Anda Gagal Atau Tidak Diterima Pada Seleksi Jalur Undangan Ini.</p>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <form @submit.prevent="submitData()">
                    <!-- Custom Checkboxes Color -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" v-model="form.verifikasi" id="chkVerifikasi" type="checkbox">
                        <label class="form-check-label" for="chkVerifikasi">
                            Dengan ini saya menyatakan bahwa data yang saya masukkan pada borang pendaftaran ini adalah benar, dan saya bersedia untuk digugurkan dari peserta Penerimaan Mahasiswa Baru Universitas Islam Negeri Riau TA. 2024 apabila dikemudian hari ditemukan data yang tidak benar
                        </label>
                    </div>
                </form>
            </div>
            <div class="d-flex align-items-start gap-3 mt-4">
            <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                data-nexttab="v-pills-bill-address-tab" :disabled="form.processing" @click="submitVerifikasi"><i
                    class="ri-save-2-line label-icon align-middle fs-16 ms-2"></i>Verifikasi dan Simpan</button>
        </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps(['title'])

const form = useForm({
    verifikasi: ''
});

</script>
