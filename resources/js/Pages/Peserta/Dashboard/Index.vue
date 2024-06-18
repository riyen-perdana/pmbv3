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

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import LayoutApp from '@/Layouts/App.vue';
import Tilebox from '@/Components/Tilebox.vue';
import Titlebox from '@/Components/Titlebox.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';

defineOptions({ layout: LayoutApp });

const breadcrumbs = computed(() => {
    return [
        {
            label: 'Peserta',
            isActive: false,
        },
        {
            label: 'Dashboard',
            url: 'dashboard'
        }
    ]
});
</script>

<style>
.btn-mr {
    margin-right: 5px;
}

td.r_atas {
    vertical-align: top;
}
</style>
