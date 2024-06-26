<template>
    <Modal id="mAPIKecamatan" size="modal-lg" @close="closeModalKecamatanAPI">
        <template #modalTitle>Get API Data Kecamatan</template>
        <template #modalBody>
            <form @submit.prevent="prosesAPI()">
                <div class="row">
                    <div class="col-md-6 lg-6 mb-3">
                        <label for="txtProvinsi" class="form-label">Pilih Provinsi</label>
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
                    <div class="col-md-6 lg-6 mb-3">
                        <label for="txtProvinsi" class="form-label">Pilih Kabupaten-Kota</label>
                        <select v-model="form.cboKabkot" class="form-select" :class="{ 'is-invalid': errorCboKabkot }">
                            <option disabled value="">Pilih Kabupaten-Kota</option>
                            <option v-for="(kk, index) in kabkot" :key="index" :value="kk.id">
                                {{ kk.id }} | {{ kk.nm_kabkot }}
                            </option>
                        </select>
                        <div v-if="errorCboKabkot" class="invalid-feedback">
                            {{ errorCboKabkot }}
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
                @click="closeModalKecamatanAPI()">Tutup</button>
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

const emit = defineEmits(['close']);

const isShowPb = ref(false);
const btnGetAPI = ref(false);
const kabkot = ref([]);

const props = defineProps({
    showAPI: Boolean,
    provinsi: Object
});

const modalAPI = ref(null);
const errorCboProvinsi = ref('');
const errorCboKabkot = ref('');
const messageAction = ref('');
let persentase = ref(0);

onMounted(() => {
    modalAPI.value = useModal('#mAPIKecamatan')
});

onUnmounted(() => {
    closeModalKecamatanAPI();
});

const closeModalKecamatanAPI = () => {
    modalAPI.value.hide()
    emit('close')
    form.reset()
    errorCboProvinsi.value = ''
    errorCboKabkot.value = ''
    isShowPb.value = false
    router.reload()
}

const openModalAPI = () => {
    modalAPI.value.show()
}

watchEffect(() => {
    if (props.showAPI) {
        openModalAPI()
    }
});

const form = useForm({
    cboProvinsi: '',
    cboKabkot: ''
});

const fetchDataKabkot = async() => {
    form.reset('cboKabkot')
    const response = await axios.get(`/apps/kabkot/propinsi/${form.cboProvinsi}`);
    kabkot.value = response.data
}

watch(() => form.cboProvinsi, (newValue) => {
    if(newValue) {
        fetchDataKabkot()
    }
});

async function prosesAPI() {
    router.reload();
    if (form.cboProvinsi == '' && form.cboKabkot == '') {
        errorCboProvinsi.value = 'Kolom Provinsi Harus Dipilih';
        errorCboKabkot.value = 'Kolom Kabupaten Kota Harus Dipilih';
        btnGetAPI.value = false
    } else if (form.cboProvinsi == '') {
        errorCboProvinsi.value = 'Kolom Provinsi Harus Dipilih';
        btnGetAPI.value = false
    } else if (form.cboKabkot == '') {
        errorCboProvinsi.value = '';
        errorCboKabkot.value = 'Kolom Kabupaten Kota Harus Dipilih';
        btnGetAPI.value = false
    } else {
        btnGetAPI.value = true
        errorCboProvinsi.value = ''
        errorCboKabkot.value = ''
        isShowPb.value = true
        messageAction.value = 'Sinkronisasi Data API Kecamatan [Jangan Menutup Halaman Ini Ketika Proses Baca Data Berlangsung]';
        await getAPI()
    }
}

async function getAPI() {
    await axios.get('/apps/kecamatan/apikecamatan', {
        params: {
            id : form.cboKabkot
        }
    }).then((response) => {
        console.log(response.data)
        let dataLength = response.data.length
        let countData = 0

        let intervalId = setInterval(() => {
            persentase.value = parseInt(countData/dataLength * 100).toFixed(0)
            addApiKecamatan(response.data[countData])
            if(persentase.value >= 100) {
                clearInterval(intervalId);
                persentase.value = 0;
                btnGetAPI.value = false
                isShowPb.value = false
                createToast(
                    {
                        title: 'Berhasil',
                        description: 'Sinkronisasi Data Kecamatan Berhasil.'
                    }, {
                        type: 'success',
                        showIcon: true,
                        transition: 'zoom',
                    }
                )
                closeModalKecamatanAPI()
            }
            countData +=1;
        },1000)
    })
}

async function addApiKecamatan(dataList) {
    if (dataList != undefined) {
        try {
            router.post('/apps/kecamatan/add-api-kecamatan',{
                id : dataList.kode_wilayah,
                kabkot_id : dataList.mst_kode_wilayah,
                nm_kecamatan : dataList.nama
            }, {
                preserveScroll : true,
                preserveState : true
            })
        } catch (error) {
            console.error("Error:", error);
        }
    }
}

</script>

<style lang="scss" scoped></style>
