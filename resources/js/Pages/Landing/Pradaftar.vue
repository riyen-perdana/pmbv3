<template>

    <Head>
        <title>.:: E-admisi Universitas Islam Negeri Sultan Syarif Kasim Riau ::.</title>
    </Head>
    <div class="col-lg-6 border-start border-dark mh-100">
        <div class="p-4">
            <div class="d-flex flex-row gap-2 mx-auto">
                <div>
                    <img src="../../../../public/images/logo-uin.png" height="67px" />
                </div>
                <div class="mt-1">
                    <h5 class="title">E-Admisi</h5>
                    <h5 class="sub-title">Universitas Islam Negeri Sultan Syarif Kasim Riau</h5>
                </div>
            </div>
            <div class="mt-4">
                <h3 class="mb-3 ">Pradaftar</h3>

                <!-- Danger Alert -->
                <div v-if="$page.props.session.error" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="fw-semibold" style="font-size: 12px;">{{ $page.props.session.error }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <form @submit.prevent="submit">
                    <div class="mb-2">
                        <label for="nisn" class="form-label">Nomor Induk Siswa Nasional<span
                                class="text-danger"> *</span></label>
                        <input type="text" v-model="form.nisn" ref="refnisn" class="form-control" required numeric autofocus>
                        <div v-if="$page.props.errors.nisn" class="text-danger mb-2">
                            {{ $page.props.errors.nisn }}
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="npsn" class="form-label">Nomor Pokok Sekolah Nasional<span
                                class="text-danger"> *</span></label>
                        <input type="text" v-model="form.npsn" ref="refnpsn" class="form-control" required numeric>
                        <div v-if="$page.props.errors.npsn" class="text-danger mb-2">
                            {{ $page.props.errors.npsn }}
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="tglLahir" class="form-label">Tanggal Lahir<span
                                class="text-danger"> *</span></label>
                        <input type="date" v-model="form.tglLhr" ref="tglLhr" class="form-control" required>
                        <div v-if="$page.props.errors.tglLhr" class="text-danger mb-2">
                            {{ $page.props.errors.tglLhr }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Nomor Telepon/HP/WA Aktif<span
                                class="text-danger"> *</span></label>
                        <input type="text" v-model="form.telepon" ref="telepon" class="form-control" required>
                        <div v-if="$page.props.errors.telepon" class="text-danger mb-2">
                            {{ $page.props.errors.telepon }}
                        </div>
                    </div>

                    <div class="mt-4 justify-content-end d-flex">
                        <button class="btn btn-success w-25 mx-2" type="submit" :disabled="btnDisabled">Masuk</button>
                        <Link href="/" class="btn btn-warning w-25">Kembali</Link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import Layout from '@/Layouts/Auth.vue';
import { ref, nextTick } from 'vue';

defineOptions({ layout: Layout });


const form = useForm({
    nisn: '',
    npsn : '',
    nik: '',
    nama: '',
    telepon: '',
});

const btnDisabled = ref(false);
const refnisn = ref(null);

const clearAllData = () => {
    form.reset()
    nextTick(() => {
        refnisn.value.focus();
    });
}

const submit = async() => {
    router.post('/pradaftar/cek', {
        nisn : form.nisn,
        npsn : form.npsn,
        tglLhr : form.tglLhr,
        telepon : form.telepon
    },{
        preserveScroll : true,
        preserveState : true,
        onError : () => {
            clearAllData()
        },
        onSubmit : () => btnDisabled.value = true,
        onFinish : () => {
            btnDisabled.value = false
            clearAllData()
        }
    })
}
</script>

<style>
.title {
    font-size: 1.5em;
    color: #405189 !important;
    margin-bottom: 5px;
}

.sub-title {
    font-size: 1em;
    color: #405189 !important;
    margin-bottom: 5px;
}

.mosha__toast__content {
    font-family: "Rubik", sans-serif !important;
}
</style>
