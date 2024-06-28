<template>
    <div class="tab-pane fade" id="v-tab-data-pilihan" role="tabpanel"
        aria-labelledby="v-tab-data-pilihan">
        <div>
            <h5>{{ props.title }}</h5>
            <p class="text-muted">Mohon Lengkapi Data Berikut, Dan Pastikan Data Yang Anda Masukkan Benar</p>
        </div>

        <div>
            <form @submit.prevent="submitDataPilihan">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="cboPilihan1" class="form-label">Prodi Pilihan 1</label>
                        <select class="form-select" v-model="form.cboPilihan1"
                            :class="{ 'is-invalid': $page.props.errors.cboPilihan1 }">
                            <option disabled value="">Pilih Prodi Pilihan 1</option>
                            <option v-for = "(prd, index) in props.prodi_12" :key="index" :value="prd.id">
                                {{ prd.kd_prodi }} | {{ prd.nm_prodi }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboPilihan1" class="invalid-feedback">
                            {{ $page.props.errors.cboPilihan1 }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="cboPilihan2" class="form-label">Prodi Pilihan 2</label>
                        <select class="form-select" v-model="form.cboPilihan2"
                            :class="{ 'is-invalid': $page.props.errors.cboPilihan1 }">
                            <option disabled value="">Pilih Prodi Pilihan 2</option>
                            <option v-for = "(prd, index) in props.prodi_12" :key="index" :value="prd.id">
                                {{ prd.kd_prodi }} | {{ prd.nm_prodi }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboPilihan2" class="invalid-feedback">
                            {{ $page.props.errors.cboPilihan2 }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="cboPilihan3" class="form-label">Prodi Pilihan 3</label>
                        <select class="form-select" v-model="form.cboPilihan3"
                            :class="{ 'is-invalid': $page.props.errors.cboPilihan3 }">
                            <option disabled value="">Pilih Prodi Pilihan 3</option>
                            <option v-for = "(prd, index) in props.prodi_34" :key="index" :value="prd.id">
                                {{ prd.kd_prodi }} | {{ prd.nm_prodi }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboPilihan3" class="invalid-feedback">
                            {{ $page.props.errors.cboPilihan3 }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="cboPilihan4" class="form-label">Prodi Pilihan 4</label>
                        <select class="form-select" v-model="form.cboPilihan4"
                            :class="{ 'is-invalid': $page.props.errors.cboPilihan4 }">
                            <option disabled value="">Pilih Prodi Pilihan 4</option>
                            <option v-for = "(prd, index) in props.prodi_34" :key="index" :value="prd.id">
                                {{ prd.kd_prodi }} | {{ prd.nm_prodi }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboPilihan4" class="invalid-feedback">
                            {{ $page.props.errors.cboPilihan4 }}
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <div class="d-flex align-items-start gap-3 mt-4">
            <!-- <button
                type="button"
                class="btn btn-light btn-label previestab"
                data-previous="v-pills-bill-info-tab"
            >
                <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                    <span class="ms-4">Kembali Ke Data Pribadi</span></button> -->
            <button
                type="button"
                class="btn btn-success btn-label ms-auto nexttab nexttab"
                data-nexttab="v-pills-bill-address-tab"
                :disabled="btnDataPilihan"
                @click="submitDataPilihan">
                Simpan</button>
        </div>
        <div class="d-flex align-items-start gap-3 mt-4">
            <p class="text-danger">*Setelah Data Tersimpan, Silahkan Tekan Tombol Langkah 3 Data Prestasi Non Akademik Untuk Melanjutkan</p>
        </div>
    </div>
</template>

<script setup>
import { router, useForm, usePage } from "@inertiajs/vue3";
import { watch, ref, reactive, watchEffect, onMounted } from 'vue';
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';

const page = usePage()

const btnDataPilihan = ref(false);

const props = defineProps({
    title: String,
    peserta : Object,
    prodi_12 : Object,
    prodi_34 : Object,
});

console.log(props)

const form = useForm({
    cboPilihan1 : '',
    cboPilihan2 : '',
    cboPilihan3 : '',
    cboPilihan4 : ''
});

const submitDataPilihan = () => {
    router.post(`/peserta/data-pilihan/${page.props.auth.peserta.id}`, form, {
        onStart: () => btnDataPilihan.value = true,
        onFinish: () => btnDataPilihan.value = false,
        onError: () => {
            btnDataPilihan.value = false
            form.cancel()
        },
        onSuccess: () => {
            createToast(
                {
                    title: 'Berhasil Disimpan',
                    description: 'Tekan Tombol Langkah 3 Untuk Melanjutkan.'
                }, {
                    type: 'success',
                    showIcon: true,
                    transition: 'zoom',
                }
            )
        },
    });
}

onMounted(() => {
    if(page.props.auth.peserta.pil1_siswa) {
        form.cboPilihan1 = page.props.auth.peserta.pil1_siswa
    }

    if(page.props.auth.peserta.pil2_siswa) {
        form.cboPilihan2 = page.props.auth.peserta.pil2_siswa
    }

    if(page.props.auth.peserta.pil3_siswa) {
        form.cboPilihan3 = page.props.auth.peserta.pil3_siswa
    }

    if(page.props.auth.peserta.pil4_siswa) {
        form.cboPilihan4 = page.props.auth.peserta.pil4_siswa
    }
});


</script>
