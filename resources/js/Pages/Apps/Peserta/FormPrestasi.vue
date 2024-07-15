<template>
    <Modal id="mPrestasi" size="modal-xl" @close="closeModal">
        <template #modalTitle>Ubah Data Bidang Prestasi</template>
        <template #modalBody>
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <p class="text-primary fw-bold">Borang Data Prestasi</p>
                    <hr>
                    <div class="mb-2">
                        <label for="txtNmPrestasi" class="form-label">Nama Prestasi</label>
                        <input v-model="form.txtNmPrestasi" class="form-control"
                            :class="{ 'is-invalid': $page.props.errors.txtNmPrestasi }" type="text" disabled>
                        <div v-if="$page.props.errors.txtNmPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.txtNmPrestasi }}
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="cboKelompokPrestasi" class="form-label">Jenis Prestasi</label>
                        <select v-model="form.cboKelompokPrestasi" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.cboKelompokPrestasi }">
                            <option disabled value="">Pilih Kelompok Prestasi</option>
                            <option v-for="(kel, index) in props.inkel" :key="index" :value="kel.id">
                                {{ kel.nama }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboKelompokPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.cboKelompokPrestasi }}
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="cboBidangPrestasi" class="form-label">Bidang Prestasi</label>
                        <select v-model="form.cboBidangPrestasi" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.cboBidangPrestasi }">
                            <option disabled value="">Pilih Bidang Prestasi</option>
                            <option v-for="(bdg, index) in props.bidang" :key="index" :value="bdg.id">
                                {{ bdg.nama }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboBidangPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.cboBidangPrestasi }}
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="cboTingkatPrestasi" class="form-label">Tingkat Prestasi</label>
                        <select v-model="form.cboTingkatPrestasi" class="form-select"
                            :class="{ 'is-invalid': $page.props.errors.cboTingkatPrestasi }">
                            <option disabled value="">Pilih Tingkat Prestasi</option>
                            <option v-for="(tk, index) in props.tingkat" :key="index" :value="tk.id">
                                {{ tk.nama }}
                            </option>
                        </select>
                        <div v-if="$page.props.errors.cboBidangPrestasi" class="invalid-feedback">
                            {{ $page.props.errors.cboBidangPrestasi }}
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-8">
                    <p class="text-primary fw-bold">Lihat Data Prestasi</p>
                    <hr>
                    <div v-if="$props.prestasi?.file">
                        <iframe :src="`/storage/prestasi/${$props.prestasi?.file}`" frameborder="0" height="450"
                            width="700"
                        />
                    </div>
                </div>
            </div>
        </template>
        <template #modalFooter>
            <button type="button" class="btn btn-light" @click="closeModal()">Tutup</button>
            <button type="submit" @click="submitData" class="btn btn-primary" :disabled="btnDisabled">
                Simpan</button>
        </template>
    </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import { useModal } from "@/Composables/useModal.js";
import { ref, onMounted, onUnmounted, watchEffect,watch } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';

const emit = defineEmits(['closeFormPrestasi']);

const props = defineProps({
    show: Boolean,
    prestasi: Object,
    inkel: Object,
    bidang: Object,
    tingkat: Object
});

const modal = ref(null);
const btnDisabled = ref(false);

const form = useForm({
    txtNmPrestasi: '',
    cboKelompokPrestasi: '',
    cboBidangPrestasi: '',
    cboTingkatPrestasi: '',
})

const closeModal = () => {
    modal.value.hide()
    emit('closeFormPrestasi')
}

const openModal = () => {
    modal.value.show();
}

onMounted(() => {
    modal.value = useModal('#mPrestasi')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
        if (props.prestasi) {
            form.txtNmPrestasi = props.prestasi?.nm_prestasi
            form.cboKelompokPrestasi = props.prestasi?.inkel.id
            form.cboBidangPrestasi = props.prestasi?.bidang.id
            form.cboTingkatPrestasi = props.prestasi?.tingkat.id
        }
        console.log(props.prestasi)
    }
});

const submitData = () => {
    router.post(`/apps/peserta/updateprestasi/${props.prestasi?.id}`, {
        txtNmPrestasi: form.txtNmPrestasi,
        cboKelompokPrestasi: form.cboKelompokPrestasi,
        cboBidangPrestasi: form.cboBidangPrestasi,
        cboTingkatPrestasi: form.cboTingkatPrestasi,
    },
    {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            closeModal()
            createToast(
                {
                    title: 'Berhasil',
                    description: 'Data Prestasi Berhasil Diedit.'
                }, {
                    type: 'success',
                    showIcon: 'true',
                    Transition: 'zoom',
                }
            )
        },
        onError: () => {
            form.cancel(),
            createToast(
                {
                    title: 'Gagal',
                    description: 'Data Prestasi Gagal Diedit.'
                }, {
                    type: 'danger',
                    showIcon: 'true',
                    Transition: 'zoom',
                }
                )
        },
        onStart: () => btnDisabled.value = true,
        onFinish: () => btnDisabled.value = false
    })

}


</script>
