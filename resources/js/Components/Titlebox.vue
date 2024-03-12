<template>
    <div v-if="isDashboard">
        <h4 class="fs-16 mb-1">
            Assalamualaikum, {{ $page.props.auth.user.name }}
        </h4>
    </div>
    <div v-else>
        <h4 class="fs-16 mb-1">
            {{ title }}
        </h4>
    </div>
    <p class="text-muted mb-0">
        {{ subTitle }}
    </p>
</template>

<script setup>
const props = defineProps({
    isDashboard: Boolean,
    subTitle: String,
    title: String,
});
</script>
