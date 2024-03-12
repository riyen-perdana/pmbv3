<template>
    <div class="modal fade" :id="props.id" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
        aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" :class="props.size" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <slot name="modalTitle" />
                    <!-- <h5 class="modal-title">&nbsp;</h5> -->
                    <button type="button" class="btn-close" @click="emit('close')" aria-label="Close" id="close-modal">
                    </button>
                </div>
                <div class="modal-body">
                    <slot name="modalBody" />
                </div>
                <div class="modal-footer">
                   <slot name="modalFooter" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    id: {
        type: String,
        required: true
    },
    size: {
        type: String,
        default: 'modal-lg'
    }
});

const emit = defineEmits(['close']);

</script>

<style lang="scss" scoped></style>
