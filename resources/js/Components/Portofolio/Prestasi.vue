<template>
    <div>
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
                    <p class="text-muted mb-0 mt-4">Jika ada kesalahan dalam proses input data, silahkan hapus baris
                            data yang salah, kemudian tambahkan kembali</p>
                </div>
                <div class="row">
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
                                    <td class="r_atas">
                                        <button 
                                            type="button" 
                                            class="btn btn-primary btn-sm" 
                                            @click="openViewFile(prs.file)">
                                            <i class="ri-download-2-line label-icon align-middle fs-10 me-2"></i>
                                            Lihat
                                        </button>
                                    </td>
                                    <td class="r_atas">
                                        <div class="hstack gap-2 flex-wrap">
                                            <!-- Buttons Group -->
                                            <button 
                                                type="button" 
                                                class="btn btn-danger btn-sm"
                                                @click="destroy(prs.id)">
                                                <i class="ri-delete-bin-2-line label-icon align-middle fs-10 me-1"></i>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="props.prestasi.length == 0">
                                    <td colspan="4" class="text-center">Data Prestasi Non Akademik Wajib Diisi</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-start gap-3 mt-4">
            <button
                @click="prevTab"
                type="button" 
                class="btn btn-light btn-label">
                <i class="ri-arrow-left-line label-icon align-middle fs-16 me-3"></i>
                <span style="margin-left: 25px;">Kembali Ke Langkah Sebelumnya</span>
            </button>
            <button
                :disabled="!btnNextActive"
                @click="submitDataPrestasi"
                type="button" 
                class="btn btn-success btn-label right ms-auto">
                <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>
                    Simpan dan Lanjutkan
            </button>
        </div>
        <ModalView :show="data.openView" :file="data.file" @close="closeModalView" />
        <Form :show="data.createOpen" :bidang="props.bidang" :tingkat="props.tingkat" :inkel="props.inkel"
        :isEdit="data.isEdit" :dataEdit="data.dataEdit" @close="closeModal" />
    </div>
</template>

<script setup>
import { ref, onMounted, reactive, computed } from 'vue';
import Form from "@/Pages/Peserta/Dashboard/Form.vue";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import ModalView from '../../Pages/Peserta/Dashboard/ModalView.vue';
import { usePage, router } from '@inertiajs/vue3';
import axios from 'axios';

const emit = defineEmits(['stepComplete', 'stepBack']);
const page = usePage();

const data = reactive({
    createOpen: false,
    isEdit: false,
    openView: false,
    dataEdit: {},
    file: ''
});

const props = defineProps({
    title: String,
    bidang: Object,
    inkel: Object,
    tingkat: Object,
    prestasi: Object,
});

const openViewFile = (file) => {
    data.openView = true
    data.file = file
}

const closeModalView = () => {
    data.openView = !data.openView
}

const prevTab = () => {
    emit('stepBack')
}

const btnNextActive = computed(() => {
    return props.prestasi.length > 0 ? true : false
})

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

const destroy = (id) => {
    // data.openAlert = true
    // data.id = id
    router.post(`/peserta/prestasi/${id}`, {
        preserveState: false,
        preserveScroll: false,
        onSuccess: () => {
            createToast(
                {
                    title: 'Berhasil Menghapus Data',
                    description: 'Data Prestasi Berhasil Dihapus.'
                }, {
                type: 'success',
                showIcon: true,
                transition: 'zoom',
            }
            )
        },
        onError: () => {
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

const submitDataPrestasi = () => {
    axios.post('/peserta/data-prestasi', {
        id : page.props.auth.peserta.id
    })
        .then(response => {
            if (response) {
                emit('stepComplete')
                createToast(
                    {
                        title: 'Berhasil Disimpan',
                        description: 'Data Prestasi Berhasil Disimpan.'
                    }, {
                    type: 'success',
                    showIcon: true,
                    transition: 'zoom',
                }
                )
            }
        }
    )
        .catch(error => {
            console.log(error);
    })
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
