<template>
    <div class="tab-pane fade show active" id="v-tab-data-pribadi" role="tabpanel"
        aria-labelledby="v-pills-bill-info-tab">
        <div>
            <h5>{{ props.title }}</h5>
            <p class="text-muted">Mohon Lengkapi Data Berikut, Dan Pastikan Data Yang Anda Masukkan Benar</p>
        </div>

        <div>
            <form @submit.prevent="submitDataPribadi">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="txtNamaLengkap" class="form-label">Nama Lengkap</label>
                        <input v-model="form.txtNamaLengkap" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNamaLengkap }" type="text"
                            placeholder="Nama Lengkap">
                        <div v-if="$page.props.errors.txtNamaLengkap" class="invalid-feedback">
                            {{ $page.props.errors.txtNamaLengkap }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="txtNIK" class="form-label">Nomor Induk Kependudukan</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': $page.props.errors.txtNIK }"
                            v-model="form.txtNIK" placeholder="Nomor Induk Kependudukan">
                        <div v-if="$page.props.errors.txtNIK" class="invalid-feedback">
                            {{ $page.props.errors.txtNIK }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="txtTptLhr" class="form-label">Tempat Lahir Peserta</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': $page.props.errors.txtNIK }"
                            v-model="form.txtTptLhr" placeholder="Tempat Lahir Peserta">
                        <div v-if="$page.props.errors.txtTptLhr" class="invalid-feedback">
                            {{ $page.props.errors.txtTptLhr }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="txtTglLhr" class="form-label">Tanggal Lahir Peserta</label>
                        <input type="date" class="form-control" :class="{ 'is-invalid': $page.props.errors.txtTglLhr }"
                            v-model="form.txtTglLhr">
                        <div v-if="$page.props.errors.txtTglLhr" class="invalid-feedback">
                            {{ $page.props.errors.txtTglLhr }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="cboJenKel" class="form-label">Jenis Kelamin Peserta</label>
                        <select class="form-select" v-model="form.cboJenKel"
                            :class="{ 'is-invalid': $page.props.errors.cboJenKel }">
                            <option disabled value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <div v-if="$page.props.errors.cboJenKel" class="invalid-feedback">
                            {{ $page.props.errors.cboJenKel }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="txtFoto" class="form-label">Foto Peserta</label>
                        <input type="file" class="form-control" @input="form.txtFoto = $event.target.files[0]"
                            :class="{ 'is-invalid': $page.props.errors.txtFoto }">
                        <div v-if="$page.props.errors.txtFoto" class="invalid-feedback">
                            {{ $page.props.errors.txtFoto }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="cboAgama" class="form-label">Agama Peserta</label>
                        <select class="form-select" v-model="form.cboAgama"
                            :class="{ 'is-invalid': $page.props.errors.cboAgama }">
                            <option disabled value="">Pilih Agama</option>
                            <option v-for="(agm, index) in props.agama" :key="index" :value="agm.id">{{ agm.nm_agama }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboAgama" class="invalid-feedback">
                            {{ $page.props.errors.cboAgama }}
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label for="txtAlmt" class="form-label">Alamat Peserta</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': $page.props.errors.txtAlmt }"
                            v-model="form.txtAlmt" placeholder="Alamat Peserta">
                        <div v-if="$page.props.errors.txtAlmt" class="invalid-feedback">
                            {{ $page.props.errors.txtAlmt }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="txtEmail" class="form-label">Email Peserta</label>
                        <input type="email" class="form-control" :class="{ 'is-invalid': $page.props.errors.txtEmail }"
                            v-model="form.txtEmail" placeholder="Email Peserta">
                        <div v-if="$page.props.errors.txtEmail" class="invalid-feedback">
                            {{ $page.props.errors.txtEmail }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="txtNoHp" class="form-label">No. Telepon/HP Peserta</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': $page.props.errors.txtNoHp }"
                            v-model="form.txtNoHp" placeholder="No. Telepon/HP Peserta">
                        <div v-if="$page.props.errors.txtNoHp" class="invalid-feedback">
                            {{ $page.props.errors.txtNoHp }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="cboProvinsi" class="form-label">Pilih Provinsi</label>
                        <select v-model="form.cboProvinsi" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.cboProvinsi }">
                            <option disabled value="">Pilih Provinsi</option>
                            <option v-for="(prov, index) in props.provinsi" :key="index" :value="prov.id">
                                {{ prov.id }} | {{ prov.nm_provinsi }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboProvinsi" class="invalid-feedback">
                            {{ $page.props.errors.cboProvinsi }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="cboKabkot" class="form-label">Kabupaten-Kota</label>
                        <select v-model="form.cboKabkot" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.cboKabkot }">
                            <option disabled value="">Pilih Kabupaten-Kota</option>
                            <option v-for="(kk, index) in kabkot" :key="index" :value="kk.id">
                                {{ kk.id }} | {{ kk.nm_kabkot }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboKabkot" class="invalid-feedback">
                            {{ $page.props.errors.cboKabkot }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="cboKecamatan" class="form-label">Kecamatan</label>
                        <select v-model="form.cboKecamatan" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.cboKecamatan }">
                            <option disabled value="">Pilih Kecamatan</option>
                            <option v-for="(kec, index) in kecamatan" :key="index" :value="kec.id">
                                {{ kec.id }} | {{ kec.nm_kecamatan }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboKecamatan" class="invalid-feedback">
                            {{ $page.props.errors.cboKecamatan }}
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="cboKecamatan" class="form-label">Sekolah</label>
                        <select v-model="form.cboSekolah" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.cboSekolah }">
                            <option disabled value="">Pilih Sekolah</option>
                            <option v-for="(skl, index) in sekolah" :key="index" :value="skl.id">
                                {{ skl.id }} | {{ skl.nama }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboSekolah" class="invalid-feedback">
                            {{ $page.props.errors.cboSekolah }}
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <div class="d-flex align-items-start gap-3 mt-4">
            <button 
                type="button" 
                class="btn btn-success btn-label right ms-auto" 
                data-nexttab="v-pills-bill-address-tab" 
                :disabled="btnDataPribadi" 
                @click="submitDataPribadi">
                <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                Simpan dan Lanjutkan
            </button>
        </div>
    </div>
</template>

<script setup>
import { router, useForm, usePage } from "@inertiajs/vue3";
import { watch, ref, reactive, watchEffect, onMounted, computed, defineEmits } from 'vue';
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import 'flatpickr/dist/flatpickr.css';
import axios from 'axios';

const page = usePage()

const props = defineProps({
    provinsi: Object,
    title: String,
    agama: Object,
    sekolahData: Object
});

const form = useForm({
    txtNamaLengkap: page.props.auth.peserta.nm_siswa,
    txtNIK: page.props.auth.peserta.nik_siswa,
    txtTptLhr: page.props.auth.peserta.tptlhr_siswa,
    txtTglLhr: page.props.auth.peserta.tgllhr_siswa,
    cboJenKel: '',
    txtFoto: '',
    cboAgama: '',
    txtAlmt: page.props.auth.peserta.almt_siswa,
    txtEmail: page.props.auth.peserta.email_siswa,
    txtNoHp: page.props.auth.peserta.notlpn_siswa,
    cboProvinsi: '',
    cboKabkot: '',
    cboKecamatan: '',
    cboSekolah: '',
})

const kabkot = ref([]);
const kecamatan = ref([]);
const sekolah = ref([]);
const btnDataPribadi = ref(false);
const emit = defineEmits(['stepComplete']);

watch(() => form.cboProvinsi, (newValue) => {
    if (newValue) {
        fetchDataKabkot()
        if (props.sekolahData.sekolah?.kecamatan.kabkot.id) {
            form.cboKabkot = props.sekolahData.sekolah.kecamatan.kabkot.id
        }
    }
})

watch(() => form.cboKabkot, (newValue) => {
    if (newValue) {
        fetchDataKecamatan()
        if (props.sekolahData.sekolah?.kecamatan?.id) {
            form.cboKecamatan = props.sekolahData.sekolah.kecamatan.id
        }
    }
})

watch(() => form.cboKecamatan, (newValue) => {
    if (newValue) {
        fetchDataSekolah()
        if (props.sekolahData.sekolah?.id) {
            form.cboSekolah = props.sekolahData.sekolah.id
        }
    }
})

const fetchDataKabkot = async () => {
    const response = await axios.get(`/peserta/kabkot/propinsi/${form.cboProvinsi}`);
    if(response.data.length > 0) {
        kabkot.value = response.data
    } else {
        form.cboKabkot = ''
        kabkot.value = []
    }
}

const fetchDataKecamatan = async () => {
    form.reset('cboKecamatan')
    const response = await axios.get(`/peserta/kecamatan/kabkot/${form.cboKabkot}`);
    kecamatan.value = response.data
}

const fetchDataSekolah = async () => {
    form.reset('cboSekolah')
    const response = await axios.get(`/peserta/sekolah/kecamatan/${form.cboKecamatan}`);
    sekolah.value = response.data
}

onMounted(() => {
    if (props.sekolahData.sekolah?.kecamatan.kabkot.provinsi?.id) {
        form.cboProvinsi = props.sekolahData.sekolah?.kecamatan.kabkot.provinsi?.id
    }

    if (page.props.auth.peserta.jklmn_siswa) {
        form.cboJenKel = page.props.auth.peserta.jklmn_siswa
    }

    if (page.props.auth.peserta.agm_siswa) {
        form.cboAgama = page.props.auth.peserta.agm_siswa
    }
})

function submitDataPribadi() {
    btnDataPribadi.value = true
    router.post(`/peserta/data-pribadi/${page.props.auth.peserta.id}`, form,
        {
            _method: 'put',
            preserveScroll: false,
            preserveState: false,
            onStart: () => btnDataPribadi.value = true,
            onFinish: () => btnDataPribadi.value = false,
            onError: () => {
                btnDataPribadi.value = false
                form.cancel()
            },
            onSuccess: () => {
                createToast(
                    {
                        title: 'Berhasil Disimpan',
                        description: 'Data Pribadi Berhasil Disimpan.'
                    }, {
                    type: 'success',
                    showIcon: true,
                    transition: 'zoom',
                })
                form.txtFoto = null
                emit('stepComplete')
            },
        })
}
</script>
