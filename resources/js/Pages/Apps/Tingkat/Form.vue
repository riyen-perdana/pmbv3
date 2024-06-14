<template>
    <Modal id="mTingkat" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Tingkat Prestasi</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="txtTingkatPrestasi" class="form-label">Nama Tingkat Prestasi</label>
                        <input v-model="form.txtTingkatPrestasi" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtTingkatPrestasi }" type="text"
                            placeholder="Tingkat Prestasi">
                        <div v-if="$page.props.errors.txtTingkatPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.txtTingkatPrestasi }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtNilaiTingkatPrestasi" class="form-label">Nilai Tingkat Prestasi</label>
                        <input v-model="form.txtNilaiTingkatPrestasi" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNilaiTingkatPrestasi }" type="text"
                            placeholder="Isikan Nilai Tingkat Prestasi">
                        <div v-if="$page.props.errors.txtNilaiTingkatPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.txtNilaiTingkatPrestasi }}
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
    modal.value = useModal('#mTingkat')
});

onUnmounted(() => {
    closeModal();
})

const form = useForm({
    txtTingkatPrestasi: '',
    txtNilaiTingkatPrestasi: ''
});

watchEffect(() => {
    if (props.show) {
        openModal()
        if(props.isEdit) {
            form.txtTingkatPrestasi = props.dataEdit?.nama,
            form.txtNilaiTingkatPrestasi = props.dataEdit?.nilai
        }
    }
});

const submitData = () => {
    if (props.isEdit) {
        router.put(`/apps/tingkat/${props.dataEdit.id}`, {
            txtTingkatPrestasi: form.txtTingkatPrestasi,
            txtNilaiTingkatPrestasi: form.txtNilaiTingkatPrestasi
        }, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Perubahan Data Tingkat Prestasi Berhasil Dilakukan.'
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
        router.post('/apps/tingkat', {
            txtTingkatPrestasi: form.txtTingkatPrestasi,
            txtNilaiTingkatPrestasi: form.txtNilaiTingkatPrestasi
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Penambahan Data Tingkat Prestasi Berhasil Dilakukan.'
                        },
                        {
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
