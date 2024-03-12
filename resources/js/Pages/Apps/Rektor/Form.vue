<template>
    <Modal id="mRektor" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Rektor</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="txtEmail" class="form-label">NIP Rektor</label>
                        <select v-model="form.idUser" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.idUser }">
                            <option disabled value="">Pilih NIP Rektor</option>
                            <option v-for="(rektor, index) in props.data" :key="index" :value="rektor.id">{{
                                rektor.nip }} | {{ rektor.full_nm_user }}</option>
                        </select>
                        <div v-if="$page.props.errors.idUser" class="invalid-feedback">
                            {{ $page.props.errors.idUser }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="rktAwlJbt" class="form-label">Awal Jabatan Rektor</label>
                        <flat-pickr v-model="form.rktAwlJbt" :class="{ 'is-invalid': $page.props.errors.rktAwlJbt }" class="form-control" placeholder="Awal Jabatan Rektor" />
                        <div v-if="$page.props.errors.rktAwlJbt" class="invalid-feedback">
                            {{ $page.props.errors.rktAwlJbt }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="rktAkhJbt" class="form-label">Akhir Jabatan Rektor</label>
                        <flat-pickr v-model="form.rktAkhJbt" :class="{ 'is-invalid': $page.props.errors.rktAkhJbt }" class="form-control" placeholder="Akhir Jabatan Rektor" />
                        <div v-if="$page.props.errors.rktAkhJbt" class="invalid-feedback">
                            {{ $page.props.errors.rktAkhJbt }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtStatus" class="form-label">Status PLT</label>
                        <select v-model="form.isRektorPlt" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.isRektorPlt }">
                            <option disabled value="">Pilih Status Aktif</option>
                            <option value="Y">PLT (Pelaksana Tugas)</option>
                            <option value="N">Non PLT</option>
                        </select>
                        <div v-if="$page.props.errors.isRektorPlt" class="invalid-feedback">
                            {{ $page.props.errors.isRektorPlt }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtStatus" class="form-label">Status Aktif</label>
                        <select v-model="form.isRektorAktif" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.isRektorAktif }">
                            <option disabled value="">Pilih Status Aktif</option>
                            <option value="Y">Aktif</option>
                            <option value="N">Non Aktif</option>
                        </select>
                        <div v-if="$page.props.errors.isRektorAktif" class="invalid-feedback">
                            {{ $page.props.errors.isRektorAktif }}
                        </div>
                    </div>
                </div>
            </form>
        </template>
        <template #modalFooter>
            <button type="button" class="btn btn-light" @click="closeModal()">Tutup</button>
            <button type="button" class="btn btn-primary" @click="submitData()" :disabled="btnDisabled">
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
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';


const emit = defineEmits(['close', 'submitData']);

const btnDisabled = ref(false);

const props = defineProps({
    show: Boolean,
    data: Array,
    isEdit: Boolean,
    dataEdit: Object
});

const form = useForm({
    idUser: '',
    rktAwlJbt: '',
    rktAkhJbt: '',
    isRektorAktif: '',
    isRektorPlt: ''
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
        router.put(`/apps/rektor/${props.dataEdit.data[0].id}`, {
            idUser : form.idUser,
            rktAwlJbt : form.rktAwlJbt,
            rktAkhJbt : form.rktAkhJbt,
            isRektorAktif : form.isRektorAktif,
            isRektorPlt : form.isRektorPlt
         }, {
            preserveScroll : true,
            preserveState : true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Perubahan Data Rektor Berhasil Dilakukan.'
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
        router.post('/apps/rektor', {
            idUser : form.idUser,
            rktAwlJbt : form.rktAwlJbt,
            rktAkhJbt : form.rktAkhJbt,
            isRektorAktif : form.isRektorAktif,
            isRektorPlt : form.isRektorPlt
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Penambahan Data Rektor Berhasil Dilakukan.'
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
    modal.value = useModal('#mRektor')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
        if(props.isEdit) {
            form.idUser = props.dataEdit?.data[0].user.id,
            form.rktAwlJbt = props.dataEdit?.data[0].rkt_awl_jbt,
            form.rktAkhJbt = props.dataEdit?.data[0].rkt_akh_jbt,
            form.isRektorAktif = props.dataEdit?.data[0].is_rektor_aktif,
            form.isRektorPlt = props.dataEdit?.data[0].is_rektor_plt
        }
    }
});


</script>
