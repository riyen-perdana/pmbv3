<template>
    <div class="tab-pane fade" id="v-tab-data-rapor" role="tabpanel" aria-labelledby="v-tab-data-rapor">
        <div>
            <h5>{{ props.title }}</h5>
            <p class="text-muted">Mohon Lengkapi Data Berikut, Dan Pastikan Data Yang Anda Masukkan Benar</p>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1"></h5>
                    <div class="flex-shrink-0">
                        <button :disabled="props.rapor.length != 0" type="button" class="btn btn-success add-btn mx-2"
                            @click="clickButton(data.id)">
                            <i class="ri-add-line align-bottom me-1"></i>Tambah Data
                        </button>
                    </div>
                </div>
                <div class="row">
                    <p class="text-success mb-0 mt-4">Nilai Matematika = Nilai Bidang Studi Matematika Tiap Semester
                        Sampai Kelas XII Semester 1 dibagi 5</p>
                    <p class="mb-0 text-success">Nilai Bahasa Inggris = Nilai Bidang Studi Bahasa Inggris Tiap Semester
                        Sampai Kelas XII Semester 1 dibagi 5</p>
                    <p class="mb-0 text-danger">Jika ada kesalahan dalam proses input data, silahkan hapus baris data
                        yang salah, kemudian tambahkan kembali</p>
                </div>
                <div class="row">
                    <div>
                        <div class="table-responsive table-card mb-3 mt-3">
                            <table class="table table-hover align-middle table-nowrap mb-0" id="PrestasiTable">
                                <thead class="table-light boder-white">
                                    <tr>
                                        <th scope="col" style="width:4%;">No.</th>
                                        <th scope="col" style="width:20%;">Rata Rata Nilai Matematika</th>
                                        <th scope="col" style="width:20%;">Rata Rata Nilai Pendidikan Agama Islam</th>
                                        <th scope="col" style="width:20%;">File</th>
                                        <th scope="col" style="width:14%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(rap, index) in props.rapor" :key="index" :value="rap.id">
                                        <td class="r_atas">{{ index + 1 }}</td>
                                        <td class="r_atas text-center">{{ rap.n_mtk }}</td>
                                        <td class="r_atas text-center">{{ rap.n_bing }}</td>
                                        <td class="r_atas"><button type="button" class="btn btn-primary btn-sm"
                                                @click="openViewFile(rap.file)"><i
                                                    class="ri-download-2-line label-icon align-middle fs-10 me-2"></i>Lihat</button>
                                        </td>
                                        <td class="r_atas">
                                            <div class="hstack gap-2 flex-wrap">
                                                <!-- Buttons Group -->
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    @click="destroy(rap.id)"><i
                                                        class="ri-delete-bin-2-line label-icon align-middle fs-10 me-1"></i>
                                                    Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="props.rapor.length == 0">
                                        <td colspan="4" class="text-center">Data Nilai Rapor Wajib Diisi</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <Emptytable :data="props.rapor" /> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-start gap-3 mt-4">
                <p class="text-danger">*Setelah Data Terisi Seluruhnya, Silahkan Tekan Tombol Langkah 5 Verifikasi Data Untuk Melanjutkan</p>
            </div>
        </div>
        <ModalViewRapor :show="data.openView" :file="data.file" @close="closeModalView" />
        <Rapor :show="data.createOpen" :isEdit="data.isEdit" :dataEdit="data.dataEdit" @close="closeModal" />
        <!-- <Form :show="data.createOpen" :isEdit="data.isEdit" :dataEdit="data.dataEdit" @close="closeModal" /> -->
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { reactive } from 'vue';
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import Rapor from "@/Pages/Peserta/Dashboard/Rapor.vue";
import ModalViewRapor from "@/Pages/Peserta/Dashboard/ModalViewRapor.vue";

const props = defineProps({
    title: String,
    rapor: Object,
});

const closeModalView = () => {
    data.openView = !data.openView
}

const openViewFile = (file) => {
    data.openView = true
    data.file = file
}

const data = reactive({
    createOpen: false,
    isEdit: false,
    openView: false,
    file : ''
});

const clickButton = (id, rapor) => {
    data.id = id
    if (id == '') {
        data.isEdit = false
    } else {
        data.isEdit = true
        data.dataEdit = rapor;
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
    router.post(`/peserta/rapor/${id}`, {
        preserveState: false,
        preserveScroll: true,
        onSuccess: () => {
            form.reset('file');
            createToast(
                {
                    title: 'Berhasil',
                    description: 'Data Rapor Berhasil Dihapus.'
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
                    description: 'Gagal Menghapus Data Rapor.'
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
