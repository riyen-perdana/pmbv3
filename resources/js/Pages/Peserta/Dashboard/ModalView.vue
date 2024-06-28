<template>
    <Modal id="mView" size="modal-lg" @close="closeModal">
        <template #modalTitle>File Prestasi Akademik dan Non Akademik</template>
        <template #modalBody>
            <div v-if="props.file" class="text-center overflow-auto">
                <iframe :src="`/storage/prestasi/${props.file}`" frameborder="0" height="500" width="700"></iframe>
            </div>
        </template>
        <template #modalFooter>
            <button type="button" class="btn btn-light" @click="closeModal()">Tutup</button>
        </template>
    </Modal>
</template>

<script setup>
import { ref, onMounted, onUnmounted, watchEffect, Transition } from "vue";
import Modal from "@/Components/Modal.vue";
import { useModal } from "@/Composables/useModal.js";

const emit = defineEmits(['close'])
const modal = ref(null);

const props = defineProps({
    show: Boolean,
    file : String
});

const closeModal = () => {
    modal.value.hide()
    emit('close')
}

const openModal = () => {
    modal.value.show();
    console.log(props.file)
}

onMounted(() => {
    modal.value = useModal('#mView')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
    }
});

</script>
