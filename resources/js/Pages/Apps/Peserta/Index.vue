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
                                <Titlebox :isDashboard="false" title="Data Peserta"
                                    subTitle="Data Peserta Undangan Mandiri UIN SUSKA Riau" />
                            </div>
                            <Breadcrumb :items="breadcrumbs" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <Tilebox title="Jumlah Pendaftar" :jumlah="peserta_daftar_count" satuan="Orang" uri=""
                                uri_title="Total Jumlah Pendaftar" color="text-success" icon="bx bxs-user-account"
                                colorSpan="bg-soft-success" />
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <Tilebox title="Pradaftar" :jumlah="peserta_daftar_pradaftar" satuan="Orang" uri=""
                                uri_title="Total Jumlah Pradaftar" color="text-warning" icon="bx bxs-user-pin"
                                colorSpan="bg-soft-warning" />
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <Tilebox title="Jumlah Peserta Bayar" :jumlah="peserta_daftar_bayar" satuan="Orang" uri=""
                                uri_title="Total Jumlah Peserta Membayar" color="text-danger" icon="bx bx-dollar-circle"
                                colorSpan="bg-soft-danger" />
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <Tilebox title="Jumlah Sudah Verifikasi" :jumlah="peserta_daftar_verifikasi" satuan="Orang"
                                uri="" uri_title="Total Jumlah Peserta Verifikasi" color="text-primary"
                                icon="bx bx-bookmark-alt" colorSpan="bg-soft-primary" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card" id="t_peserta">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="search-box">
                                                <input type="text" class="form-control search bg-light"
                                                    placeholder="Cari Data NISN dan NAMA PESERTA"
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
                                                <table class="table table-hover align-middle table-nowrap mb-0"
                                                    id="pesertaTable">
                                                    <thead class="table-light border-white">
                                                        <tr>
                                                            <th scope="col" style="width:4%;">No.</th>
                                                            <th scope="col" style="width:15%;">Identitas Peserta</th>
                                                            <th scope="col" style="width:15%;">Identitas Sekolah</th>
                                                            <th scope="col" style="width:15%;">Pilihan</th>
                                                            <th scope="col" style="width:15%;">Status</th>
                                                            <th scope="col" style="width:14%;">AKSI</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(psr, index) in props.peserta.data" :key="index">
                                                            <td class="r_atas">{{ (peserta.current_page - 1) *
                                                                peserta.per_page + index + 1 }}.</td>
                                                            <td class="r_atas">
                                                                <div class="d-flex flex-row">
                                                                    <div v-if="psr.foto_siswa">
                                                                        <div class="align-items-start px-2">
                                                                            <img :src="`/storage/fotopeserta/${psr.foto_siswa}`"
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
                                                                                {{ psr.nisn_siswa }}</div>
                                                                        </div>
                                                                        <div class="d-flex flex-row">
                                                                            <div class="d-flex justify-content-start">
                                                                                Nama</div>
                                                                            <div
                                                                                class="d-flex justify-content-end w-100 fst-italic">
                                                                                {{ psr.nm_siswa ? psr.nm_siswa : '-' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex flex-row">
                                                                            <div class="d-flex justify-content-start">
                                                                                NIK</div>
                                                                            <div
                                                                                class="d-flex justify-content-end w-100 fst-italic">
                                                                                {{ psr.nik_siswa ? psr.nik_siswa : '-'
                                                                                }}</div>
                                                                        </div>
                                                                        <div class="d-flex flex-row">
                                                                            <div class="d-flex justify-content-start">
                                                                                Kode Bayar</div>
                                                                            <div
                                                                                class="d-flex justify-content-end w-100 fst-italic">
                                                                                {{ psr.pin }}</div>
                                                                        </div>
                                                                        <div class="d-flex flex-row">
                                                                            <div class="d-flex justify-content-start">
                                                                                Kata Kunci</div>
                                                                            <div
                                                                                class="d-flex justify-content-end w-100 fst-italic">
                                                                                {{ psr.first_password }}</div>
                                                                        </div>
                                                                        <div class="d-flex flex-row">
                                                                            <div class="d-flex justify-content-start">
                                                                                Telepon/HP</div>
                                                                            <div
                                                                                class="d-flex justify-content-end w-100 fst-italic">
                                                                                {{ psr.notlpn_siswa }}</div>
                                                                        </div>
                                                                        <div class="d-flex flex-row">
                                                                            <div class="d-flex justify-content-start">
                                                                                Nomor Pendaftaran</div>
                                                                            <div
                                                                                class="d-flex justify-content-end w-100 fst-italic fw-semibold">
                                                                                {{ psr.nomor ? psr.nomor : '-' }}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="r_atas">
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">NPSN</div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ psr.sekolah?.id ? psr.sekolah?.id : '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Sekolah
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ psr.sekolah?.nama ? psr.sekolah?.nama : '-'
                                                                        }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Kecamatan
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ psr.sekolah?.kecamatan.nm_kecamatan ?
                                                                        psr.sekolah?.kecamatan.nm_kecamatan : '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Kab/Kota
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ psr.sekolah?.kecamatan.kabkot.nm_kabkot ?
                                                                        psr.sekolah?.kecamatan.kabkot.nm_kabkot : '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Propinsi
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{
                                                                            psr.sekolah?.kecamatan.kabkot.provinsi.nm_provinsi
                                                                        ?
                                                                        psr.sekolah?.kecamatan.kabkot.provinsi.nm_provinsi
                                                                        : '-' }}
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="r_atas">
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Pilihan 1
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ psr.pil_1?.nm_prodi ? psr.pil_1?.nm_prodi :
                                                                        '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Pilihan 2
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ psr.pil_2?.nm_prodi ? psr.pil_2?.nm_prodi :
                                                                        '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Pilihan 3
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ psr.pil_3?.nm_prodi ? psr.pil_3?.nm_prodi :
                                                                        '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Pilihan 4
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-end w-100 fst-italic">
                                                                        {{ psr.pil_4?.nm_prodi ? psr.pil_4?.nm_prodi :
                                                                        '-' }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="r_atas">
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Status
                                                                        Bayar</div>
                                                                    <div class="d-flex justify-content-end w-100 fst-italic fw-semibold"
                                                                        :class="psr.is_bayar === '1' ? 'text-success' : 'text-danger'">
                                                                        {{ psr.is_bayar === '1' ? 'Sudah' : 'Belum' }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Verifikasi
                                                                        Peserta</div>
                                                                    <div class="d-flex justify-content-end w-100 fst-italic fw-semibold"
                                                                        :class="psr.is_vrf_siswa === 'Y' ? 'text-success' : 'text-danger'">
                                                                        {{ psr.is_vrf_siswa === 'Y' ? 'Sudah' : 'Belum'
                                                                        }}
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex flex-row w-100">
                                                                    <div class="d-flex justify-content-start">Verifikasi
                                                                        Operator</div>
                                                                    <div class="d-flex justify-content-end w-100 fst-italic fw-semibold"
                                                                        :class="psr.is_vrf_op === 'Y' ? 'text-success' : 'text-danger'">
                                                                        {{ psr.is_vrf_op === 'Y' ? 'Sudah' : 'Belum' }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="r_atas">
                                                                <div class="hstack gap-2 flex-wrap">
                                                                    <!-- Buttons Group -->
                                                                    <button type="button"
                                                                        class="btn btn-secondary btn-sm"
                                                                        @click="clickButton(psr.id, psr)"
                                                                        :disabled="psr.is_vrf_siswa === 'N'"><i
                                                                            class="ri-edit-2-line label-icon align-middle fs-10 me-1"></i>
                                                                        Verifikasi&nbsp;&nbsp;&nbsp;</button>
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        @click="destroy(psr.id)"><i
                                                                            class="ri-delete-bin-2-line label-icon align-middle fs-10 me-1"></i>
                                                                        Hapus</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- {{ peserta }} -->
                                                    </tbody>
                                                </table>
                                                <Emptytable :data="props.peserta" />
                                            </div>
                                            <div v-if="peserta.data.length != 0">
                                                <Pagination :links="peserta.links" :count="peserta" :perPage="props.perPage" />
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
    <RightBar :show="data.openDetail" @close-canvas="closeCanvas" :peserta="data.dataPeserta" :id="data.id" :inkel="inkel" :bidang="bidang" :tingkat="tingkat" />
    <Alert :show="data.openAlert" :id="data.id" @close-alert="closeAlert" @delete-data="deletePeserta" />
</template>

<script setup>
import { Head, router } from "@inertiajs/vue3";
import { computed, reactive, watch, onMounted } from "vue";
import Titlebox from "@/Components/Titlebox.vue";
import Tilebox from '@/Components/Tilebox.vue';
import Breadcrumb from "@/Components/Breadcrumb.vue";
import LayoutApp from "@/Layouts/App.vue";
import Pagination from "@/Components/Pagination.vue";
import Emptytable from "@/Components/Emptytable.vue";
import { cloneDeep, debounce, pickBy } from "lodash";
import Alert from '@/Components/Alert.vue';
import RightBar from "@/Components/right-bar.vue";

defineOptions({ layout: LayoutApp });

const props = defineProps({
    peserta_daftar_count: Number,
    peserta_daftar_pradaftar: Number,
    peserta_daftar_bayar: Number,
    peserta_daftar_verifikasi: Number,
    perPage: Number,
    peserta: Object,
    inkel: Object,
    bidang: Object,
    tingkat: Object,
})

const data = reactive({
    params: {
        search: props.filters?.search,
        perPage: props.perPage
    },
    openAlert: false,
    openDetail: false,
    id: '',
    dataPeserta: {},
});

const closeAlert = () => {
    data.openAlert = !data.openAlert
    data.id = ''
};

const destroy = (id) => {
    data.openAlert = true
    data.id = id
}

const deletePeserta = (id) => {
    router.delete(`/apps/peserta/${id}`,
        {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeAlert
                createToast(
                    {
                        title: 'Berhasil',
                        description: 'Data Peserta Berhasil Dihapus.'
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
                        description: 'Gagal Menghapus Data Peserta.'
                    }, {
                    type: 'danger',
                    showIcon: 'true',
                    transition: 'zoom',
                }
                )
            }
        })
}

const breadcrumbs = computed(() => {
    return [
        {
            label: 'Peserta',
            isActive: false,
        },
        {
            label: 'Undangan Mandiri',
            url: 'peserta'
        }
    ]
});

const clickButton = (id, psr) => {
    data.openDetail = !data.openDetail
    data.id = id,
    data.dataPeserta = psr
}

const closeCanvas = () => {
    data.openDetail = !data.openDetail
    data.id = ''
    data.dataPeserta = {}
}

watch(() => cloneDeep(data.params), debounce(() => {
    let param = pickBy(data.params)
    router.get('/apps/peserta', param, {
        replace: true,
        preserveState: true,
        preserveScroll: true
    })
}, 150));

</script>

<style>
.btn-mr {
    margin-right: 5px;
}

td.r_atas {
    vertical-align: top;
}
</style>
