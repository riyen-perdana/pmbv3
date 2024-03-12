<template>
    <Modal id="mOtoritas" size="modal-lg" @close="closeModal">
        <template #modalTitle>{{ props.isEdit == false ? "Tambah Data" : "Ubah Data" }} Otoritas</template>
        <template #modalBody>
            <form @submit.prevent="submitData">
                <div class="mb-3">
                    <label for="txtOtorisasi" class="form-label">Jenis Otorisasi</label>
                    <input v-model="form.nm_role" class="form-control" :class="{ 'is-invalid': $page.props.errors.nm_role }"
                        type="text" placeholder="Isikan Jenis Otorisasi Pengguna" id="txtOtorisasi" autofocus>
                    <div v-if="$page.props.errors.nm_role" class="invalid-feedback">
                        {{ $page.props.errors.nm_role }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="dtPermission" class="form-label">Permission</label><br>
                    <div class="form-check form-check-inline" v-for="(permission, index) in data" :key="index">
                        <input class="form-check-input" type="checkbox" id="dtPermission" :value="permission.name"
                            v-model="form.permission">
                        <label class="form-check-label" for="dtPermission">
                            {{ permission.name }}
                        </label>
                    </div>
                    <div v-if="$page.props.errors.permission" class="invalid-feedback">
                        {{ $page.props.errors.permission }}
                    </div>
                </div>
            </form>
        </template>
        <template #modalFooter>
            <button type="button" class="btn btn-light" @click="closeModal()">Tutup</button>
            <button type="button" class="btn btn-primary" @click="submitData()" :disabled="btnDisabled">{{ props.isEdit
                ==
                false ? "Simpan" : "Ubah"
            }}</button>
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

const emit = defineEmits(['close', 'submitData'])

const btnDisabled = ref(false)

const props = defineProps({
    show: Boolean,
    id: Number,
    data: Array,
    isEdit: Boolean,
    dataEdit: Object
})

const form = useForm({
    nm_role: '',
    permission: []
})

const modal = ref(null);

const closeModal = () => {
    modal.value.hide()
    emit('close')
    form.reset()
    router.reload()
}

const submitData = () => {
    if (props.id != 0) {
        router.put(`/apps/roles/${props.id}`,{
            nm_role : form.nm_role,
            permission : form.permission
        },{
            preserveScroll :true,
            preserveState : true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Perubahan Data Otoritas Berhasil Dilakukan.'
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
        router.post('/apps/roles', {
            nm_role: form.nm_role,
            permission: form.permission
        }, {
            preserveScroll: true,
            onSuccess: () => {
                closeModal(),
                    createToast(
                        {
                            title: 'Berhasil',
                            description: 'Penambahan Data Otoritas Berhasil Dilakukan.'
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
}

const openModal = () => {
    modal.value.show();
}

onMounted(() => {
    modal.value = useModal('#mOtoritas')
});

onUnmounted(() => {
    closeModal();
})

watchEffect(() => {
    if (props.show) {
        openModal()
        if (props.id != 0) {
            form.nm_role = props.dataEdit?.name
            form.permission = props.dataEdit.permissions?.map(obj => obj.name)
        }
    }
});

</script>
