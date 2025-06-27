<template>
    <Modal id="mRapor" size="modal-lg" @close="closeModal">
        <template #modalTitle>Tambah Data Rapor Peserta </template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-12 col-lg-12 mb-3">
                        <label for="txtNmtk" class="form-label">Rata Rata Nilai Matematika</label>
                        <p class="text-success mb-1 mt-n2 fst-italic">Jumlah Nilai Bidang Studi Matematika Tiap Semester Sampai
                            Kelas XII Semester 1 dibagi 5</p>
                        <input v-model="form.txtNmtk" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNmtk }" type="text"
                            placeholder="Rata Rata Nilai Matematika [Contoh : 82.5]">
                        <div v-if="$page.props.errors.txtNmtk" class="invalid-feedback">
                            {{ $page.props.errors.txtNmtk }}
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 mb-3">
                        <label for="txtPai" class="form-label">Rata Rata Nilai Pendidikan Agama Islam</label>
                        <p class="text-success mb-1 mt-n2 fst-italic">Jumlah Nilai Bidang Studi Pendidikan Agama Islam Tiap Semester Sampai
                            Kelas XII Semester 1 dibagi 5</p>
                        <input v-model="form.txtPai" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtPai }" type="text"
                            placeholder="Rata Rata Nilai Pendidikan Agama Islam [Contoh : 82.5]">
                        <div v-if="$page.props.errors.txtPai" class="invalid-feedback">
                            {{ $page.props.errors.txtPai }}
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 mb-3">
                        <label for="txtFile" class="form-label">File Bukti Prestasi (PDF Max. 2 MB)</label>
                        <p class="text-success mb-1 mt-n2 fst-italic">Scan Nilai Rapor Sampai Dengan Kelas XII Semester 1</p>
                        <input type="file" class="form-control" @input="form.txtFile = $event.target.files[0]"
                            :class="{ 'is-invalid': $page.props.errors.txtFile }">
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
                Simpan</button>
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
    show: Boolean,
    isEdit: Boolean,
    dataEdit: Object,
});

const form = useForm({
    txtNmtk: '',
    txtPai: '',
    txtFile: ''
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
    modal.value = useModal('#mRapor')
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
    router.post('/peserta/rapor', form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            closeModal(),
                createToast(
                    {
                        title: 'Berhasil',
                        description: 'Data Rapor Berhasil Ditambah.'
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


</script>
