<template>
    <Modal id="mProdi" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Program Studi</template>
        <template #modalBody>
            <form @submit.prevent="submitData()">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="txtKodeProdi" class="form-label">Kode Program Studi</label>
                        <input v-model="form.txtKodeProdi" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtKodeProdi }" type="text"
                            placeholder="Isikan Kode Program Studi" autofocus>
                        <div v-if="$page.props.errors.txtKodeProdi" class="invalid-feedback">
                            {{ $page.props.errors.txtKodeProdi }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="txtNmProdi" class="form-label">Nama Program Studi</label>
                        <input v-model="form.txtNmProdi" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNmProdi }" type="text"
                            placeholder="Isikan Nama Program Studi">
                        <div v-if="$page.props.errors.txtNmProdi" class="invalid-feedback">
                            {{ $page.props.errors.txtNmProdi }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="optNmFakultas" class="form-label">Nama Fakultas</label>
                        <select v-model="form.optNmFakultas" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.optNmFakultas }">
                            <option disabled value="">Pilih Fakultas</option>
                            <option v-for="(fkt, index) in props.fakultas" :key="index" :value="fkt.id">
                                {{ fkt.nm_fakultas }}</option>
                        </select>
                        <div v-if="$page.props.errors.optNmFakultas" class="invalid-feedback">
                            {{ $page.props.errors.optNmFakultas }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="optJenjang" class="form-label">Jenjang Pendidikan</label>
                        <select v-model="form.optJenjang" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.optJenjang }">
                            <option disabled value="">Pilih Jenjang Pendidikan</option>
                            <option v-for="(jjg, index) in props.jenjang" :key="index" :value="jjg.id">
                                {{ jjg.kd_jenjang }} - {{ jjg.nm_jenjang }}</option>
                        </select>
                        <div v-if="$page.props.errors.optJenjang" class="invalid-feedback">
                            {{ $page.props.errors.optJenjang }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="optAkreditasi" class="form-label">Akreditasi Program Studi</label>
                        <select v-model="form.optAkreditasi" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.optAkreditasi }">
                            <option disabled value="">Pilih Akreditasi</option>
                            <option v-for="(akr, index) in props.akreditasi" :key="index" :value="akr.id">
                                {{ akr.jns_akreditasi }}</option>
                        </select>
                        <div v-if="$page.props.errors.optAkreditasi" class="invalid-feedback">
                            {{ $page.props.errors.optAkreditasi }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="optStatusAktif" class="form-label">Status Aktif Program Studi</label>
                        <select v-model="form.optStatusAktif" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.optStatusAktif }">
                            <option disabled value="">Pilih Status Aktif</option>
                            <option value="Y">Aktif</option>
                            <option value="N">Non Aktif</option>
                        </select>
                        <div v-if="$page.props.errors.optStatusAktif" class="invalid-feedback">
                            {{ $page.props.errors.optStatusAktif }}
                        </div>
                    </div>
                    <div class="col-md-6 lg-6 mb-3">
                        <label for="txtQuota" class="form-label">Quota Program Studi</label>
                        <input v-model="form.txtQuota" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtQuota }" type="text"
                            placeholder="Isikan Kuota Program Studi">
                        <div v-if="$page.props.errors.txtQuota" class="invalid-feedback">
                            {{ $page.props.errors.txtQuota }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="optStatusValidasi" class="form-label">Status Validasi Dekan</label>
                        <select v-model="form.optStatusValidasi" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.optStatusValidasi }">
                            <option disabled value="">Pilih Status Validasi</option>
                            <option value="Y">Sudah Validasi</option>
                            <option value="N">Belum Validasi</option>
                        </select>
                        <div v-if="$page.props.errors.optStatusValidasi" class="invalid-feedback">
                            {{ $page.props.errors.optStatusValidasi }}
                        </div>
                    </div>
                    <div class="col-md-12 lg-12 mb-3">
                        <label for="cboPil34" class="form-label">Pilihan 3 dan 4</label>
                        <select v-model="form.cboPil34" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.cboPil34 }">
                            <option disabled value="">Pilih Status Pilihan 3 dan 4</option>
                            <option value="Y">Aktif</option>
                            <option value="N">Non Aktif</option>
                        </select>
                        <div v-if="$page.props.errors.cboPil34" class="invalid-feedback">
                            {{ $page.props.errors.cboPil34 }}
                        </div>
                    </div>
                    <div class="col-md-12 lg-12 mb-3">
                        <label for="txtLinkProdi" class="form-label">Link Website Program Studi</label>
                        <input v-model="form.txtLinkProdi" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtLinkProdi }" type="text"
                            placeholder="Isikan Link Website Fakultas">
                        <div v-if="$page.props.errors.txtLinkProdi" class="invalid-feedback">
                            {{ $page.props.errors.txtLinkProdi }}
                        </div>
                    </div>
                    <div class="col-md-12 lg-12 mb-3">
                        <label for="txtLinkAkreditasiProdi" class="form-label">Link Akreditasi Program Studi</label>
                        <input v-model="form.txtLinkAkreditasiProdi" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtLinkAkreditasiProdi }" type="text"
                            placeholder="Isikan Link Website Fakultas">
                        <div v-if="$page.props.errors.txtLinkAkreditasiProdi" class="invalid-feedback">
                            {{ $page.props.errors.txtLinkAkreditasiProdi }}
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
    fakultas: Array,
    jenjang: Array,
    akreditasi: Array
});

