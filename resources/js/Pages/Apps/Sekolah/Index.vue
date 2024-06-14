<template>
    <Head>
        <title>
            .:: E-admisi Universitas Islam Negeri Sultan Syarif Kasim Riau ::.
        </title>
    </Head>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="row mb-3 pb-1 p-3">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <Titlebox :isDashboard="false" title="Data Pendidikan Menengah"
                                    subTitle="Manajemen Data Pendidikan Menengah Aplikasi E-Admisi" />
                            </div>
                            <Breadcrumb :items="breadcrumbs" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card" id="t_pendidikanmenengah">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1"></h5>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-success add-btn mx-2"
                                                @click="clickButton(data.id)">
                                                <i class="ri-add-line align-bottom me-1"></i>Tambah Data
                                            </button>
                                            <button type="button" class="btn btn-danger add-btn"
                                                @click="openModalAPI()">
                                                <i class="align-bottom me-1"></i>Get API
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body doted">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="search-box">
                                                <input type="text" class="form-control search bg-light"
                                                    placeholder="Cari Data NPSN, Nama Sekolah" v-model="data.params.search">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-auto ms-auto">
                                            <div class="d-flex flex-row align-items-center gap-2">
                                                <select class="form-select mb-3" aria-label="Default select example"
                                                    v-model="data.params.perPage">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                                <span class="text-muted text-show">Entries</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div>
                                            <div class="table-responsive table-card mb-3 mt-3">
                                                <table class="table table-hover align-middle table-nowrap mb-0"
                                                    id="sekolahTable">
                                                    <thead class="table-light boder-white">
                                                        <tr>
                                                            <th scope="col" style="width:4%;">No.</th>
                                                            <th scope="col" style="width:23%;">NPSN/Nama Sekolah/Alamat</th>
                                                            <th scope="col" style="width:20%;">Kecamatan</th>
                                                            <th scope="col" style="width:20%;">Kabupaten-Kota</th>
                                                            <th scope="col" style="width:20%;">Provinsi</th>
                                                            <th scope="col" style="width: 13%;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(sklh, index) in sekolah.data" :key="index">
                                                            <td class="r_atas">{{ (sekolah.current_page - 1) * data.params.perPage + index + 1 }}</td>
                                                            <td class="r-atas">
                                                                <div class='fw-bold'>NPSN : {{ sklh.id }}</div>
                                                                <div class="fw-bold text-wrap">{{ sklh.nama }}</div>
                                                                <div class="fw-normal text-wrap">{{ sklh.alamat }}</div>
                                                            </td>
                                                            <td class="r_atas">{{ sklh.kecamatan.nm_kecamatan }}</td>
                                                            <td class="r_atas">{{ sklh.kecamatan.kabkot.nm_kabkot }}</td>
                                                            <td class="r_atas">{{ sklh.kecamatan.kabkot.provinsi.nm_provinsi }}</td>
                                                            <td class="r_atas">
                                                                <div class="hstack gap-2 flex-wrap">
                                                                    <!-- Buttons Group -->
                                                                    <button type="button"
                                                                        class="btn btn-secondary btn-sm"
                                                                        @click="clickButton(kec.id, kec)"><i
                                                                            class="ri-edit-2-line label-icon align-middle fs-10 me-1"></i>
                                                                        Edit&nbsp;&nbsp;&nbsp;</button>
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        @click="destroy(kec.id)"><i
                                                                            class="ri-delete-bin-2-line label-icon align-middle fs-10 me-1"></i>
                                                                        Hapus</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <Emptytable :data="sekolah" />
                                            </div>
                                            <div v-if="sekolah.data.length != 0">
                                                <Pagination :links="sekolah.links" :count="sekolah"
                                                    :perPage="props.perPage" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Modal :showAPI="openModalSekolahAPI" @close="closeModalSekolahAPI" :provinsi="props.provinsi" />
        <Form :show="data.createOpen" :provinsi="props.provinsi" :isEdit="data.isEdit" :dataEdit="data.dataEdit" @close="closeModal" />
    </div>
</template>

<script setup>
import { Head, router } from "@inertiajs/vue3";
import { reactive, computed, watch, ref } from "vue";
import LayoutApp from "@/Layouts/App.vue";
import Titlebox from "@/Components/Titlebox.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Pagination from "@/Components/Pagination.vue";
import Emptytable from "@/Components/Emptytable.vue";
import { cloneDeep, debounce, pickBy } from "lodash";
import Form from "@/Pages/Apps/Sekolah/Form.vue";
import Alert from "@/Components/Alert.vue";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import Modal from "@/Pages/Apps/Sekolah/ModalApi.vue"

defineOptions({ layout: LayoutApp });

const openModalSekolahAPI = ref(false);

const closeModalSekolahAPI = () => {
    openModalSekolahAPI.value = false
}

const openModalAPI = () => {
    openModalSekolahAPI.value = true
}

const breadcrumbs = computed(() => {
    return [
        {
            label: 'Data Master',
            isActive: false,
        },
        {
            label: 'Pendidikan Menengah',
            url: 'sekolah'
        }
    ]
});

const props = defineProps({
    filters: Object,
    perPage: Number,
    provinsi: Object,
    sekolah : Object
});

const data = reactive({
    params: {
        search: props.filters?.search,
        perPage: props.perPage
    },
    createOpen: false,
    isEdit: false,
    openAlert: false,
    dataEdit: {},
    id: ''
});

const closeModal = () => {
    data.createOpen = false
    data.isEdit = false
    data.id = ''
};

const clickButton = (id, sekolah) => {
    data.id = id
    if (id == '') {
        data.isEdit = false
    } else {
        data.isEdit = true
        data.dataEdit = sekolah;
    }
    data.createOpen = true
};

const destroy = (id) => {
    data.openAlert = true
    data.id = id
};

</script>

<style>
btn-mr {
    margin-right: 5px;
}

td.r_atas {
    vertical-align: top;
}
</style>
