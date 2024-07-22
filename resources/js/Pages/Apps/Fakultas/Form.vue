<template>
    <Modal id="mFakultas" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Fakultas</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="txtNamaFakultas" class="form-label">Nama Fakultas</label>
                        <input v-model="form.nmFakultas" class="form-control" :class="{ 'is-invalid': $page.props.errors.nmFakultas }" type="text" placeholder="Isikan Nama Fakultas" autofocus>
                        <div v-if="$page.props.errors.nmFakultas" class="invalid-feedback">
                            {{ $page.props.errors.nmFakultas }}
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
                    <div class="col-md-6 lg-6 mb-3">
                        <label for="txtAkreditasi" class="form-label">Akreditasi</label>
                        <select v-model="form.akreditasi" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.akreditasi }">
                            <option disabled value="">Pilih Akreditasi</option>
                            <option v-for="(akr, index) in props.akreditasi" :key="index" :value="akr.id">{{
                                akr.jns_akreditasi }}</option>
                        </select>
                        <div v-if="$page.props.errors.akreditasi" class="invalid-feedback">
                            {{ $page.props.errors.akreditasi }}
                        </div>
                    </div>
                    <div class="col-md-6 lg-6 mb-3">
                        <label for="txtDekan" class="form-label">Dekan Fakultas</label>
                        <select v-model="form.dekan" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.dekan }">
                            <option disabled value="">Pilih Dekan</option>
                            <option v-for="(dkn, index) in props.dekan" :key="index" :value="dkn.id">{{
                                dkn.full_nm_user }}</option>
                        </select>
                        <div v-if="$page.props.errors.dekan" class="invalid-feedback">
                            {{ $page.props.errors.dekan }}
                        </div>
                    </div>
                    <div class="col-md-12 lg-12 mb-3">
                        <label for="txtLinkFakultas" class="form-label">Link Website Fakultas</label>
                        <input v-model="form.linkWebFakultas" class="form-control" :class="{ 'is-invalid': $page.props.errors.linkWebFakultas }" type="text" placeholder="Isikan Link Website Fakultas">
                        <div v-if="$page.props.errors.linkWebFakultas" class="invalid-feedback">
                            {{ $page.props.errors.linkWebFakultas }}
                        </div>
                    </div>
                    <div class="col-md-12 lg-12 mb-3">
                        <label for="txtLinkAkreditasi" class="form-label">Link Website Akreditasi Fakultas</label>
                        <input v-model="form.linkWebAkreditasiFakultas" class="form-control" :class="{ 'is-invalid': $page.props.errors.linkWebAkreditasiFakultas }" type="text" placeholder="Isikan Link Website Akreditasi Fakultas">
                        <div v-if="$page.props.errors.linkWebAkreditasiFakultas" class="invalid-feedback">
                            {{ $page.props.errors.linkWebAkreditasiFakultas }}
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
    akreditasi : Array,
    dekan : Object
});

const form = useForm({
    nmFakultas: '',
    isAktif: '',
    linkWebFakultas: '',
    linkWebAkreditasiFakultas: '',
    akreditasi: '',
    dekan: ''
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
        router.put(`/apps/fakultas/${props.dataEdit.id}`, {
            dekan : form.dekan,
            nmFakultas : form.nmFakultas,
            isAktif : form.isAktif,
            akreditasi : form.akreditasi,
            linkWebFakultas : form.linkWebFakultas,
            linkWebAkreditasiFakultas : form.linkWebAkreditasiFakultas
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
        router.post('/apps/fakultas', {
            dekan : form.dekan,
            nmFakultas : form.nmFakultas,
            isAktif : form.isAktif,
            akreditasi : form.akreditasi,
            linkWebFakultas : form.linkWebFakultas,
            linkWebAkreditasiFakultas : form.linkWebAkreditasiFakultas
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Penambahan Data Fakultas Berhasil Dilakukan.'
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
    modal.value = useModal('#mFakultas')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
        if(props.isEdit) {
            form.nmFakultas = props.dataEdit?.nm_fakultas,
            form.dekan = props.dataEdit?.id_user,
            form.isAktif = props.dataEdit?.is_aktif,
            form.linkWebFakultas = props.dataEdit?.url_fakultas,
            form.linkWebAkreditasiFakultas = props.dataEdit?.url_akr_fakultas,
            form.akreditasi = props.dataEdit?.akreditasi.id
        }
    }
});


</script>
