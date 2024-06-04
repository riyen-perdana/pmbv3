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
                                <Titlebox :isDashboard="false" title="Data Provinsi"
                                    subTitle="Manajemen Data Provinsi Aplikasi E-Admisi" />
                            </div>
                            <Breadcrumb :items="breadcrumbs" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card" id="t_provinsi">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1"></h5>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-success add-btn mx-2"
                                                @click="clickButton(data.id)">
                                                <i class="ri-add-line align-bottom me-1"></i>Tambah Data
                                            </button>
                                            <button type="button" class="btn btn-danger add-btn" @click="processDataProvinsi()" :disabled="btnGetApi">
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
                                                    placeholder="Cari Data Provinsi" v-model="data.params.search">
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
                                    <div id="pgb" v-if="isShowPb">
                                        <div class="spinner-border text-danger" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div class="row py-2 provinsi">
                                            <span class="fw-semibold">{{ messageAction }}</span>
                                        </div>
                                        <div class="progress mb-4">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="`width: ${persentase}%;`" aria-valuemin="0" aria-valuemax="100">{{ persentase }}%</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div>
                                            <div class="table-responsive table-card mb-3 mt-3">
                                                <table class="table table-hover align-middle table-nowrap mb-0"
                                                    id="provinsiTable">
                                                    <thead class="table-light boder-white">
                                                        <tr>
                                                            <th scope="col" style="width:4%;">No.</th>
                                                            <th scope="col" style="width:13%;">ID Provinsi</th>
                                                            <th scope="col" style="width:70%;">Provinsi</th>
                                                            <th scope="col" style="width: 13%;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(prv, index) in provinsi.data" :key="index">
                                                            <td class="r_atas">{{ (provinsi.current_page - 1) *
                                                                provinsi.per_page + index + 1 }}.</td>
                                                            <td class="r_atas">{{ prv.id }}</td>
                                                            <td class="r_atas">{{ prv.nm_provinsi }}</td>
                                                            <td class="r_atas">
                                                                <div class="hstack gap-2 flex-wrap">
                                                                    <!-- Buttons Group -->
                                                                    <button type="button"
                                                                        class="btn btn-secondary btn-sm"
                                                                        @click="clickButton(prv.id, prv)"><i
                                                                            class="ri-edit-2-line label-icon align-middle fs-10 me-1"></i>
                                                                        Edit&nbsp;&nbsp;&nbsp;</button>
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        @click="destroy(prv.id)"><i
                                                                            class="ri-delete-bin-2-line label-icon align-middle fs-10 me-1"></i>
                                                                        Hapus</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <Emptytable :data="provinsi" />
                                            </div>
                                            <div v-if="provinsi.data.length != 0">
                                                <Pagination :links="provinsi.links" :count="provinsi"
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
        <Form :show="data.createOpen" :provinsi="props.provinsi" :isEdit="data.isEdit" :dataEdit="data.dataEdit"
            @close="closeModal" />
        <Alert :show="data.openAlert" :id="data.id" @close-alert="closeAlert" @delete-data="deleteProvinsi" />
    </div>
</template>

<script setup>
import { Head, router } from "@inertiajs/vue3";
import axios from "axios";
import { reactive, computed, watch, ref } from "vue";
import LayoutApp from "@/Layouts/App.vue";
import Titlebox from "@/Components/Titlebox.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Pagination from "@/Components/Pagination.vue";
import Emptytable from "@/Components/Emptytable.vue";
import { cloneDeep, debounce, pickBy } from "lodash";
import Form from "@/Pages/Apps/Provinsi/Form.vue";
import Alert from "@/Components/Alert.vue";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';

defineOptions({ layout: LayoutApp });

const props = defineProps({
    filters: Object,
    perPage: Number,
    provinsi: Object
});

const isShowPb = ref(false);
const messageAction = ref('');
const btnGetApi = ref(false);
let persentase = ref(0);

const data = reactive({
    params: {
        search: props.filters?.search,
        perPage: props.perPage
    },
    createOpen: false,
    isEdit: false,
    openAlert: false,
    dataEdit: {},
    id: '',
    response : []
});

const closeModal = () => {
    data.createOpen = false
    data.isEdit = false
    data.id = ''
};

const breadcrumbs = computed(() => {
    return [
        {
            label: 'Data Master',
            isActive: false,
        },
        {
            label: 'Provinsi',
            url: 'provinsi'
        }
    ]
});

const closeAlert = () => {
    data.openAlert = !data.openAlert
    data.isEdit = false
    data.id = 0
};

const deleteProvinsi = (id) => {
    router.delete(`/apps/provinsi/${id}`,
        {
            replace: true,
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeAlert
                createToast(
                    {
                        title: 'Berhasil',
                        description: 'Data Provinsi Berhasil Dihapus.'
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
                        description: 'Gagal Menghapus Data Provinsi.'
                    }, {
                    type: 'danger',
                    showIcon: 'true',
                    transition: 'zoom',
                }
                )
            }
        })
};

async function processDataProvinsi() {
    btnGetApi.value = true
    isShowPb.value = true
    messageAction.value = 'Sinkronisasi Data API Provinsi [Jangan Menutup Halaman Ini Ketika Proses Baca Data Berlangsung]';
    await getApi()
    // await deleteProvinsiAll();
}

async function getApi() {
    await axios.get('/apps/provinsi/apiprov')
        .then((response) => {
            console.log(response.data)
            let dataLength = response.data.length
            let countData = 0

            let intervalId = setInterval(() => {
                persentase.value = parseInt(countData/dataLength * 100).toFixed(0)
                addApiProvinsi(response.data[countData])
                if(persentase.value >= 100) {
                    clearInterval(intervalId);
                    persentase.value = 0;
                    btnGetApi.value = false
                    isShowPb.value = false
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Data Provinsi Berhasil Ditambahkan.'
                        }, {
                            type: 'success',
                            showIcon: true,
                            transition: 'zoom',
                        }
                    )
                }
                countData +=1;
                // router.get('/apps/provinsi',{
                //     replace : true,
                //     preserveState : true,
                //     preserveScroll : true,
                // })
            }, 1000);
        })
}

async function addApiProvinsi(dataList) {
    if (dataList != undefined) {
        try {
            router.post('/apps/provinsi/add-api-provinsi',{
                id : dataList.kode_wilayah,
                nm_provinsi : dataList.nama
            }, {
                preserveScroll : true,
                preserveState : true
            })
        } catch (error) {
            console.error("Error:", error);
        }
    }
}

const destroy = (id) => {
    data.openAlert = true
    data.id = id
};

watch(() => cloneDeep(data.params), debounce(() => {
    let param = pickBy(data.params)
    router.get('/apps/provinsi', param, {
        replace: true,
        preserveState: true,
        preserveScroll: true
    })
}, 150));

//Modal
const clickButton = (id, provinsi) => {
    data.id = id
    if (id == '') {
        data.isEdit = false
    } else {
        data.isEdit = true
        data.dataEdit = provinsi;
    }
    data.createOpen = true
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
