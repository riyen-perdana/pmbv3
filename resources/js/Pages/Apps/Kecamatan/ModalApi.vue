<template>
    <Modal id="mAPIKabkot" size="modal-lg" @close="closeModalAPI">
        <template #modalTitle>Get API Data Kecamatan</template>
        <template #modalBody>
            <form @submit.prevent="prosesAPI()">
                <div class="col-md-12 lg-12 mb-3">
                    <label for="txtProvinsi" class="form-label">Pilih Provinsi</label>
                    <select v-model="form.cboProvinsi" class="form-select" :class="{ 'is-invalid': errorCbo }">
                        <option disabled value="">Pilih Provinsi</option>
                        <option v-for="(prov, index) in props.data" :key="index" :value="prov.id">
                            {{ prov.id }} | {{ prov.nm_provinsi }}
                        </option>
                    </select>
                    <div v-if="errorCbo" class="invalid-feedback">
                        {{ errorCbo }}
                    </div>
                </div>
            </form>
            <div id="pgb" v-if="isShowPb">
                <div class="spinner-border text-danger" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="row py-2 provinsi">
                    <span class="fw-semibold">{{ messageAction }}</span>
                </div>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        :style="`width: ${persentase}%;`" aria-valuemin="0" aria-valuemax="100">{{ persentase }}%</div>
                </div>
            </div>
        </template>
        <template #modalFooter>
            <button :disabled="btnGetAPI" type="button" class="btn btn-light" @click="closeModalAPI()">Tutup</button>
            <button :disabled="btnGetAPI" type="submit" @click="prosesAPI" class="btn btn-primary">
                Proses API
            </button>
        </template>
    </Modal>
</template>

<script setup>

</script>

<style lang="scss" scoped>

</style>
