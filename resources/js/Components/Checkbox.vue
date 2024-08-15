<template>
    <div class="form-check form-check-inline" :class="classes">
        <input class="form-check-input" type="checkbox" :checked="checked" @change="emitChange" />
    </div>
</template>

<script setup>
import { defineEmits, defineProps } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    classes: {
        type: String,
        default: 'form-check-warning',
    }
});

const emitChange = (event) => {
    emit('update:checked', event.target.checked);
};

</script>
