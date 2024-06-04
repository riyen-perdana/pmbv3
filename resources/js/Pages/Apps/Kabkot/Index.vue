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
                                <Titlebox :isDashboard="false" title="Data Kabupaten-Kota" subTitle="Manajemen Data Kabupaten-Kota Aplikasi E-Admisi" />
                            </div>
                            <Breadcrumb :items="breadcrumbs" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card" id="t_kabkot">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1"></h5>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-success add-btn mx-2"
                                                @click="clickButton(data.id)">
                                                <i class="ri-add-line align-bottom me-1"></i>Tambah Data
                                            </button>
                                            <button type="button" class="btn btn-danger add-btn" @click="openModalAPI()">
                                                <i class="align-bottom me-1"></i>Get API
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Modal :showAPI="openModalKabkotAPI" @close="closeAPI" :data="props.provinsi"/>
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
// import Form from "@/Pages/Apps/Kabkot/Form.vue";
import Alert from "@/Components/Alert.vue";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import Modal from "@/Pages/Apps/Kabkot/ModalApi.vue"

defineOptions({ layout: LayoutApp });

const props = defineProps({
    filters: Object,
    perPage: Number,
    provinsi: Object,
    kabkot : Object
});


const openModalKabkotAPI = ref(false)



const data = reactive({
    // params: {
    //     search: props.filters?.search,
    //     perPage: props.perPage
    // },
    createOpen: false,
    isEdit: false,
    openAlert: false,
    dataEdit: {},
    id: '',
    response : [],
});

const breadcrumbs = computed(() => {
    return [
        {
            label: 'Data Master',
            isActive: false,
        },
        {
            label: 'Kabupaten/Kota',
            url: 'kabkot'
        }
    ]
});

const openModalAPI = () => {
    openModalKabkotAPI.value = true
}

const closeAPI = () => {
    openModalKabkotAPI.value = false
}


</script>

<style>
btn-mr {
    margin-right: 5px;
}

td.r_atas {
    vertical-align: top;
}
</style>
