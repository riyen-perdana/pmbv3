<template>
    <div v-if="isDashboard">
        <div v-if="$page.props.auth.user != null">
            <h4 class="fs-16 mb-1">
                Assalamualaikum, {{ $page.props.auth.user.full_nm_user }}
            </h4>
        </div>
        <div v-else>
            <h4 class="fs-16 mb-1">
                Assalamualaikum {{ $page.props.auth.peserta?.nm_siswa }}
            </h4>
        </div>
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
