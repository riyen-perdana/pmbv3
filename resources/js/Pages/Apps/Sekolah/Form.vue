<template>
    <Modal id="mSekolah" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Sekolah</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-12 col-lg-12 mb-3">
                        <label for="cboProvinsi" class="form-label">Pilih Provinsi</label>
                        <select v-model="form.cboProvinsi" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.cboProvinsi }">
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
                        <label for="cboKabkot" class="form-label">Kabupaten-Kota</label>
                        <select v-model="form.cboKabkot" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.cboKabkot }">
                            <option disabled value="">Pilih Kabupaten-Kota</option>
                            <option v-for="(kk, index) in kabkot" :key="index" :value="kk.id">
                                {{ kk.id }} | {{ kk.nm_kabkot }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboKabkot" class="invalid-feedback">
                            {{ $page.props.errors.cboKabkot }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <label for="cboKecamatan" class="form-label">Kecamatan</label>
                        <select v-model="form.cboKecamatan" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.cboKecamatan }">
                            <option disabled value="">Pilih Kecamatan</option>
                            <option v-for="(kec, index) in kecamatan" :key="index" :value="kec.id">
                                {{ kec.id }} | {{ kec.nm_kecamatan }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboKecamatan" class="invalid-feedback">
                            {{ $page.props.errors.cboKecamatan }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <label for="txtIdSekolah" class="form-label">Nomor Pokok Sekolah Nasional</label>
                        <input v-model="form.txtIdSekolah" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtIdSekolah }" type="text"
                            placeholder="Isikan Nomor Pokok Sekolah Nasional">
                        <div v-if="$page.props.errors.txtIdSekolah" class="invalid-feedback">
                            {{ $page.props.errors.txtIdSekolah }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-3">
                        <label for="txtNmSekolah" class="form-label">Nama Sekolah</label>
                        <input v-model="form.txtNmSekolah" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNmSekolah }" type="text"
                            placeholder="Isikan Nama Sekolah">
                        <div v-if="$page.props.errors.txtNmSekolah" class="invalid-feedback">
                            {{ $page.props.errors.txtNmSekolah }}
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 mb-3">
                        <label for="txtAlamatSekolah" class="form-label">Alamat Sekolah</label>
                        <input v-model="form.txtAlamatSekolah" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtAlamatSekolah }" type="text"
                            placeholder="Isikan Alamat Sekolah">
                        <div v-if="$page.props.errors.txtAlamatSekolah" class="invalid-feedback">
                            {{ $page.props.errors.txtAlamatSekolah }}
                        </div>
                    </div>
                </div>
            </form>
        </template>
        <template #modalFooter>
            <button type="button" class="btn btn-light" @click="closeModal()">Tutup</button>
            <button type="submit" @click="submitData" class="btn btn-primary">
                {{ props.isEdit == false ? "Simpan" : "Ubah" }}</button>
        </template>
    </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import { useModal } from "@/Composables/useModal.js";
import { ref, onMounted, onUnmounted, watchEffect, watch, reactive } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import 'flatpickr/dist/flatpickr.css';
import axios from "axios";

const emit = defineEmits(['close']);

const props = defineProps({
    show: Boolean,
    isEdit: Boolean,
    dataEdit: Object,
    provinsi: Object
});

const btnDisabled = ref(false);

const modal = ref(null);
const kabkot = ref([]);
const kecamatan = ref([]);

const form = useForm({
    cboProvinsi: "",
    cboKabkot: "",
    cboKecamatan: "",
    txtIdSekolah: "",
    txtNmSekolah: "",
    txtAlamatSekolah: ""
});

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
    modal.value = useModal('#mSekolah')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
        // if(props.isEdit) {
        //     form.cboProvinsi = props.dataEdit?.prov_id,
        //     form.txtKdKabkot = props.dataEdit?.id
        //     form.txtNmKabkot = props.dataEdit?.nm_kabkot
        // }
    }
});

watch(() => form.cboProvinsi, (newValue) => {
    if (newValue) {
        fetchDataKabkot()
    }
})

watch(() => form.cboKabkot, (newValue) => {
    if (newValue) {
        fetchDataKecamatan()
    }
})

const fetchDataKabkot = async () => {
    form.reset('cboKabkot')
    const response = await axios.get(`/apps/kabkot/propinsi/${form.cboProvinsi}`);
    kabkot.value = response.data
}

const fetchDataKecamatan = async () => {
    form.reset('cboKecamatan')
    const response = await axios.get(`/apps/kecamatan/kabkot/${form.cboKabkot}`);
    kecamatan.value = response.data
}

const submitData = () => {
    if (props.isEdit) {
        router.put(`/apps/kabkot/${props.dataEdit.id}`, {
            cboProvinsi: form.cboProvinsi,
            txtKdKabkot: form.txtKdKabkot,
            txtNmKabkot: form.txtNmKabkot
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
        router.post('/apps/sekolah', {
            cboProvinsi : form.cboProvinsi,
            cboKabkot : form.cboKabkot,
            cboKecamatan : form.cboKecamatan,
            txtIdSekolah : form.txtIdSekolah,
            txtNmSekolah : form.txtNmSekolah,
            txtAlamatSekolah : form.txtAlamatSekolah
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Data Sekolah Berhasil Ditambah.'
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
