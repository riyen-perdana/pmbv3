<template>
    <Modal id="mAPISekolah" size="modal-lg" @close="closeModalSekolahAPI">
        <template #modalTitle>Get API Data Sekolah</template>
        <template #modalBody>
            <form @submit.prevent="prosesAPI()">
                <div class="row">
                    <div class="col-md-12 col-lg-12 mb-3">
                        <label for="cboProvinsi" class="form-label">Pilih Provinsi</label>
                        <select v-model="form.cboProvinsi" class="form-select"
                            :class="{ 'is-invalid': errorCboProvinsi }">
                            <option disabled value="">Pilih Provinsi</option>
                            <option v-for="(prov, index) in props.provinsi" :key="index" :value="prov.id">
                                {{ prov.id }} | {{ prov.nm_provinsi }}
                            </option>
                        </select>
                        <div v-if="errorCboProvinsi" class="invalid-feedback">
                            {{ errorCboProvinsi }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <label for="cboKabkot" class="form-label">Kabupaten-Kota</label>
                        <select v-model="form.cboKabkot" class="form-select"
                            :class="{ 'is-invalid': errorCboKabkot }">
                            <option disabled value="">Pilih Kabupaten-Kota</option>
                            <option v-for="(kk, index) in kabkot" :key="index" :value="kk.id">
                                {{ kk.id }} | {{ kk.nm_kabkot }}
                            </option>
                        </select>
                        <div v-if="errorCboKabkot" class="invalid-feedback">
                            {{ errorCboKabkot }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <label for="cboKecamatan" class="form-label">Kecamatan</label>
                        <select v-model="form.cboKecamatan" class="form-select"
                            :class="{ 'is-invalid': errorCboKecamatan }">
                            <option disabled value="">Pilih Kecamatan</option>
                            <option v-for="(kec, index) in kecamatan" :key="index" :value="kec.id">
                                {{ kec.id }} | {{ kec.nm_kecamatan }}
                            </option>
                        </select>
                        <div v-if="errorCboKecamatan" class="invalid-feedback">
                            {{ errorCboKecamatan }}
                        </div>
                    </div>
                </div>
            </form>
            <div id="pgb" v-if="isShowPb">
                <div class="spinner-border text-danger" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="row py-2 provinsi">
                    <span class="fw-semibold">{{ messageAction }}</span>
                </div>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        :style="`width: ${persentase}%;`" aria-valuemin="0" aria-valuemax="100">{{ persentase }}%</div>
                </div>
            </div>
        </template>
        <template #modalFooter>
            <button :disabled="btnGetAPI" type="button" class="btn btn-light"
                @click="closeModalSekolahAPI()">Tutup</button>
            <button :disabled="btnGetAPI" type="submit" @click="prosesAPI" class="btn btn-primary">
                Proses API
            </button>
        </template>
    </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import axios from "axios";
import { useModal } from "@/Composables/useModal.js";
import { ref, onMounted, onUnmounted, watchEffect, watch } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import 'flatpickr/dist/flatpickr.css';

const emit = defineEmits(['close']);

const isShowPb = ref(false);
const btnGetAPI = ref(false);
const kabkot = ref([]);
const kecamatan = ref([]);
const messageAction = ref('');
const persentase = ref(0);
const errorCboProvinsi = ref('');
const errorCboKabkot = ref('');
const errorCboKecamatan = ref('');

const modalAPI = ref(null);

const props = defineProps({
    showAPI: Boolean,
    provinsi: Object
});

const openModalAPI = () => {
    modalAPI.value.show()
}

onMounted(() => {
    modalAPI.value = useModal('#mAPISekolah');
});

onUnmounted(() => {
    closeModalSekolahAPI();
});

watchEffect(() => {
    if (props.showAPI) {
        openModalAPI()
    }
});

const closeModalSekolahAPI = () => {
    modalAPI.value.hide()
    emit('close')
    form.reset()
    errorCboProvinsi.value = ''
    errorCboKabkot.value = ''
    errorCboKecamatan.value = ''
    isShowPb.value = false
    router.reload()
}

const form = useForm({
    cboProvinsi: '',
    cboKabkot: '',
    cboKecamatan: '',
});

watch(() => form.cboProvinsi, (newValue) => {
    if (newValue) {
        fetchDataKabkot()
    }
})

watch(() => form.cboKabkot, (newValue) => {
    if (newValue) {
        fetchDataKecamatan()
    }
})

const fetchDataKabkot = async () => {
    form.reset('cboKabkot')
    const response = await axios.get(`/apps/kabkot/propinsi/${form.cboProvinsi}`);
    kabkot.value = response.data
}

const fetchDataKecamatan = async () => {
    form.reset('cboKecamatan')
    const response = await axios.get(`/apps/kecamatan/kabkot/${form.cboKabkot}`);
    kecamatan.value = response.data
}

async function prosesAPI() {
    if (form.cboProvinsi == '' && form.cboKabkot == '' && form.cboKecamatan == '') {
        errorCboProvinsi.value = 'Kolom Provinsi Harus Dipilih';
        errorCboKabkot.value = 'Kolom Kabupaten Kota Harus Dipilih';
        errorCboKecamatan.value = 'Kolom Kecamatan Harus Dipilih';
        btnGetAPI.value = false
    } else if (form.cboProvinsi == '') {
        errorCboProvinsi.value = 'Kolom Provinsi Harus Dipilih';
        btnGetAPI.value = false
    } else if (form.cboKabkot == '') {
        errorCboProvinsi.value = '';
        errorCboKabkot.value = 'Kolom Kabupaten Kota Harus Dipilih';
        btnGetAPI.value = false
    } else if (form.cboKecamatan == '') {
        errorCboKecamatan.value = 'Kolom Kecamatan Harus Dipilih';
        btnGetAPI.value = false
    } else {
        btnGetAPI.value = true
        errorCboProvinsi.value = ''
        errorCboKabkot.value = ''
        isShowPb.value = true
        messageAction.value = 'Sinkronisasi Data API Sekolah [Jangan Menutup Halaman Ini Ketika Proses Baca Data Berlangsung]';
        await getAPI()
    }
}

async function getAPI() {
    await axios.get('/apps/sekolah/apisekolah', {
        params: {
            kecamatan: form.cboKecamatan
        }
    })
        .then((response) => {
            let dataLength = Object.keys(response.data).length
            let countData = 0

            let intervalId = setInterval(() => {
                persentase.value = parseInt(countData/dataLength * 100).toFixed(0)
                addApiSekolah(response.data[countData])
                if(persentase.value >= 100) {
                    clearInterval(intervalId);
                    persentase.value = 0;
                    btnGetAPI.value = false
                    closeModalSekolahAPI()
                }
                countData++
            }, 1000);
        });
}

async function addApiSekolah(dataList) {
    if (dataList != undefined) {
        try {
            router.post('/apps/sekolah/add-api-sekolah',{
                id : dataList[1],
                kecamatan_id : form.cboKecamatan,
                nama : dataList[2],
                alamat : dataList[3]
            }, {
                preserveScroll : true,
                preserveState : true
            })
        } catch (error) {
            console.log(error)
        }
    }
}

</script>

<style lang="scss" scoped></style>
