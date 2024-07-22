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
                                <Titlebox :isDashboard="false" title="Data Program Studi"
                                    subTitle="Manajemen Data Program Studi Aplikasi E-Admisi" />
                            </div>
                            <Breadcrumb :items="breadcrumbs" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card" id="t_prodi">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1"></h5>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-success add-btn"
                                                @click="clickButton(data.id)">
                                                <i class="ri-add-line align-bottom me-1"></i>Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body doted">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="search-box">
                                                <input type="text" class="form-control search bg-light"
                                                    placeholder="Cari Data Kode atau Nama Program Studi"
                                                    v-model="data.params.search">
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
                                                <table class="table table-hover align-middle table-nowrap mb-0" id="prodiTable">
                                                    <thead class="table-light boder-white">
                                                        <tr>
                                                            <th scope="col" style="width:4%;">No.</th>
                                                            <th scope="col" style="width:20%;">Kode Prodi/Nama Prodi/Akreditasi</th>
                                                            <th scope="col" style="width:19%;">Fakultas</th>
                                                            <th scope="col" style="width:10%;">Jenjang</th>
                                                            <th scope="col" style="width:10%;">Link Website/Akreditasi</th>
                                                            <th scope="col" style="width:10%;">Status</th>
                                                            <th scope="col" style="width: 18%;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(prd, index) in prodi.data" :key="index">
                                                            <td class="r_atas">{{ (prodi.current_page - 1) * prodi.per_page + index + 1 }}.</td>
                                                            <td class="r_atas">
                                                                <div class="col">
                                                                    <div>
                                                                        Kode Prodi [ <span class="fw-bold">{{ prd.kd_prodi }}</span> ]
                                                                    </div>
                                                                    <div>
                                                                        {{ prd.nm_prodi }}
                                                                    </div>
                                                                    <div>
                                                                        Akreditasi  <span class="fw-bold">{{ prd.akreditasi.jns_akreditasi }}</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="r_atas">{{ prd.fakultas.nm_fakultas }}</td>
                                                            <td class="r_atas">{{ prd.jenjang.nm_jenjang }}</td>
                                                            <td class="r_atas">
                                                                <div class="col">
                                                                    <div>
                                                                        Link : {{ prd.url_prodi ? prd.url_prodi : '-' }}
                                                                    </div>
                                                                    <div>
                                                                        Link : {{ prd.url_akr_prodi ? prd.url_akr_prodi : '-' }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="r_atas">Status Pil 1-2 &nbsp;: <span :class="prd.is_aktif == 'Y' ? 'badge bg-success' : 'badge bg-danger'">{{ prd.is_aktif == 'Y' ? 'Aktif' : 'Tidak Aktif'}}</span>
                                                                <br>Status Pil 3-4 : <span :class="prd.is_pil_34 == 'Y' ? 'badge bg-success' : 'badge bg-danger'">{{ prd.is_pil_34 == 'Y' ? 'Aktif' : 'Tidak Aktif'}}</span>
                                                            </td>
                                                            <td class="r_atas">
                                                                <div class="hstack gap-2 flex-wrap">
                                                                    <!-- Buttons Group -->
                                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                                        @click="clickButton(prd.id, prd)"><i
                                                                            class="ri-edit-2-line label-icon align-middle fs-10 me-1"></i>
                                                                        Edit&nbsp;&nbsp;&nbsp;</button>
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        @click="destroy(prd.id)"><i
                                                                            class="ri-delete-bin-2-line label-icon align-middle fs-10 me-1"></i>
                                                                        Hapus</button>
                                                                    <div v-if="prd.is_valid == 'Y'">
                                                                        <button type="button" class="btn btn-warning btn-sm"
                                                                            @click="print(prd.id)"><i
                                                                            class="ri-printer-line label-icon align-middle fs-10 me-1"></i>
                                                                            Cetak
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <Emptytable :data="prodi" />
                                            </div>
                                            <div v-if="prodi.data.length != 0">
                                                <Pagination :links="prodi.links" :count="prodi" />
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
        <Form :show="data.createOpen" :fakultas="props.fakultas" :jenjang="props.jenjang" :akreditasi="props.akreditasi" :isEdit="data.isEdit" :dataEdit="data.dataEdit" @close="closeModal" />
        <Alert :show="data.openAlert" :id="data.id" @close-alert="closeAlert" @delete-data="deleteProdi" />
    </div>
</template>

<script setup>
import { Head, router } from "@inertiajs/vue3";
import { reactive, computed, watch } from "vue";
import LayoutApp from "@/Layouts/App.vue";
import Titlebox from "@/Components/Titlebox.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Pagination from "@/Components/Pagination.vue";
import Emptytable from "@/Components/Emptytable.vue";
import { cloneDeep, debounce, pickBy } from "lodash";
import Form from "@/Pages/Apps/Prodi/Form.vue";
import Alert from "@/Components/Alert.vue";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import axios from "axios";

defineOptions({ layout: LayoutApp });

const props = defineProps({
    filters: Object,
    perPage: Number,
    prodi: Object,
    fakultas : Array,
    jenjang : Array,
    akreditasi : Array
});

const breadcrumbs = computed(() => {
    return [
        {
            label: 'Unit Organisasi',
            isActive: false,
        },
        {
            label: 'Program Studi',
            url: 'prodi'
        }
    ]
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

//Modal
const clickButton = (id, prodi) => {
    data.id = id
    if (id == '') {
        data.isEdit = false
    } else {
        data.isEdit = true
        data.dataEdit = prodi;
    }
    data.createOpen = true
};

const closeModal = () => {
    data.createOpen = false
    data.isEdit = false
    data.id = ''
};

const closeAlert = () => {
    data.openAlert = !data.openAlert
    data.isEdit = false
    data.id = 0
};

const destroy = (id) => {
    data.openAlert = true
    data.id = id
};

const deleteProdi = (id) => {
    router.delete(`/apps/prodi/${id}`,
    {
        preserveState: true,
        preserveScroll: true,
        onSuccess : () => {
            closeAlert
            createToast(
                {
                    title: 'Berhasil',
                    description: 'Data Program Studi Berhasil Dihapus.'
                }, {
                    type: 'success',
                    showIcon: true,
                    transition: 'zoom',
                }
            )
        },
        onError : () => {
            closeAlert
            createToast(
                {
                    title: 'Error',
                    description: 'Gagal Menghapus Data Program Studi.'
                }, {
                    type: 'danger',
                    showIcon: 'true',
                    transition: 'zoom',
                }
            )
        }
    })
};

watch(() => cloneDeep(data.params), debounce(() => {
    let param = pickBy(data.params)
    router.get('/apps/prodi', param, {
        replace: true,
        preserveState: true,
        preserveScroll: true
    })
}, 150));

const print = (id) => {
    router.post(`/apps/prodi/cetak/${id}`, {
        preserveScroll: true,
        preserveState: true,
    })
    //cetak()
}

const cetak = () => {
    axios.get('/apps/prodi/download', { responseType: 'blob' })
    .then((res) => {
        console.log(res.data)
        let blob = new Blob([res.data], {type:'application/*'})
        let link = document.createElement('a')
        link.href = window.URL.createObjectURL(blob)
        link.download = 'Laporan.docx'
        link._target = 'blank'
        link.click();
    })
}

</script>

<style>
.btn-mr {
    margin-right: 5px;
}

td.r_atas {
    vertical-align: top;
}
</style>
