<template>
    <!-- staticBackdrop Modal -->
    <div class="modal fade" id="Alert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <lottie
                        class="avatar-xl"
                        colors="primary:#121331,secondary:#08a88a"
                        :options="defaultOptions"
                        :height="100"
                        :width="100"
                    />
                    <div class="mt-4">
                        <h5 class="mb-3">Apakah Anda Yakin Menghapus Data Ini ?</h5>
                        <p class="text-muted mb-4">Data Yang Sudah Terhapus Tidak Akan Bisa Dikembalikan Lagi</p>
                        <div class="hstack gap-2 justify-content-center">
                            <form @submit.prevent="destroy(props.id)">
                                <input type="hidden" v-model="props.id">
                            </form>
                            <button class="btn link-success fw-medium" @click="closeModalAlert"><i class="ri-close-line me-1 align-middle"></i> Tutup</button>
                            <button class="btn btn-success" @click="destroy(props.id)">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, watchEffect } from 'vue';
import Lottie from "@/Components/Widgets/Lottie.vue";
import Danger from "@/Components/Widgets/danger.json";
import { useModal } from "@/Composables/useModal.js";

const defaultOptions = ref({ animationData: Danger });

const props = defineProps({
    id: {
        type: [Number,String],
        required: true
    },
    show: {
        type: Boolean,
        required: true
    }
});

const emit = defineEmits(['closeAlert','deleteData'])

const modal = ref(null);

const closeModalAlert = () => {
    modal.value.hide()
    emit('closeAlert')
}

const openModalAlert = () => {
    modal.value.show();
}

onMounted(() => {
    modal.value = useModal('#Alert')
});

onUnmounted(() => {
    closeModalAlert();
})

watchEffect(() => {
    if (props.show) {
        openModalAlert()
    }
});

const destroy = (id) => {
    closeModalAlert()
    emit('deleteData',id)
}

</script>
