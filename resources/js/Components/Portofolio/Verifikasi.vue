<template>
    <div class="tab-pane fade" id="v-tab-verifikasi" role="tabpanel" aria-labelledby="v-tab-verifikasi">
        <div>
            <h5>{{ props.title }}</h5>
            <p class="text-danger">Mohon Periksa Kembali Data Yang Anda Masukkan Pada Setiap Langkah, Kesalahan Dalam
                Proses Input Data Akan Menyebabkan Anda Gagal Atau Tidak Diterima Pada Seleksi Jalur Undangan Ini.</p>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <form @submit.prevent="submitVerifikasi()">
                    <!-- Custom Checkboxes Color -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" v-model="form.verifikasi" id="chkVerifikasi" type="checkbox">
                        <label class="form-check-label" for="chkVerifikasi">
                            Dengan ini saya menyatakan bahwa data yang saya masukkan pada borang pendaftaran ini adalah
                            benar, dan saya bersedia untuk digugurkan dari peserta Penerimaan Mahasiswa Baru Universitas
                            Islam Negeri Riau TA. 2024 apabila dikemudian hari ditemukan data yang tidak benar
                        </label>
                        <p class="text-danger mt-2" v-if="errorVerifikasi">{{ errorVerifikasi }}</p>
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
import { router, useForm, usePage } from "@inertiajs/vue3";
import { ref } from 'vue';
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import 'flatpickr/dist/flatpickr.css';

const props = defineProps(['title'])

const form = useForm({
    verifikasi: false
});

const page = usePage()

const errorVerifikasi = ref('');

const submitVerifikasi = () => {
    console.log(form.verifikasi)
    if (form.verifikasi === false) {
        errorVerifikasi.value = 'Anda Harus Menyetujui Syarat dan Ketentuan Ini Untuk Melanjutkan Ke Proses Selanjutnya';
    } else {
        router.post(`/peserta/verifikasi/${page.props.auth.peserta.id}`, form,
            {
                _method: 'put',
                preserveScroll: true,
                preserveState: true,
                onStart: () => form.processing = true,
                onFinish: () => form.processing = false,
                onSuccess: () => {
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Verifikasi Data Berhasil Dilakukan'
                        },
                        {
                            type: 'success',
                            showIcon: true,
                            transition: 'zoom',
                        })
                    form.verifikasi = false
                }
            });
    }//form.post(route('portofolio.verifikasi'));
}

</script>
