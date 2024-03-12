<template>
    <Modal id="mAkreditasi" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Akreditasi</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="txtJnsAkreditasi" class="form-label">Jenis Akreditasi</label>
                        <input v-model="form.jnsAkreditasi" class="form-control" :class="{ 'is-invalid': $page.props.errors.jnsAkreditasi }" type="text" placeholder="Isikan Jenis Akreditasi" autofocus>
                        <div v-if="$page.props.errors.jnsAkreditasi" class="invalid-feedback">
                            {{ $page.props.errors.jnsAkreditasi }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtStatus" class="form-label">Status Aktif</label>
                        <select v-model="form.isAktif" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.isAktif }">
                            <option disabled value="">Pilih Status Aktif</option>
                            <option value="Y">Aktif</option>
                            <option value="N">Non Aktif</option>
                        </select>
                        <div v-if="$page.props.errors.isAktif" class="invalid-feedback">
                            {{ $page.props.errors.isAktif }}
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


const emit = defineEmits(['close', 'submitData']);

const btnDisabled = ref(false);

const props = defineProps({
    show: Boolean,
    isEdit: Boolean,
    dataEdit: Object
});

const form = useForm({
    jnsAkreditasi: '',
    isAktif:''
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
        router.put(`/apps/akreditasi/${props.dataEdit.id}`, {
            jnsAkreditasi : form.jnsAkreditasi,
            isAktif : form.isAktif
         }, {
            preserveScroll : true,
            preserveState : true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Perubahan Data Akreditasi Berhasil Dilakukan.'
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
        router.post('/apps/akreditasi', {
            jnsAkreditasi : form.jnsAkreditasi,
            isAktif : form.isAktif
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Penambahan Data Akreditasi Berhasil Dilakukan.'
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
    modal.value = useModal('#mAkreditasi')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
        if(props.isEdit) {
            form.jnsAkreditasi = props.dataEdit?.jns_akreditasi,
            form.isAktif = props.dataEdit?.is_aktif
        }
    }
});


</script>
