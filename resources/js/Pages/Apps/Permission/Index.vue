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
                                <Titlebox
                                    :isDashboard=false
                                    title="Data Permissions"
                                    subTitle="Manajemen Data Permissions Aplikasi E-Admisi"
                                />
                            </div>
                            <Breadcrumb :items="breadcrumbs" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card" id="t_permissions">
                                <div class="card-header">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="search-box">
                                                <input type="text" class="form-control search bg-light" placeholder="Cari Data" v-model="data.params.search">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-auto ms-auto">
                                            <div class="d-flex flex-row align-items-center gap-2">
                                                <select class="form-select mb-3" aria-label="Default select example" v-model="data.params.perPage">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                                <span class="text-muted text-show">Entries</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive table-card mb-3">
                                            <table class="table table-hover align-middle table-nowrap mb-0" id="permissionsTable">
                                                <thead class="table-light boder-white">
                                                    <tr>
                                                        <th scope="col" style="width:50px;">No.</th>
                                                        <th class="sort" data-sort="name" scope="col">Permission</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    <tr v-for="(permission,index) in permissions.data" :key="index">
                                                        <td class="number">{{ (permissions.current_page - 1) * permissions.per_page + index + 1 }}.</td>
                                                        <td class="name">{{ permission.name }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <Emptytable :data="permissions" />
                                        </div>
                                        <div v-if="permissions.data.length !=0">
                                            <Pagination :links="permissions.links" :count="permissions"/>
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
</template>

<script>
import { watch, reactive } from "vue";
import { Head, router } from "@inertiajs/vue3";
import LayoutApp from "@/Layouts/App.vue";
import Tilebox from "@/Components/Tilebox.vue";
import Titlebox from "@/Components/Titlebox.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Pagination from "@/Components/Pagination.vue";
import Emptytable from "@/Components/Emptytable.vue";
import { cloneDeep, debounce, pickBy } from "lodash";

export default {
    //Layoutt
    name : 'Permissions',
    layout: LayoutApp,
    components: {
    Head,
    Tilebox,
    Titlebox,
    Breadcrumb,
    Pagination,
    Emptytable
},
    computed : {
        breadcrumbs() {
            return [
                {
                    label : 'Authentikasi',
                    isActive : false,
                },
                {
                    label : 'Permissions',
                    url : 'permissions',
                    isActive : true
                }
            ]
        }
    },
    props : {
        permissions : Object,
        filters : Object,
        perPage : Number
    },

    setup(props) {

        //const perPage = ref(10);

        const data = reactive({
            params : {
                search  : props.filters.search,
                perPage : props.perPage
            }
        })

        watch(()=> cloneDeep(data.params),debounce(()=> {
            let param = pickBy(data.params)
                router.get('/apps/permissions',param, {
                    replace:true,
                    preserveState:true,
                    preserveScroll:true
                })
            },150)
        )

        // return { search, defaultOptions, perPage, data }
        return { data }

    }
};
</script>

<style>
    tr {
        border-color: #e9ebec !important;
    }

    .text-show {
        margin-top: -16px !important;
    }
</style>
