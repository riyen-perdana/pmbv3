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
                                <Titlebox :isDashboard="true"
                                    subTitle="Dashboard E-Admisi Universitas Islam Negeri Sultan Syarif Kasim Riau" />
                            </div>
                            <Breadcrumb :items="breadcrumbs" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Profil Data Peserta dan Portofolio</h4>
                                </div><!-- end card header -->
                                <div class="card-body form-steps">
                                    <form class="vertical-navs-step">
                                        <div class="row gy-5">
                                            <div class="col-lg-3">
                                                <div class="pt-4 mb-4 mb-lg-2 pb-lg-2">
                                                    <div v-if="$page.props.auth.peserta?.foto_siswa">
                                                        <div class="row g-4">
                                                            <div class="foto-center">
                                                                <div class="mx-auto">
                                                                    <img
                                                                        :src="`/storage/fotopeserta/${$page.props.auth.peserta?.foto_siswa}`"
                                                                        alt="user-img"
                                                                        class="profil-peserta rounded-circle"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col text-center">
                                                            <div class="p-2">
                                                                <h5 class="mb-1">{{ $page.props.auth.peserta.nm_siswa }}</h5>
                                                                <p class="text-muted mb-0">{{ $page.props.auth.peserta.nisn_siswa }}</p>
                                                                <p class="text-muted mb-0">{{ $page.props.auth.peserta.nik_siswa }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="$page.props.auth.peserta?.is_vrf_siswa != 'Y'">
                                                    <div class="nav flex-column custom-nav nav-pills" role="tablist"
                                                        aria-orientation="vertical">
                                                        <button 
                                                            v-for="tab in tabsList" 
                                                            :key="tab.idx" 
                                                            id="v-{prv}" 
                                                            data-bs-toggle="pill" 
                                                            data-bs-target="#v-tab-{prv}"
                                                            type="button"
                                                            role="tab"
                                                            class="nav-link"
                                                            :class="{'active' : currentStep >= tab.idx }"
                                                            disabled>
                                                                <span class="step-title me-2">
                                                                    <i class="ri-close-circle-fill step-icon me-2"></i>
                                                                    {{ tab.name }}
                                                                </span>
                                                                {{ tab.title }}
                                                        </button>



                                                        <!-- <button class="nav-link active" id="v-data-pribadi"
                                                            data-bs-toggle="pill" data-bs-target="#v-tab-data-pribadi"
                                                            type="button" role="tab" aria-controls="v-tab-data-pribadi"
                                                            aria-selected="true" disabled>
                                                            <span class="step-title me-2">
                                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                                Langkah 1
                                                            </span>
                                                            Data Pribadi
                                                        </button>
                                                        <button class="nav-link" id="v-data-pilihan"
                                                            data-bs-toggle="pill" data-bs-target="#v-tab-data-pilihan"
                                                            type="button" role="tab" aria-controls="v-tab-data-pilihan"
                                                            aria-selected="false" disabled>
                                                            <span class="step-title me-2">
                                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                                Langkah 2
                                                            </span>
                                                            Data Pilihan Program Studi
                                                        </button>
                                                        <button class="nav-link" id="v-data-prestasi"
                                                            data-bs-toggle="pill" data-bs-target="#v-tab-data-prestasi"
                                                            type="button" role="tab" aria-controls="v-tab-data-prestasi"
                                                            aria-selected="false">
                                                            <span class="step-title me-2">
                                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                                Langkah 3
                                                            </span>
                                                            Data Prestasi Non Akademik
                                                        </button>
                                                        <button class="nav-link" id="v-data-rapor"
                                                            data-bs-toggle="pill" data-bs-target="#v-tab-data-rapor"
                                                            type="button" role="tab" aria-controls="v-tab-data-rapor"
                                                            aria-selected="false">
                                                            <span class="step-title me-2">
                                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                                Langkah 4
                                                            </span>
                                                            Nilai Rapor
                                                        </button>
                                                        <button class="nav-link" id="v-verifikasi"
                                                            data-bs-toggle="pill" data-bs-target="#v-tab-verifikasi"
                                                            type="button" role="tab" aria-controls="v-tab-verifikasi"
                                                            aria-selected="false">
                                                            <span class="step-title me-2">
                                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                                Langkah 5
                                                            </span>
                                                            Verifikasi Data
                                                        </button> -->
                                                    </div>
                                                </div>
                                                <!-- end nav -->
                                            </div> <!-- end col-->
                                            <div class="col-lg-9">
                                                <div class="px-lg-4">

                                                    <div v-if="$page.props.auth.peserta?.is_vrf_siswa != 'Y'">
                                                        <div class="tab-content">

                                                            <!-- Data Pribadi -->
                                                            <div v-show="currentStep === 0">
                                                                <Dapri 
                                                                    title="Data Pribadi" 
                                                                    :agama="agama" 
                                                                    :peserta="$page.props.auth.peserta"
                                                                    :provinsi="provinsi" 
                                                                    :sekolahData="sekolah"
                                                                    @stepComplete="advanceStep"
                                                                    :class="{'show active': currentStep === 1}"
                                                                    :id="`v-tab-${tabsList[0].prf}`"
                                                                    role="tabpanel"
                                                                    :aria-labelledby="`v-${tabsList[0].prf}`"
                                                                />
                                                            </div>

                                                            <!-- Data Pilihan -->
                                                            <div v-show="currentStep === 1">
                                                                <Pilihan 
                                                                    title="Pilihan Program Studi" 
                                                                    :peserta="$page.props.auth.peserta" 
                                                                    :prodi_12="props.prodi_12" 
                                                                    :prodi_34="props.prodi_34"
                                                                    @stepBack="decreaseTab"
                                                                    @stepComplete="advanceStep"
                                                                    :class="{'show active': currentStep === 1}"
                                                                    :id="`v-tab-${tabsList[1].prf}`"
                                                                    role="tabpanel"
                                                                    :aria-labelledby="`v-${tabsList[1].prf}`"
                                                                />
                                                            </div>

                                                            <!-- Data Prestasi Non Akademik -->
                                                            <div v-show="currentStep === 2">
                                                                <Prestasi
                                                                    title="Data Prestasi Non Akademik"
                                                                    :bidang="props.bidang"
                                                                    :inkel="props.inkel"
                                                                    :tingkat="props.tingkat"
                                                                    :prestasi="props.prestasi"
                                                                    @stepBack="decreaseTab"
                                                                    @stepComplete="advanceStep"
                                                                    :class="{'show active': currentStep === 2}"
                                                                    :id="`v-tab-${tabsList[2].prf}`"
                                                                    role="tabpanel"
                                                                    :aria-labelledby="`v-${tabsList[2].prf}`"
                                                                />
                                                            </div>

                                                            <!--Data Rapor-->
                                                            <div v-show="currentStep === 3">
                                                                <Rapor 
                                                                    title="Data Nilai Rapor" 
                                                                    :rapor="props.rapor"
                                                                    :class="{'show active': currentStep === 3}"
                                                                    :id="`v-tab-${tabsList[3].prf}`"
                                                                    role="tabpanel"
                                                                    :aria-labelledby="`v-${tabsList[3].prf}`"
                                                                    @stepBack="decreaseTab"
                                                                    @stepComplete="advanceStep"
                                                                />
                                                            </div>
                                                            <!--Verifikasi Data-->
                                                            <div v-show="currentStep === 4">
                                                                <Verifikasi 
                                                                    title="Verifikasi Data"
                                                                    :class="{'show active': currentStep === 4}"
                                                                    :id="`v-tab-${tabsList[4].prf}`"
                                                                    role="tabpanel"
                                                                    :aria-labelledby="`v-${tabsList[4].prf}`"
                                                                    @stepBack="decreaseTab"
                                                                />
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div v-else>
                                                        Terima Kasih Telah Melakukan Proses Pendaftaran Peserta Penerimaan Mahasiswa Baru Jalur Undangan Mandiri UIN SUSKA Riau TA. {{ tahun }}/{{ tahun + 1 }}, Untuk Unduh Kartu Peserta, Silahkan Klik Link Berikut : <br>
                                                        <a :href="`/peserta/cetak/pdf/${page.props.auth.peserta.id}`" class="btn btn-primary mt-2" target="_blank">
                                                            <i class="ri-printer-line label-icon align-middle fs-16 me-2"></i>
                                                            Unduh Kartu Peserta
                                                        </a>
                                                    </div>
                                                    <!-- end tab content -->
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </form>
                                </div>
                            </div>
                            <!-- end -->
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed, onMounted, watch, ref } from 'vue';
import LayoutApp from '@/Layouts/App.vue';
import Tilebox from '@/Components/Tilebox.vue';
import Titlebox from '@/Components/Titlebox.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Dapri from '@/Components/Portofolio/Dapri.vue';
import Pilihan from '@/Components/Portofolio/Pilihan.vue';
import Prestasi from '@/Components/Portofolio/Prestasi.vue';
import Rapor from '@/Components/Portofolio/Rapor.vue';
import Verifikasi from '@/Components/Portofolio/Verifikasi.vue';

