<template>
    <Modal id="mPrestasi" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Prestasi Akademik dan Non Akademik</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-12 col-lg-12 mb-3">
                        <label for="txtNmPrestasi" class="form-label">Nama Prestasi</label>
                        <input v-model="form.txtNmPrestasi" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNmPrestasi }" type="text"
                            placeholder="Nama Prestasi Diraih">
                        <div v-if="$page.props.errors.txtNmPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.txtNmPrestasi }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <label for="cboKelompokPrestasi" class="form-label">Kelompok Prestasi</label>
                        <select v-model="form.cboKelompokPrestasi" class="form-select" :class="{ 'is-invalid': $page.props.errors.cboKelompokPrestasi }">
                            <option disabled value="">Pilih Kelompok Prestasi</option>
                            <option v-for="(kel, index) in props.inkel" :key="index" :value="kel.id">
                                {{ kel.nama }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboKelompokPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.cboKelompokPrestasi }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <label for="cboBidangPrestasi" class="form-label">Bidang Prestasi</label>
                        <select v-model="form.cboBidangPrestasi" class="form-select" :class="{ 'is-invalid': $page.props.errors.cboBidangPrestasi }">
                            <option disabled value="">Pilih Bidang Prestasi</option>
                            <option v-for="(bdg, index) in props.bidang" :key="index" :value="bdg.id">
                                {{ bdg.nama }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboBidangPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.cboBidangPrestasi }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <label for="cboTingkatPrestasi" class="form-label">Tingkat Prestasi</label>
                        <select v-model="form.cboTingkatPrestasi" class="form-select" :class="{ 'is-invalid': $page.props.errors.cboTingkatPrestasi }">
                            <option disabled value="">Pilih Tingkat Prestasi</option>
                            <option v-for="(tk, index) in props.tingkat" :key="index" :value="tk.id">
                                {{ tk.nama }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboBidangPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.cboBidangPrestasi }}
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 mb-3">
                        <label for="txtFile" class="form-label">File Bukti Prestasi (PDF Max. 2 MB)</label>
                        <input type="file" class="form-control" @input="form.txtFile = $event.target.files[0]" :class="{ 'is-invalid': $page.props.errors.txtFile }">
                        <div v-if="$page.props.errors.txtFile" class="invalid-feedback">
                            {{ $page.props.errors.txtFile }}
                        </div>
                    </div>
                </div>
            </form>
        </template>
        <template #modalFooter>
            <button type="button" class="btn btn-light" @click="closeModal()">Tutup</button>
            <button type="submit" @click="submitData" class="btn btn-primary" :disabled="btnDisabled">
                {{ props.isEdit == false ? "Simpan" : "Ubah" }}</button>
        </template>
    </Modal>
</template>

<script setup>
import { ref, onMounted, onUnmounted, watchEffect, Transition } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import Modal from "@/Components/Modal.vue";
import { useModal } from "@/Composables/useModal.js";

const emit = defineEmits(['close']);

const props = defineProps({
    tingkat : Object,
    bidang : Object,
    inkel: Object,
    show: Boolean,
    isEdit: Boolean,
    dataEdit: Object,
});

const form = useForm({
    txtNmPrestasi: '',
    cboKelompokPrestasi : '',
    cboBidangPrestasi : '',
    cboTingkatPrestasi : '',
    txtFile : ''
});

const modal = ref(null);
const btnDisabled = ref(false);

const closeModal = () => {
    modal.value.hide()
    emit('close')
    form.reset()
    form.txtFile = ''
    router.reload()
}

const openModal = () => {
    modal.value.show();
}

onMounted(() => {
    modal.value = useModal('#mPrestasi')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
    }
});

const submitData = () => {
    if (props.isEdit) {
        router.put(`/peserta/prestasi/${props.dataEdit.id}`, {
            txtNmPrestasi : form.txtNmPrestasi,
            cboKelompokPrestasi : form.cboKelompokPrestasi,
            cboBidangPrestasi : form.cboBidangPrestasi,
            cboTingkatPrestasi : form.cboTingkatPrestasi,
            txtFile : form.txtFile
         }, {
            preserveScroll : true,
            preserveState : true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Perubahan Data Prestasi Berhasil Dilakukan.'
                        }, {
                            type: 'success',
                            showIcon: 'true',
                        })

                },
         })
    } else {
        router.post('/peserta/prestasi', {
            txtNmPrestasi : form.txtNmPrestasi,
            cboKelompokPrestasi : form.cboKelompokPrestasi,
            cboBidangPrestasi : form.cboBidangPrestasi,
            cboTingkatPrestasi : form.cboTingkatPrestasi,
            txtFile : form.txtFile
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Menambahkan Data Prestasi Berhasil Dilakukan.'
                        }, {
                            type: 'success',
                            showIcon: 'true',
                            Transition: 'zoom',
                        })
                },
                onError: form.cancel(),
                onStart: () => btnDisabled.value = true,
                onFinish: () => btnDisabled.value = false
        })
    }
};

</script>
