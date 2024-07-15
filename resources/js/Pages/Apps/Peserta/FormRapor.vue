<template>
    <Modal id="mRapor" size="modal-xl" @close="closeModal">
        <template #modalTitle>Ubah Data Rapor</template>
        <template #modalBody>
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <p class="text-primary fw-bold">Borang Data Rapor</p>
                    <hr>
                    <div class="mb-2">
                        <label for="txtNilaiPAI" class="form-label">Nilai Pendidikan Agama Islam</label>
                        <input v-model="form.txtNilaiPAI" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNilaiPAI }" type="text">
                        <div v-if="$page.props.errors.txtNilaiPAI" class="invalid-feedback">
                            {{ $page.props.errors.txtNilaiPAI }}
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="txtNilaiMTK" class="form-label">Nilai Matematika</label>
                        <input v-model="form.txtNilaiMTK" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNilaiMTK }" type="text">
                        <div v-if="$page.props.errors.txtNilaiMTK" class="invalid-feedback">
                            {{ $page.props.errors.txtNilaiMTK }}
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-8">
                    <p class="text-primary fw-bold">Lihat Data Rapor</p>
                    <hr>
                    <div v-if="$props.rapor?.file">
                        <iframe :src="`${$props.rapor?.file}`" frameborder="0" height="450"
                            width="700"
                        />
                    </div>
                </div>
            </div>
        </template>
        <template #modalFooter>
            <button type="button" class="btn btn-light" @click="closeModal()">Tutup</button>
            <button type="submit" @click="submitDataRapor" class="btn btn-primary" :disabled="btnDisabled">
                Simpan</button>
        </template>
    </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import { useModal } from "@/Composables/useModal.js";
import { ref, onMounted, onUnmounted, watchEffect,watch } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';

const emit = defineEmits(['closeFormRapor']);

const props = defineProps({
    show: Boolean,
    rapor: Object,
});

const modal = ref(null);
const btnDisabled = ref(false);

const form = useForm({
    txtNilaiPAI: '',
    txtNilaiMTK: ''
})

const closeModal = () => {
    modal.value.hide()
    emit('closeFormRapor')
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
        if (props.rapor) {
            form.txtNilaiPAI = props.rapor?.n_bing
            form.txtNilaiMTK = props.rapor?.n_mtk
        }
    }
});

const submitDataRapor = () => {
    router.post(`/apps/peserta/updaterapor/${props.rapor?.id}`, {
        txtNilaiPAI: form.txtNilaiPAI,
        txtNilaiMTK: form.txtNilaiMTK,
    },
    {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            closeModal()
            createToast(
                {
                    title: 'Berhasil',
                    description: 'Data Rapor Berhasil Diedit.'
                }, {
                    type: 'success',
                    showIcon: 'true',
                    Transition: 'zoom',
                }
            )
        },
        onError: () => {
            form.cancel(),
            createToast(
                {
                    title: 'Gagal',
                    description: 'Data Prestasi Gagal Diedit.'
                }, {
                    type: 'danger',
                    showIcon: 'true',
                    Transition: 'zoom',
                }
                )
        },
        onStart: () => btnDisabled.value = true,
        onFinish: () => btnDisabled.value = false
    })

}


</script>
