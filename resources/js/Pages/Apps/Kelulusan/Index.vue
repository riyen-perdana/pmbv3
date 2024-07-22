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
                                <Titlebox :isDashboard="false"
                                    title="Data Peserta Jalur Undangan Mandiri UIN SUSKA Riau"
                                    subTitle="Manajemen Data Peserta Jalur Undangan Mandiri UIN SUSKA Riau" />
                                <p class="text-muted mb-0 fw-semibold">Program Studi {{ prodi.nm_prodi }}</p>
                            </div>
                            <Breadcrumb :items="breadcrumbs" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <Tilebox title="Peserta Pilihan 1" :jumlah="pil_1" satuan="Orang" color="text-success"
                                icon="bx bxs-user-account" colorSpan="bg-soft-success" uri="" />
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <Tilebox title="Peserta Pilihan 2" :jumlah="pil_2" satuan="Orang" color="text-success"
                                icon="bx bxs-user-account" colorSpan="bg-soft-success" uri="" />
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <Tilebox title="Peserta Pilihan 3" :jumlah="pil_3" satuan="Orang" color="text-success"
                                icon="bx bxs-user-account" colorSpan="bg-soft-success" uri="" />
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <Tilebox title="Peserta Pilihan 4" :jumlah="pil_4" satuan="Orang" color="text-success"
                                icon="bx bxs-user-account" colorSpan="bg-soft-success" uri="" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card" id="t_nilai">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1"></h5>
                                        <div class="flex-shrink-0 me-2">
                                            <div v-if="props.prodi.is_valid == 'N'">
                                                <button type="button" class="btn btn-success add-btn"
                                                    @click="finalisasi(prodi.id)">
                                                    <i class="ri-check-double-line align-bottom me-1"></i>Finalisasi
                                                    Data {{ prodi.nm_prodi }}
                                                </button>
                                            </div>
                                            <div v-else>
                                                <button type="button" class="btn btn-danger add-btn"
                                                    @click="finalisasi(prodi.id)">
                                                    <i class="ri-close-circle-fill align-bottom me-1"></i>Batalkan Finalisasi
                                                    Data {{ prodi.nm_prodi }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <select class="form-select" aria-label="Default select example"
                                                v-model="data.params.pilihan">
                                                <option value="pil_1">Pilihan 1</option>
                                                <option value="pil_2">Pilihan 2</option>
                                                <option value="pil_3">Pilihan 3</option>
                                                <option value="pil_4">Pilihan 4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body doted">
                                    <div class="row">
                                        <div class="live-preview">
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="button" class="btn btn-primary">
                                                    Kuota Program Studi <span class="badge bg-success ms-1">{{
                                                        props.prodi.quota }}</span>
                                                </button>
                                                <button type="button" class="btn btn-secondary">
                                                    Program Studi Terisi <span class="badge bg-danger ms-1">{{
                                                        props.lulus }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive table-card mb-3 mt-3">
                                                <table class="table table-hover align-middle table-nowrap mb-0"
                                                    id="penggunaTable">
                                                    <thead class="table-light boder-white">
                                                        <tr>
                                                            <th scope="col" style="width:2%;">No.</th>
                                                            <th scope="col" style="width:15%;">Identitas Peserta</th>
                                                            <th scope="col" style="width:15%;">Identitas Sekolah</th>
                                                            <th scope="col" style="width:5%;" class="text-center">Nilai
                                                                Raport</th>
                                                            <th scope="col" style="width:5%;" class="text-center">Nilai
                                                                Prestasi</th>
                                                            <th scope="col" style="width:5%;" class="text-center">Total
                                                                Nilai</th>
                                                            <th scope="col" style="width:15%;" class="text-center">
                                                                Status</th>
                                                            <th scope="col" style="width:10%;" class="text-center">AKSI
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(n, index) in props.nilai" :key="index">
                                                            <td class="r_atas">{{ index + 1 }}.</td>
                                                            <td class="r_atas">
                                                                <div class="d-flex flex-row">
                                                                    <div v-if="n.peserta.foto_siswa">
                                                                        <div class="align-items-start px-2">
                                                                            <img :src="`/storage/fotopeserta/${n.peserta.foto_siswa}`"
                                                                                class="rounded-circle header-profile-user" />
                                                                        </div>
                                                                    </div>
                                                                    <div v-else>
                                                                        <div class="align-items-start px-2">
                                                                            <img class="rounded-circle header-profile-user"
                                                                                :src="`https://ui-avatars.com/api/?name=PESERTA&amp;background=4e73df&amp;color=ffffff&amp;`" />

                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex flex-column px-2 w-100">
                                                                        <div class="d-flex flex-row">
                                                                            <div class="d-flex justify-content-start">
                                                                                NISN</div>
                                                                            <div
                                                                                class="d-flex justify-content-end w-100 fst-italic">
                                                                                {{ n.peserta.nisn_siswa }}</div>
                                                                        </div>
                                                                        <div class="d-flex flex-row">
                                                                            <div class="d-flex justify-content-start">
                                                                                Nama</div>
                                                                            <div
                                                                                class="d-flex justify-content-end w-100 fst-italic">
                                                                                {{ n.peserta.nm_siswa ?
                                                                                    n.peserta.nm_siswa : '-' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-row">
                                                                            <div class="d-flex justify-content-start">
                                                                                Nomor Pendaftaran</div>
                                                                            <div
                                                                                class="d-flex justify-content-end w-100 fst-italic fw-semibold">
                                                                                {{ n.peserta.nomor ? n.peserta.nomor :
                                                                                    '-' }}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="r_atas">
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">NPSN</div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ n.peserta.sekolah?.id ? n.peserta.sekolah?.id
                                                                            : '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Sekolah
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ n.peserta.sekolah?.nama ?
                                                                            n.peserta.sekolah?.nama : '-'
                                                                        }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Kecamatan
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ n.peserta.sekolah?.kecamatan.nm_kecamatan ?
                                                                            n.peserta.sekolah?.kecamatan.nm_kecamatan : '-'
                                                                        }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Kab/Kota
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ n.peserta.sekolah?.kecamatan.kabkot.nm_kabkot
                                                                            ?
                                                                            n.peserta.sekolah?.kecamatan.kabkot.nm_kabkot :
                                                                            '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Propinsi
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{
                                                                            n.peserta.sekolah?.kecamatan.kabkot.provinsi.nm_provinsi
                                                                                ?
                                                                                n.peserta.sekolah?.kecamatan.kabkot.provinsi.nm_provinsi
                                                                                : '-' }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="r_atas text-center">{{ n.rapor }}</td>
                                                            <td class="r_atas text-center">{{ n.prestasi }}</td>
                                                            <td class="r_atas text-center">{{ n.total }}</td>
                                                            <td class="r_atas">
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Status
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic fw-semibold">
                                                                        {{ n.peserta.is_lulus ? 'LULUS' : 'BELUM ' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Prodi
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic fw-semibold">
                                                                        {{ n.peserta.prodills_siswa ?
                                                                            n.peserta.prodi.nm_prodi : '- ' }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="r_atas text-center">
                                                                <div v-if="n.peserta.is_lulus == 'Y'">
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        @click="cancel_lls(n.peserta.id)" :disabled="prodi.is_valid == 'Y' ? true : false"><i
                                                                            class="ri-edit-2-line label-icon align-middle fs-10 me-1"></i>
                                                                        Batalkan&nbsp;&nbsp;&nbsp;</button>
                                                                </div>
                                                                <div v-else>
                                                                    <button type="button" class="btn btn-primary btn-sm"
                                                                        @click="click_lls(n.peserta.id)" :disabled="prodi.is_valid == 'Y' ? true : false"><i
                                                                            class="ri-edit-2-line label-icon align-middle fs-10 me-1" ></i>
                                                                        Luluskan&nbsp;&nbsp;&nbsp;</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
import Form from "@/Pages/Apps/Fakultas/Form.vue";
import Alert from "@/Components/Alert.vue";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import Tilebox from '@/Components/Tilebox.vue';

defineOptions({ layout: LayoutApp });

const props = defineProps({
    prodi: Object,
    pil_1: Number,
    pil_2: Number,
    pil_3: Number,
    pil_4: Number,
    nilai: Object,
    lulus: Number,
    pilihan: String
});

const data = reactive({
    params: {
        pilihan: props.pilihan
    }
});

const breadcrumbs = computed(() => {
    return [
        {
            label: 'Kelulusan',
            isActive: false,
        },
        {
            label: props.prodi.nm_prodi,
            url: props.prodi.id
        }
    ]
});

const click_lls = (id) => {
    if (props.prodi.quota > props.lulus) {
        router.post(`/apps/dekan/prodi/lulus/${id}`, {
            prodi: props.prodi.id
        }, {
            preserveScroll: true,
            preserveState: true,
            onError: () => {
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
    } else {
        createToast(
            {
                title: 'Error',
                description: 'Jumlah Quota Prodi Sudah Terpenuhi.'
            }, {
            type: 'danger',
            showIcon: 'true',
            transition: 'zoom',
        }
        )
    }
}

const cancel_lls = (id) => {
    router.post(`/apps/dekan/prodi/batal/${id}`, {
        prodi: props.prodi.id
    }, {
        preserveScroll: true,
        preserveState: true,
        onError: () => {
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

watch(() => cloneDeep(data.params), debounce(() => {
    let param = pickBy(data.params)
    router.get(`/apps/dekan/prodi/${props.prodi.id}`, param, {
        replace: true,
        preserveState: true,
        preserveScroll: true
    })
}, 150));

const finalisasi = (id) => {
    router.post(`/apps/dekan/prodi/finalisasi/${id}`, {
        prodi: props.prodi.id
    }, {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            createToast(
                {
                    title: 'Berhasil',
                    description: 'Proses Berhasil.'
                }, {
                type: 'success',
                showIcon: 'true',
                transition: 'zoom',
            }
            )
        },
        onError: () => {
            createToast(
                {
                    title: 'Error',
                    description: 'Finalisasi Data Prodi Gagal.'
                }, {
                    type: 'danger',
                    showIcon: 'true',
                    transition: 'zoom',
            }
            )
        }
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