defineOptions({ layout: LayoutApp });

const tabsList = ref(
    [
        {
            'name' : 'Langkah 1',
            'title' : 'Data Pribadi',
            'prf' : 'data-pribadi',
            'idx' : 0
        },
        {
            'name' : 'Langkah 2',
            'title' : 'Pilihan Program Studi',
            'prf' : 'data-pilihan',
            'idx' : 1
        },
        {
            'name' : 'Langkah 3',
            'title' : 'Data Prestasi Non Akademik',
            'prf' : 'data-prestasi',
            'idx' : 2
        },
        {
            'name' : 'Langkah 4',
            'title' : 'Data Nilai Rapor',
            'prf' : 'data-rapor',
            'idx' : 3
        },
        {
            'name' : 'Langkah 5',
            'title' : 'Verifikasi Data',
            'prf' : 'verifikasi',
            'idx' : 4
        }
    ]
);

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

const page = usePage();

const props = defineProps({
    provinsi: Object,
    agama: Object,
    peserta: Object,
    sekolah: Object,
    prodi_12: Object,
    prodi_34: Object,
    bidang: Object,
    tingkat: Object,
    inkel : Object,
    prestasi : Object,
    rapor: Object,
    step: Object
});

// Use the step prop to initialize the current step
const isStep = ref(props.step.step);
const currentStep = computed({
    get() {
        return isStep.value;
    },
    set(value) {
        return isStep.value = value;
    }
});

