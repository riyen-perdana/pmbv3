<template>
    <div class="tab-pane fade" id="v-tab-data-prestasi" role="tabpanel" aria-labelledby="v-tab-data-prestasi">
        <div>
            <h5>{{ props.title }}</h5>
            <p class="text-muted">Mohon Lengkapi Data Berikut, Dan Pastikan Data Yang Anda Masukkan Benar</p>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1"></h5>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-success add-btn mx-2" @click="clickButton(data.id)">
                            <i class="ri-add-line align-bottom me-1"></i>Tambah Data
                        </button>
                    </div>
                </div>
                <div class="row">
                    <p class="text-muted mb-0 mt-4">Jika ada kesalahan dalam proses input data, silahkan hapus baris data yang salah, kemudian tambahkan kembali</p>
                </div>
                <div class="row">
                    <div>
                        <div class="table-responsive table-card mb-3 mt-3">
                            <table class="table table-hover align-middle table-nowrap mb-0" id="PrestasiTable">
                                <thead class="table-light boder-white">
                                    <tr>
                                        <th scope="col" style="width:50%;">Nama Prestasi</th>
                                        <th scope="col" style="width:15%;">Kelompok/Bidang/Kategori</th>
                                        <th scope="col" style="width:20%;">Bukti Prestasi</th>
                                        <th scope="col" style="width:14%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(prs, index) in props.prestasi" :key="index" :value="prs.id">
                                        <td class="r_atas">{{ prs.nm_prestasi }}</td>
                                        <td class="r_atas text-center">
                                            <b>{{ prs.inkel.nama }}</b><br>
                                            <b>{{ prs.bidang.nama }}</b><br>
                                            <b>{{ prs.tingkat.nama }}</b><br>
                                        </td>
                                        <td class="r_atas">Link</td>
                                        <td class="r_atas">
                                            <div class="hstack gap-2 flex-wrap">
                                                <!-- Buttons Group -->
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    @click="destroy(prs.id)"><i
                                                        class="ri-delete-bin-2-line label-icon align-middle fs-10 me-1"></i>
                                                    Hapus</button>
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
    <Form :show="data.createOpen" :bidang="props.bidang" :tingkat="props.tingkat" :inkel="props.inkel"
        :isEdit="data.isEdit" :dataEdit="data.dataEdit" @close="closeModal" />
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import Form from "@/Pages/Peserta/Dashboard/Form.vue";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';

const data = reactive({
    createOpen: false,
    isEdit: false,
    openAlert: false,
    dataEdit: {},
    id: ''
});

const props = defineProps({
    title: String,
    bidang: Object,
    inkel: Object,
    tingkat: Object,
    prestasi: Object,
});

const clickButton = (id, prestasi) => {
    data.id = id
    if (id == '') {
        data.isEdit = false
    } else {
        data.isEdit = true
        data.dataEdit = prestasi;
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
    // data.openAlert = true
    // data.id = id
    router.delete(`/peserta/prestasi/${id}`,{
        preserveState: true,
        preserveScroll: true,
        onSuccess : () => {
            createToast(
                {
                    title: 'Berhasil',
                    description: 'Data Prestasi Berhasil Dihapus.'
                }, {
                    type: 'success',
                    showIcon: true,
                    transition: 'zoom',
                }
            )
        },
        onError : () => {
            createToast(
                {
                    title: 'Error',
                    description: 'Gagal Menghapus Data Prestasi.'
                }, {
                    type: 'danger',
                    showIcon: 'true',
                    transition: 'zoom',
                }
            )
        }
    })
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