const form = useForm({
    txtKodeProdi: '',
    txtNmProdi: '',
    optNmFakultas: '',
    optJenjang: '',
    optAkreditasi: '',
    optStatusAktif: '',
    txtLinkProdi: '',
    txtLinkAkreditasiProdi: '',
    cboPil34: '',
    txtQuota: '',
    optStatusValidasi: '',
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
        router.put(`/apps/prodi/${props.dataEdit.id}`, {
            txtKodeProdi: form.txtKodeProdi,
            txtNmProdi: form.txtNmProdi,
            optNmFakultas: form.optNmFakultas,
            optJenjang: form.optJenjang,
            optAkreditasi: form.optAkreditasi,
            txtLinkProdi: form.txtLinkProdi,
            txtLinkAkreditasiProdi: form.txtLinkAkreditasiProdi,
            optStatusAktif: form.optStatusAktif,
            cboPil34: form.cboPil34,
            txtQuota: form.txtQuota,
            optStatusValidasi: form.optStatusValidasi,
        }, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Perubahan Data Program Studi Berhasil Dilakukan.'
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
        router.post('/apps/prodi', {
            txtKodeProdi: form.txtKodeProdi,
            txtNmProdi: form.txtNmProdi,
            optNmFakultas: form.optNmFakultas,
            optJenjang: form.optJenjang,
            optAkreditasi: form.optAkreditasi,
            txtLinkProdi: form.txtLinkProdi,
            txtLinkAkreditasiProdi: form.txtLinkAkreditasiProdi,
            optStatusAktif: form.optStatusAktif,
            cboPil34: form.cboPil34,
            txtQuota: form.txtQuota,
            optStatusValidasi: form.optStatusValidasi,
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Penambahan Data Program Studi Berhasil Dilakukan.'
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
    modal.value = useModal('#mProdi')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
        if(props.isEdit) {
            form.txtKodeProdi = props.dataEdit?.kd_prodi,
            form.txtNmProdi = props.dataEdit?.nm_prodi,
            form.optNmFakultas = props.dataEdit?.fakultas.id,
            form.optAkreditasi = props.dataEdit?.akreditasi.id,
            form.optJenjang = props.dataEdit?.jenjang.id,
            form.optStatusAktif = props.dataEdit?.is_aktif,
            form.txtLinkProdi = props.dataEdit?.url_prodi,
            form.txtLinkAkreditasiProdi = props.dataEdit?.url_akr_prodi
            form.cboPil34 = props.dataEdit?.is_pil_34,
            form.txtQuota = props.dataEdit?.quota,
            form.optStatusValidasi = props.dataEdit?.is_valid
        }
    }
});

</script>
