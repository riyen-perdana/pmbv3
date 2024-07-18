<template>
    <div class="offcanvas offcanvas-end border-0" :class="props.show ? 'show' : 'hiding'" tabindex="-1" visible="true">
        <div class="d-flex align-items-center bg-primary bg-gradient p-3 offcanvas-header">
            <h5 class="m-0 me-2 text-white" id="offcanvasLabel">Detail Peserta</h5>
            <button id="close-btn" type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                aria-label="Close" @click="closeCanvas()"></button>
        </div>
        <div class="offcanvas-body p-0 bg-soft-warning">
            <div data-simplebar="init" class="h-100">
                <div class="simplebar-wrapper" style="margin: 0px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                <div class="simplebar-content" style="padding: 0px;">
                                    <div class="p-4">
                                        <div class="row">
                                            <h6 class="mb-2 fw-bold text-uppercase text-primary">Data Personal Peserta
                                            </h6>
                                            <hr>
                                            <h6 class="mb-2 fw-semibold text-uppercase">No. Pendaftaran : <span
                                                    class="text-danger fw-bold">{{
                                                        props.peserta?.nomor }}</span></h6>
                                            <div class="d-flex flex-row">
                                                <div class="me-3">
                                                    <div class="mx-auto">
                                                        <div v-if="$props.peserta?.foto_siswa"><img
                                                                :src="`/storage/fotopeserta/${$props.peserta?.foto_siswa}`"
                                                                alt="user-img" class="profil-peserta2 rounded-circle" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column px-2 w-100">
                                                    <div class="d-flex flex-row">
                                                        <div class="d-flex justify-content-start">
                                                            NISN</div>
                                                        <div class="d-flex justify-content-end w-100 fst-italic">
                                                            {{ props.peserta?.nisn_siswa }}</div>
                                                    </div>
                                                    <div class="d-flex flex-row">
                                                        <div class="d-flex justify-content-start">
                                                            Nama</div>
                                                        <div class="d-flex justify-content-end w-100 fst-italic">
                                                            {{ props.peserta?.nm_siswa }}</div>
                                                    </div>
                                                    <div class="d-flex flex-row">
                                                        <div class="d-flex justify-content-start">
                                                            NIK</div>
                                                        <div class="d-flex justify-content-end w-100 fst-italic">
                                                            {{ props.peserta?.nik_siswa }}</div>
                                                    </div>
                                                    <div class="d-flex flex-row">
                                                        <div class="d-flex justify-content-start">
                                                            Telepon</div>
                                                        <div class="d-flex justify-content-end w-100 fst-italic">
                                                            {{ props.peserta?.notlpn_siswa }}</div>
                                                    </div>
                                                    <div class="d-flex flex-row">
                                                        <div class="d-flex justify-content-start">
                                                            Sekolah</div>
                                                        <div class="d-flex justify-content-end w-100 fst-italic">
                                                            {{ props.peserta?.sekolah?.nama }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <h6 class="mb-2 fw-bold text-uppercase text-primary">Data Pilihan Peserta
                                            </h6>
                                            <hr>
                                            <div class="d-flex flex-column">
                                                <div class="d-flex flex-row">
                                                    <div class="d-flex justify-content-start w-100">Pilihan 1</div>
                                                    <div class="d-flex justify-content-end w-100 fst-italic">{{
                                                        props.peserta?.pil_1?.nm_prodi }}</div>
                                                </div>
                                                <div class="d-flex flex-row">
                                                    <div class="d-flex justify-content-start w-100">Pilihan 2</div>
                                                    <div class="d-flex justify-content-end w-100 fst-italic">{{
                                                        props.peserta?.pil_2?.nm_prodi }}</div>
                                                </div>
                                                <div class="d-flex flex-row">
                                                    <div class="d-flex justify-content-start w-100">Pilihan 3</div>
                                                    <div class="d-flex justify-content-end w-100 fst-italic">{{
                                                        props.peserta?.pil_3?.nm_prodi }}</div>
                                                </div>
                                                <div class="d-flex flex-row">
                                                    <div class="d-flex justify-content-start w-100">Pilihan 4</div>
                                                    <div class="d-flex justify-content-end w-100 fst-italic">{{
                                                        props.peserta?.pil_4?.nm_prodi }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <h6 class="mb-2 fw-bold text-uppercase text-primary">Data Prestasi Peserta
                                            </h6>
                                            <hr>
                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle table-nowrap mb-0">
                                                    <thead class="table-light boder-white">
                                                        <tr>
                                                            <th scope="col" style="width:4%;">#</th>
                                                            <th scope="col" style="width:80%;">Prestasi</th>
                                                            <th scope="col" style="width: 13%;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(prst, index) in showDataPrestasi" :key="index">
                                                            <td class="r_atas"><input :id="prst.id" class="form-check-input" type="checkbox" :value="prst.id" v-model="selected" @change="changeData(prst.id)"/></td>
                                                            <td>
                                                                <p class="mb-0 text-dark fw-semibold">{{ prst.nm_prestasi }}</p>
                                                                <p class="mb-0 text-dark fst-italic">Bidang : {{
                                                                    prst.bidang?.nama }}</p>
                                                                <p class="mb-0 text-dark fst-italic">Tingkat : {{
                                                                    prst.tingkat?.nama }}</p>
                                                                <p class="mb-0 text-dark fst-italic">Jenis : {{
                                                                    prst.inkel?.nama }}</p>
                                                                <p class="mb-0 text-dark fw-bold">Nilai : {{ prst.bidang?.nilai + prst.tingkat?.nilai + prst.inkel?.nilai }}</p>
                                                            </td>
                                                            <td class="r_atas">
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    @click="previewData(prst)">
                                                                    Lihat Data
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr v-if="showDataPrestasi.length == 0">
                                                            <td colspan="3" class="text-center text-danger fst-italic"
                                                                style="font-size: small !important;">Data Prestasi Tidak
                                                                Ditemukan [Error]</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <h6 class="mb-2 fw-bold text-uppercase text-primary">Data Rapor Peserta</h6>
                                            <hr>
                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle table-nowrap mb-0">
                                                    <thead class="table-light boder-white">
                                                        <tr class="text-center">
                                                            <th scope="col" style="width:4%;">No.</th>
                                                            <th scope="col" style="width:40%;">PAI</th>
                                                            <th scope="col" style="width:40%;">MTK</th>
                                                            <th scope="col" style="width: 13%;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="text-center" v-if="Object.keys(showDataRapor).length == 0">
                                                            <td class="r_atas">1.</td>
                                                            <td class="r_atas">{{ showDataRapor.n_bing }}</td>
                                                            <td class="r_atas">{{ showDataRapor.n_mtk }}</td>
                                                            <td class="r_atas">
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    @click="previewDataRapor(showDataRapor)">
                                                                    Lihat Data
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr class="text-center" v-else>
                                                            <td colspan="3" class="text-center text-danger fst-italic"
                                                                style="font-size: small !important;">Data Rapor Tidak
                                                                Ditemukan [Error]</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <h6 class="mb-2 fw-bold text-uppercase text-primary">Verifikasi Peserta</h6>
                                            <hr>
                                            <button class="btn btn-danger" @click="cancelVer()">Batalkan Verifikasi
                                                Peserta</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer border-top p-3 text-center bg-soft-primary">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-light w-100" id="reset-layout" @click="closeCanvas()">
                        Tutup
                    </button>
                </div>
                <div class="col-6">
                    <button @click="verSiswa()" :disabled="props.peserta?.is_vrf_op == 'Y' ? true : false" type="button"
                        class="btn btn-primary w-100">Verifikasi Operator</button>
                </div>
            </div>
        </div>
    </div>
    <FormPrestasi :show="showFormPrestasi" :tingkat="props.tingkat" :bidang="props.bidang" :prestasi="prestasi"
        :inkel="props.inkel" @close-form-prestasi="closeFormPrestasi" />
    <FormRapor :show="showFormRapor" :rapor="rapor" @close-form-rapor="closeFormRapor" />
    <CancelVer :show="openAlert" :id="props.id" @close-alert="cancelVer" @cancel-ver="cancelData" />
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { computed, onUnmounted, reactive, ref, watch, watchEffect } from 'vue';
import CancelVer from '@/Components/CancelVer.vue';
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import FormPrestasi from '@/Pages/Apps/Peserta/FormPrestasi.vue';
import FormRapor from '@/Pages/Apps/Peserta/FormRapor.vue';
import axios from 'axios';

const emit = defineEmits(['close-canvas'])

const props = defineProps({
    show: Boolean,
    id: String,
    peserta: Object,
    inkel: Object,
    bidang: Object,
    tingkat: Object
});

const show = ref(false);
const showFormPrestasi = ref(false);
const showFormRapor = ref(false);
const openAlert = ref(false);
const prestasi = ref({});
const rapor = ref({});
const selected = ref([])

const showDataPrestasi = ref({});
const showDataRapor = ref({});

const closeFormPrestasi = async () => {
    showFormPrestasi.value = !showFormPrestasi.value
    fetchDataPrestasi()
}

const changeData = (id) => {
    router.post('peserta/update-check-prestasi',
        {
            id: id,
            checked: watchDataChecked.value
        },
        {
            preserveScroll: true,
            preserveState: true,
        }
    )
}

const watchDataChecked = computed(() => {
    if(selected.value.length > 0) {
        return 'true'
    } else {
        return 'false'
    }
})

const closeFormRapor = async () => {
    showFormRapor.value = !showFormRapor.value
    fetchDataPrestasi()
}

const closeAlert = () => {
    openAlert.value = !openAlert.value
}

const cancelVer = () => {
    openAlert.value = !openAlert.value
}

watchEffect(() => {
    if (props.show) {
        show.value = true;
    }
});

const closeCanvas = () => {
    emit('close-canvas')
}

onUnmounted(() => {
    props.id = ''
    props.peserta = {}
    props.show = false
    closeCanvas()
})

const previewData = (dataPrestasi) => {
    showFormPrestasi.value = !showFormPrestasi.value
    prestasi.value = dataPrestasi
}

const previewDataRapor = (dataRapor) => {
    showFormRapor.value = !showFormRapor.value
    rapor.value = dataRapor
}

const cancelData = async (id) => {
    closeCanvas()
    router.post(`/apps/peserta/${id}`,
        {
            _method: 'put',
            preserveScroll: true,
            preserveState: true,
            onSuccess: async () => {
                closeAlert
                createToast(
                    {
                        title: 'Berhasil',
                        description: 'Verifikasi Siswa Berhasil Dibatalkan.'
                    }, {
                    type: 'success',
                    showIcon: true,
                    transition: 'zoom',
                }
                )
            },
            onError: () => {
                closeAlert
                createToast(
                    {
                        title: 'Error',
                        description: 'Verifikasi Siswa Gagal Dibatalkan.'
                    }, {
                    type: 'danger',
                    showIcon: 'true',
                    transition: 'zoom',
                }
                )
            }
        })
}

const fetchDataPrestasi = () => {
    axios.get(`/apps/peserta/datapeserta/${props.peserta?.id}`)
        .then((res) => {
            showDataPrestasi.value = res.data.prestasi
            showDataRapor.value = res.data.rapor
        }).catch((err) => {
            console.log(err)
        })
}

watchEffect(() => {
    if (props.id) {
        fetchDataPrestasi()
    }
});

const verSiswa = () => {
    router.post(`/apps/peserta/updateverifikasi/${props.peserta?.id}`, {
        preserveScroll: true,
        preserveState: true
    }),
        closeCanvas()
        createToast(
            {
                title: 'Berhasil',
                description: 'Verifikasi Siswa Berhasil Dilakukan.'
            }, {
            type: 'success',
            showIcon: true,
            transition: 'zoom',
        }
    )
}

</script>

<style>
.profil-peserta2 {
    height: 75px;
    width: 75px;
}
</style>
