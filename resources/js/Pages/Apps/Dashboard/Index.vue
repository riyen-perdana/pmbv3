<template>
    <Head>
        <title>.:: E-admisi Universitas Islam Negeri Sultan Syarif Kasim Riau ::.</title>
    </Head>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="row mb-3 pb-1 p-3">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <Titlebox
                                    :isDashboard="true"
                                    subTitle="Dashboard E-Admisi Universitas Islam Negeri Sultan Syarif Kasim Riau"
                                />
                            </div>
                            <Breadcrumb :items="breadcrumbs" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <Tilebox title="Jumlah Pengguna" :jumlah="user_count" satuan="Orang" uri="/apps/pengguna" uri_title="Lihat Pengguna" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
import LayoutApp from '@/Layouts/App.vue';
import Tilebox from '@/Components/Tilebox.vue';
import Titlebox from '@/Components/Titlebox.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';

export default {
    //Layout
    layout : LayoutApp,
    components : {
    Head,
    Link,
    Tilebox,
    Titlebox,
    Breadcrumb
},
    props: {
        user_count : Number,
    },
    computed : {
        breadcrumbs() {
            return [
                {
                    label : 'Dashboard',
                    isActive : false,
                },
                {
                    label : 'E-Admisi',
                    url : 'dashboard'
                }
            ]
        }
    },

    setup() {

    }

}


</script>
