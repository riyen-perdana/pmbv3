<template>
    <Modal id="mAPIKabkot" size="modal-lg" @close="closeModalAPI">
        <template #modalTitle>Get API Data Kabupaten Kota</template>
        <template #modalBody>
            <div class="col-md-9 lg-9 mb-3">
                <label for="txtProvinsi" class="form-label">Pilih Provinsi</label>
                <select v-model="cboProvinsi" class="form-select">
                    <option disabled value="">Pilih Provinsi</option>
                    <option v-for="(prov, index) in props.data" :key="index" :value="prov.id">
                        {{ prov.id }} | {{ prov.nm_provinsi }}
                    </option>
                </select>
            </div>
        </template>
        <template #modalFooter>
            <button type="button" class="btn btn-light" @click="closeModalAPI()">Tutup</button>
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
    showAPI: Boolean,
    data: Object
});

const modalAPI = ref(null);
const cboProvinsi = ref({});

const closeModalAPI = () => {
    modalAPI.value.hide()
    emit('close')
    router.reload()

}

const openModalAPI = () => {
    modalAPI.value.show()
}

onMounted(() => {
    modalAPI.value = useModal('#mAPIKabkot')
});

onUnmounted(() => {
    closeModalAPI();
});

watchEffect(() => {
    if (props.showAPI) {
        openModalAPI()
    }
});

</script>
