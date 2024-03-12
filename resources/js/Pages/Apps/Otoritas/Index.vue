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
                                <Titlebox :isDashboard=false title="Data Otoritas"
                                    subTitle="Manajemen Data Otoritas Aplikasi E-Admisi" />
                            </div>
                            <Breadcrumb :items="breadcrumbs" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card" id="t_otorisasi">
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
                                                    placeholder="Cari Data" v-model="data.params.search">
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
                                                    id="otoritasTable">
                                                    <thead class="table-light boder-white">
                                                        <tr>
                                                            <th scope="col" style="width:50px;">No.</th>
                                                            <th class="sort" data-sort="name" scope="col"
                                                                style="width: 15%;">Otoritas</th>
                                                            <th scope="col">Permission</th>
                                                            <th scope="col" style="width: 13%;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(role, index) in props.roles.data" :key="index">
                                                            <td class="r_atas">{{ (roles.current_page - 1) * roles.per_page
                                                                + index + 1 }}
                                                                .</td>
                                                            <td class="r_atas">{{ role.name }}</td>
                                                            <td class="r_atas">
                                                                <div class="d-flex flex-wrap gap-2">
                                                                    <span v-for="(permission, index) in role.permissions"
                                                                        :key="index" class="badge text-bg-primary fs-11">
                                                                        {{ permission.name }} &nbsp;
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td class="r_atas">
                                                                <div class="hstack gap-2 flex-wrap">
                                                                    <!-- Buttons Group -->
                                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                                        @click="clickButton(role.id, role)"><i
                                                                            class="ri-edit-2-line label-icon align-middle fs-10 me-1"></i>
                                                                        Edit&nbsp;&nbsp;&nbsp;</button>
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        @click="destroy(role.id)"><i
                                                                            class="ri-delete-bin-2-line label-icon align-middle fs-10 me-1"></i>
                                                                        Hapus</button>
                                                                    <!-- <button type="button" class="btn btn-danger btn-sm" @click="destroy(role.id)"><i class="ri-delete-bin-2-line label-icon align-middle fs-10 me-1"></i> Hapus</button> -->
                                                                    <!-- <Link :href="`/apps/roles/${role.id}/edit`" class="btn link-success btn-sm fs-15"><i class="ri-edit-2-line"></i></Link>
                                                                    <button @click.prevent="destroy(role.id)" class="btn btn-sm link-danger fs-15"><i class="ri-delete-bin-line"></i></button> -->
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <Emptytable :data="roles" />
                                            </div>
                                            <div v-if="roles.data.length != 0">
                                                <Pagination :links="roles.links" :count="roles" />
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
    </div>
    <div>
        <Form :show="data.createOpen" :id="data.id" :isEdit="data.isEdit" :data="dataPermissions" :dataEdit="data.dataEdit"
            @close="closeModal" />
        <Alert :show="data.openAlert" :id="data.id" @close-alert="closeAlert" @delete-data="deleteRole" />
    </div>
</template>

<script setup>
import { Head, router } from "@inertiajs/vue3"
import { reactive, computed, watch } from "vue";
import LayoutApp from "@/Layouts/App.vue";
import Titlebox from "@/Components/Titlebox.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Pagination from "@/Components/Pagination.vue";
import Emptytable from "@/Components/Emptytable.vue";
import { cloneDeep, debounce, pickBy } from "lodash";
import Form from "@/Pages/Apps/Otoritas/Form.vue";
import Alert from "@/Components/Alert.vue";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';

defineOptions({ layout: LayoutApp });

const props = defineProps({
    filters: Object,
    perPage: Number,
    roles: Object,
    dataPermissions: Array
})

const breadcrumbs = computed(() => {
    return [
        {
            label: 'Authentikasi',
            isActive: false,
        },
        {
            label: 'Otoritas',
            url: 'roles',
            isActive: true
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
    id: 0,
    dataEdit: {}
})

const clickButton = (id, role) => {
    data.createOpen = true
    data.id = id
    if (id == 0) {
        data.isEdit = false
    } else {
        data.isEdit = true
        data.dataEdit = role
    }
}

const closeModal = () => {
    data.createOpen = false
    data.isEdit = false
    data.id = 0
}

const destroy = (id) => {
    data.openAlert = true
    data.id = id
}

const closeAlert = () => {
    data.openAlert = !data.openAlert
    data.isEdit = false
    data.id = 0
}

const deleteRole = (id) => {
    router.delete(`/apps/roles/${id}`,
    {
        onSuccess : () => {
            closeAlert
            createToast(
                {
                    title: 'Berhasil',
                    description: 'Data Otoritas Berhasil Dihapus.'
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
                    description: 'Gagal Menghapus Data Otoritas.'
                }, {
                    type: 'danger',
                    showIcon: 'true',
                    transition: 'zoom',
                }
            )
        }
    })
}

watch(() => cloneDeep(data.params), debounce(() => {
    let param = pickBy(data.params)
    router.get('/apps/roles', param, {
        replace: true,
        preserveState: true,
        preserveScroll: true
    })
}, 150)
);

</script>

<style>
.btn-mr {
    margin-right: 5px;
}

td.r_atas {
    vertical-align: top;
}
</style>
