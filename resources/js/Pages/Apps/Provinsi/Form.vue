<template>
    <Modal id="mProvinsi" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Provinsi</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="txtIDProvinsi" class="form-label">ID Provinsi</label>
                        <input v-model="form.txtIDProvinsi" class="form-control" :class="{ 'is-invalid': $page.props.errors.txtIDProvinsi }" type="text" placeholder="Isikan ID Provinsi" autofocus>
                        <div v-if="$page.props.errors.txtIDProvinsi" class="invalid-feedback">
                            {{ $page.props.errors.txtIDProvinsi }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtNmProvinsi" class="form-label">Nama Provinsi</label>
                        <input v-model="form.txtNmProvinsi" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNmProvinsi }" type="text"
                            placeholder="Isikan Nama Provinsi">
                        <div v-if="$page.props.errors.txtNmProvinsi" class="invalid-feedback">
                            {{ $page.props.errors.txtNmProvinsi }}
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
import 'flatpickr/dist/flatpickr.css';


const emit = defineEmits(['close']);

const btnDisabled = ref(false);

const props = defineProps({
    show: Boolean,
    isEdit: Boolean,
    dataEdit: Object,
    provinsi: Object
});

const form = useForm({
    txtIDProvinsi: '',
    txtNmProvinsi: ''
});

const modal = ref(null);

const closeModal = () => {
    modal.value.hide()
    emit('close')
    form.reset()
    router.reload()
}

const submitData = () => {
    if (props.isEdit) {
        router.put(`/apps/provinsi/${props.dataEdit.id}`, {
            txtIDProvinsi: form.txtIDProvinsi,
            txtNmProvinsi: form.txtNmProvinsi
        }, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Perubahan Data Provinsi Berhasil Dilakukan.'
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
        router.post('/apps/provinsi', {
            txtIDProvinsi: form.txtIDProvinsi,
            txtNmProvinsi: form.txtNmProvinsi,
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Penambahan Data Provinsi Berhasil Dilakukan.'
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

const openModal = () => {
    modal.value.show();
}

onMounted(() => {
    modal.value = useModal('#mProvinsi')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
        if(props.isEdit) {
            form.txtIDProvinsi = props.dataEdit?.id,
            form.txtNmProvinsi = props.dataEdit?.nm_provinsi
        }
    }
});

</script>
