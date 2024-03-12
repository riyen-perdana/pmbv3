<template>
    <Modal id="mPengguna" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Pengguna</template>
        <template #modalBody>
            <form @submit.prevent="submitData">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="txtNipNik" class="form-label">NIP/NIK</label>
                        <input v-model="form.nipNik" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.nipNik }" type="text" placeholder="Isikan NIP/NIK"
                            id="txtNipNik" autofocus>
                        <div v-if="$page.props.errors.nipNik" class="invalid-feedback">
                            {{ $page.props.errors.nipNik }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtNamaPegawai" class="form-label">Nama Pegawai</label>
                        <input v-model="form.namaPegawai" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.namaPegawai }" type="text" placeholder="Isikan Nama"
                            id="txtNamaPegawai">
                        <div v-if="$page.props.errors.namaPegawai" class="invalid-feedback">
                            {{ $page.props.errors.namaPegawai }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtGlrDpn" class="form-label">Gelar Depan</label>
                        <input v-model="form.glrDepan" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.glrDepan }" type="text"
                            placeholder="Isikan Gelar Depan" id="txtGlrDpn">
                        <div v-if="$page.props.errors.glrDepan" class="invalid-feedback">
                            {{ $page.props.errors.glrDepan }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtGlrBlk" class="form-label">Gelar Belakang</label>
                        <input v-model="form.glrBelakang" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.glrBelakang }" type="text"
                            placeholder="Isikan Gelar Belakang" id="txtGlrDpn">
                        <div v-if="$page.props.errors.glrBelakang" class="invalid-feedback">
                            {{ $page.props.errors.glrBelakang }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtPassword" class="form-label">Kata Kunci</label>
                        <input v-model="form.password" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.password }" type="password"
                            placeholder="Isikan Kata Kunci" id="txtPassword">
                        <div v-if="$page.props.errors.password" class="invalid-feedback">
                            {{ $page.props.errors.password }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtPasswordConfirmation" class="form-label">Ulangi Kata Kunci</label>
                        <input v-model="form.password_confirmation" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.password_confirmation }" type="password"
                            placeholder="Ulangi Isikan Kata Kunci" id="txtPasswordConfirmation">
                        <div v-if="$page.props.errors.password_confirmation" class="invalid-feedback">
                            {{ $page.props.errors.password_confirmation }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtEmail" class="form-label">Email Pegawai</label>
                        <input v-model="form.email" class="form-control" :class="{ 'is-invalid': $page.props.errors.email }"
                            type="text" placeholder="Isikan Email" id="txtUKtKunci">
                        <div v-if="$page.props.errors.email" class="invalid-feedback">
                            {{ $page.props.errors.email }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtEmail" class="form-label">Otorisasi</label>
                        <select v-model="form.otorisasi" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.otorisasi }">
                            <option disabled value="">Pilih Otorisasi</option>
                            <option v-for="(otorisasi, index) in props.data" :key="index" :value="otorisasi.id">{{
                                otorisasi.name }}</option>
                        </select>
                        <div v-if="$page.props.errors.otorisasi" class="invalid-feedback">
                            {{ $page.props.errors.otorisasi }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtStatus" class="form-label">Status Aktif</label>
                        <select v-model="form.is_aktif" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.is_aktif }">
                            <option disabled value="">Pilih Status Aktif</option>
                            <option value="Y">Aktif</option>
                            <option value="N">Non Aktif</option>
                        </select>
                        <div v-if="$page.props.errors.otorisasi" class="invalid-feedback">
                            {{ $page.props.errors.otorisasi }}
                        </div>
                    </div>
                </div>
            </form>
        </template>
        <template #modalFooter>
            <button type="button" class="btn btn-light" @click="closeModal()">Tutup</button>
            <button type="button" class="btn btn-primary" @click="submitData()" :disabled="btnDisabled">{{ props.isEdit
                ==
                false ? "Simpan" : "Ubah"
            }}</button>
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

const emit = defineEmits(['close', 'submitData'])

const props = defineProps({
    show: Boolean,
    id: Number,
    data: Array,
    isEdit: Boolean,
    dataEdit: Object
})

const form = useForm({
    nipNik: '',
    namaPegawai: '',
    glrDepan: '',
    glrBelakang: '',
    password: '',
    password_confirmation: '',
    email: '',
    otorisasi: '',
    is_aktif: ''
})

const modal = ref(null);

const btnDisabled = ref(false);

const closeModal = () => {
    modal.value.hide()
    emit('close')
    form.reset()
    router.reload()
}

const submitData = () => {
    if (props.id != 0) {
        router.put(`/apps/pengguna/${props.id}`, {
            nipNik: form.nipNik,
            namaPegawai: form.namaPegawai,
            glrDepan: form.glrDepan,
            glrBelakang: form.glrBelakang,
            password: form.password,
            password_confirmation: form.password_confirmation,
            email: form.email,
            otorisasi: form.otorisasi,
            is_aktif: form.is_aktif
        }, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Perubahan Data Pengguna Berhasil Dilakukan.'
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
        router.post('/apps/pengguna', {
            nipNik: form.nipNik,
            namaPegawai: form.namaPegawai,
            glrDepan: form.glrDepan,
            glrBelakang: form.glrBelakang,
            password: form.password,
            password_confirmation: form.password_confirmation,
            email: form.email,
            otorisasi: form.otorisasi,
            is_aktif: form.is_aktif
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Penambahan Data Pengguna Berhasil Dilakukan.'
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
}

const openModal = () => {
    modal.value.show();
}

onMounted(() => {
    modal.value = useModal('#mPengguna')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
        if (props.id != 0) {
            form.nipNik = props.dataEdit?.nip
            form.namaPegawai = props.dataEdit?.name
            form.glrDepan = props.dataEdit?.glr_dpn
            form.glrBelakang = props.dataEdit?.glr_blk
            form.password = ''
            form.password_confirmation = ''
            form.email = props.dataEdit?.email
            form.otorisasi = props.dataEdit?.roles[0]?.id
            form.is_aktif = props.dataEdit?.is_aktif
        }
    }
});

</script>
