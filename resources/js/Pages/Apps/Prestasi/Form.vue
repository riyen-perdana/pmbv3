<template>
    <Modal id="mBidang" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Bidang Prestasi</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="txtBidangPrestasi" class="form-label">Nama Bidang Prestasi</label>
                        <input v-model="form.txtBidangPrestasi" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtBidangPrestasi }" type="text"
                            placeholder="Bidang Prestasi">
                        <div v-if="$page.props.errors.txtBidangPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.txtBidangPrestasi }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtNilaiBidangPrestasi" class="form-label">Nilang Bidang Prestasi</label>
                        <input v-model="form.txtNilaiBidangPrestasi" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNilaiBidangPrestasi }" type="text"
                            placeholder="Isikan Nilai Bidang Prestasi">
                        <div v-if="$page.props.errors.txtNilaiBidangPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.txtNilaiBidangPrestasi }}
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
    modal.value = useModal('#mBidang')
});

onUnmounted(() => {
    closeModal();
})

const form = useForm({
    txtBidangPrestasi: '',
    txtNilaiBidangPrestasi: ''
});

watchEffect(() => {
    if (props.show) {
        openModal()
        if(props.isEdit) {
            form.txtBidangPrestasi = props.dataEdit?.nama,
            form.txtNilaiBidangPrestasi = props.dataEdit?.nilai
        }
    }
});

const submitData = () => {
    if (props.isEdit) {
        router.put(`/apps/prestasi/${props.dataEdit.id}`, {
            txtBidangPrestasi: form.txtBidangPrestasi,
            txtNilaiBidangPrestasi: form.txtNilaiBidangPrestasi
        }, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Perubahan Data Bidang Prestasi Berhasil Dilakukan.'
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
        router.post('/apps/prestasi', {
            txtBidangPrestasi: form.txtBidangPrestasi,
            txtNilaiBidangPrestasi: form.txtNilaiBidangPrestasi
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Penambahan Data Bidang Prestasi Berhasil Dilakukan.'
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
