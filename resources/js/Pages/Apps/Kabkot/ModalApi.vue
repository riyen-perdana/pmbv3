<template>
    <Modal id="mAPIKabkot" size="modal-lg" @close="closeModalAPI">
        <template #modalTitle>Get API Data Kabupaten Kota</template>
        <template #modalBody>
            <form @submit.prevent="prosesAPI()">
                <div class="col-md-12 lg-12 mb-3">
                    <label for="txtProvinsi" class="form-label">Pilih Provinsi</label>
                    <select v-model="form.cboProvinsi" class="form-select" :class="{ 'is-invalid': errorCbo }">
                        <option disabled value="">Pilih Provinsi</option>
                        <option v-for="(prov, index) in props.data" :key="index" :value="prov.id">
                            {{ prov.id }} | {{ prov.nm_provinsi }}
                        </option>
                    </select>
                    <div v-if="errorCbo" class="invalid-feedback">
                        {{ errorCbo }}
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
            <button :disabled="btnGetAPI" type="button" class="btn btn-light" @click="closeModalAPI()">Tutup</button>
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
import { ref, onMounted, onUnmounted, watchEffect } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import 'flatpickr/dist/flatpickr.css';

const emit = defineEmits(['close']);

const isShowPb = ref(false);
const btnGetAPI = ref(false);

const props = defineProps({
    showAPI: Boolean,
    data: Object
});

const modalAPI = ref(null);
const errorCbo = ref('');
const messageAction = ref('');
let persentase = ref(0);

const form = useForm({
    cboProvinsi: ''
});

const closeModalAPI = () => {
    modalAPI.value.hide()
    emit('close')
    form.reset()
    errorCbo.value = ''
    isShowPb.value = false
    router.reload()
}

const openModalAPI = () => {
    modalAPI.value.show()
}

onMounted(() => {
    modalAPI.value = useModal('#mAPIKabkot')
});

onUnmounted(() => {
    closeModalAPI();
});

watchEffect(() => {
    if (props.showAPI) {
        openModalAPI()
    }
});

async function prosesAPI() {
    if (form.cboProvinsi == '') {
        errorCbo.value = 'Kolom Provinsi Harus Dipilih';
        btnGetAPI.value = false
    } else {
        btnGetAPI.value = true
        errorCbo.value = ''
        isShowPb.value = true
        messageAction.value = 'Sinkronisasi Data API Kabupaten Kota [Jangan Menutup Halaman Ini Ketika Proses Baca Data Berlangsung]';
        await getApi()
    }
    // messageAction.value = 'Sinkronisasi Data API Kabupaten-Kota [Jangan Menutup Halaman Ini Ketika Proses Baca Data Berlangsung]';
}

async function getApi() {
    await axios.get('/apps/kabkot/apikabkot', {
        params: {
            id : form.cboProvinsi
        }
    }).then((response) => {
        console.log(response.data)
        let dataLength = response.data.length
        let countData = 0

        let intervalId = setInterval(()=> {
            persentase.value = parseInt(countData/dataLength * 100).toFixed(0)
            //Add Data Here
            if(persentase.value >= 100) {
                clearInterval(intervalId)
                persentase.value = 0
                btnGetAPI.value = false
                createToast(
                    {
                        title: 'Berhasil',
                        description: 'Data Kabupaten Kota Berhasil Ditambahkan.'
                    }, {
                        type: 'success',
                        showIcon: true,
                        transition: 'zoom',
                    }
                )
                closeModalAPI()
            }
            countData +=1
        },1000)
    })
}

async function addApiKabkot(dataList) {
    if (dataList != undefined) {
        try {
            router.post('/apps/kabkot/add-api-kabkot',{
                id : dataList.kode_wilayah,
                prov_id : dataList.mst_kode_wilayah,
                nm_kabkot : dataList.nama
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
