<template>
    <Modal id="mKabkot" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Kabupaten/Kota</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-12 col-lg-12 mb-3">
                        <label for="cboProvinsi" class="form-label">Pilih Provinsi</label>
                        <select v-model="form.cboProvinsi" class="form-select" :class="{ 'is-invalid': $page.props.errors.cboProvinsi }">
                            <option disabled value="">Pilih Provinsi</option>
                            <option v-for="(prov, index) in props.provinsi" :key="index" :value="prov.id">
                                {{ prov.id }} | {{ prov.nm_provinsi }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboProvinsi" class="invalid-feedback">
                            {{ $page.props.errors.cboProvinsi }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <label for="txtKdKabkot" class="form-label">Kode Kabupaten/Kota</label>
                        <input v-model="form.txtKdKabkot" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtKdKabkot }" type="text"
                            placeholder="Isikan Kode Kabupaten/Kota">
                        <div v-if="$page.props.errors.txtKdKabkot" class="invalid-feedback">
                            {{ $page.props.errors.txtKdKabkot }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <label for="txtNmKabkot" class="form-label">Nama Kabupaten/Kota</label>
                        <input v-model="form.txtNmKabkot" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNmKabkot }" type="text"
                            placeholder="Isikan Nama Kabupaten/Kota">
                        <div v-if="$page.props.errors.txtNmKabkot" class="invalid-feedback">
                            {{ $page.props.errors.txtNmKabkot }}
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

const props = defineProps({
    show: Boolean,
    isEdit: Boolean,
    dataEdit: Object,
    provinsi: Object
});

const btnDisabled = ref(false);

const form = useForm({
    cboProvinsi : '',
    txtKdKabkot : '',
    txtNmKabkot : ''
});

const modal = ref(null);

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
    modal.value = useModal('#mKabkot')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
        if(props.isEdit) {
            form.cboProvinsi = props.dataEdit?.prov_id,
            form.txtKdKabkot = props.dataEdit?.id
            form.txtNmKabkot = props.dataEdit?.nm_kabkot
        }
    }
});

const submitData = () => {
    if (props.isEdit) {
        router.put(`/apps/kabkot/${props.dataEdit.id}`, {
            cboProvinsi : form.cboProvinsi,
            txtKdKabkot : form.txtKdKabkot,
            txtNmKabkot : form.txtNmKabkot
        }, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Data Kabupaten/Kota Berhasil Diubah.'
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
        router.post('/apps/kabkot', {
            cboProvinsi : form.cboProvinsi,
            txtKdKabkot : form.txtKdKabkot,
            txtNmKabkot : form.txtNmKabkot
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Data Kabupaten/Kota Berhasil Ditambah.'
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