// Function to advance the step
const advanceStep = () => {
    if (currentStep.value < tabsList.value.length) {
        currentStep.value++;
    }
};

const decreaseTab = () => {
    if (currentStep.value < tabsList.value.length) {
        currentStep.value--;
    }
};

// Function to activate a specific tab
const activateTab = (tabId) => {
    // This is for programmatically activating the tab content
    // Find the button for the target tab and trigger a click
    // Note: This relies on Bootstrap's JS. A more Vue-idiomatic way is to use v-model or similar.
    const targetTabButton = document.querySelector(`[data-bs-target="#v-tab-${tabId}"]`);
    if (targetTabButton) {
        new bootstrap.Tab(targetTabButton).show();
    }
};

// Watch for changes in currentStep to automatically activate the next tab
watch(currentStep, (newValue) => {
    console.log(newValue)
    if (newValue <= tabsList.value.length) {
        const nextTabPrf = tabsList.value[newValue].prf;
        activateTab(nextTabPrf);
    }
});

// On mount, activate the initial tab based on currentStep
onMounted(() => {
    if (currentStep.value > 0) {
        const initialTabPrf = tabsList.value[currentStep.value - 1].prf;
        activateTab(initialTabPrf);
    }
});

const tahun = computed(() => {
    return new Date().getFullYear()
})


</script>

<style>
.btn-mr {
    margin-right: 5px;
}

td.r_atas {
    vertical-align: top;
}

.card-header {
    border-bottom: 1px solid #e9ebec;
}

.profil-peserta {
    height: 100px;
    width: 100px;
}

.foto-center {
    text-align: center !important;
}
</style>
