<template>
    <Modal id="mAgama" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Agama</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-12 col-lg-12 mb-3">
                        <label for="txtAgama" class="form-label">Agama</label>
                        <input v-model="form.txtAgama" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtAgama }" type="text"
                            placeholder="Agama">
                        <div v-if="$page.props.errors.txtAgama" class="invalid-feedback">
                            {{ $page.props.errors.txtAgama }}
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
import Modal from "@/Components/Modal.vue";
import { useModal } from "@/Composables/useModal.js";
import { ref, onMounted, onUnmounted, watchEffect } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';

const emit = defineEmits(['close']);

const props = defineProps({
    show: Boolean,
    isEdit: Boolean,
    dataEdit: Object,
});

const modal = ref(null);

const btnDisabled = ref(false);

const closeModal = () => {
    modal.value.hide()
    emit('close')
    form.reset()
    router.reload()
}

const openModal = () => {
    modal.value.show();
}

onMounted(() => {
    modal.value = useModal('#mAgama')
});

onUnmounted(() => {
    closeModal();
})

const form = useForm({
    txtAgama: ''
});

watchEffect(() => {
    if (props.show) {
        openModal()
        if(props.isEdit) {
            form.txtAgama = props.dataEdit?.nm_agama
        }
    }
});

const submitData = () => {
    if (props.isEdit) {
        router.put(`/apps/agama/${props.dataEdit.id}`, {
            txtAgama: form.txtAgama
        }, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Perubahan Data Agama Berhasil Dilakukan.'
                        }, {
                        type: 'success',
                        showIcon: true,
                        transition: 'zoom',
                    }
                    )
            },
            onError: form.cancel(),
            onStart: () => btnDisabled.value = true,
            onFinish: () => btnDisabled.value = false
        })
    } else {
        router.post('/apps/agama', {
            txtAgama: form.txtAgama
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Penambahan Data Agama Berhasil Dilakukan.'
                        }, {
                        type: 'success',
                        showIcon: true,
                        transition: 'zoom',
                    }
                    )
            },
            onError: form.cancel(),
            onStart: () => btnDisabled.value = true,
            onFinish: () => btnDisabled.value = false
        })
    }
};
</script>
