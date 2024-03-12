<template>
    <Modal id="mJenjang" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Jenjang Pendidikan</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="txtKdJenjang" class="form-label">Kode Jenjang Pendidikan</label>
                        <input v-model="form.kdJenjangPendidikan" class="form-control" :class="{ 'is-invalid': $page.props.errors.kdJenjangPendidikan }" type="text" placeholder="Isikan Kode Jenjang Pendidikan">
                        <div v-if="$page.props.errors.kdJenjangPendidikan" class="invalid-feedback">
                            {{ $page.props.errors.kdJenjangPendidikan }}
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
                    <div class="col-md-12 lg-12 mb-3">
                        <label for="txtNmJenjang" class="form-label">Nama Jenjang Pendidikan</label>
                        <input v-model="form.nMJenjangPendidikan" class="form-control" :class="{ 'is-invalid': $page.props.errors.nMJenjangPendidikan }" type="text" placeholder="Isikan Nama Jenjang Pendidikan">
                        <div v-if="$page.props.errors.nMJenjangPendidikan" class="invalid-feedback">
                            {{ $page.props.errors.nMJenjangPendidikan }}
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
    dataEdit: Object
});

const form = useForm({
    kdJenjangPendidikan : '',
    isAktif : '',
    nMJenjangPendidikan : ''
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
        router.put(`/apps/jenjang/${props.dataEdit.id}`, {
            kdJenjangPendidikan : form.kdJenjangPendidikan,
            isAktif : form.isAktif,
            nMJenjangPendidikan : form.nMJenjangPendidikan
         }, {
            preserveScroll : true,
            preserveState : true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Perubahan Data Jenjang Pendidikan Berhasil Dilakukan.'
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
        router.post('/apps/jenjang', {
            kdJenjangPendidikan : form.kdJenjangPendidikan,
            isAktif : form.isAktif,
            nMJenjangPendidikan : form.nMJenjangPendidikan
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Penambahan Data Jenjang Pendidikan Berhasil Dilakukan.'
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
    modal.value = useModal('#mJenjang')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
        if(props.isEdit) {
            form.kdJenjangPendidikan = props.dataEdit?.kd_jenjang,
            form.isAktif = props.dataEdit?.is_aktif,
            form.nMJenjangPendidikan = props.dataEdit?.nm_jenjang
        }
    }
});


</script>
