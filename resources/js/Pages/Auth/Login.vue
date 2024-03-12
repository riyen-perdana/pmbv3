<template>
    <Head>
        <title>.:: E-admisi Universitas Islam Negeri Sultan Syarif Kasim Riau ::.</title>
    </Head>
    <div class="col-lg-6 border-start border-dark ">
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
                <h5 class="sub-title mb-3 ">Inputkan Nomor Induk Pegawai dan Kata Sandi</h5>
                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nomor Induk Pegawai <span class="text-danger">*</span></label>
                        <input type="text" v-model="form.nip" ref="refnip" class="form-control" id="nip" :placeholder="phNip" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password-input">Kata Sandi <span class="text-danger">*</span></label>
                        <div class="position-relative auth-pass-inputgroup">
                            <input :type="password.passwordType" v-model="form.password" class="form-control pe-5 password-input" onpaste="return false" :placeholder="phPass" id="password-input" aria-describedby="passwordInput" required>
                            <button @click="switchVisibility" class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success w-100" type="submit">Masuk</button>
                    </div>
                </form>
            </div>
            <div class="mt-5 text-center">
                <p class="mb-0">Lupa Kata Sandi ? <Link href="/forgot-password" class="fw-semibold text-primary text-decoration-underline">Klik Disini</Link></p>
            </div>
        </div>
    </div>
</template>

<script>

import LayoutAuth from '../../Layouts/Auth.vue';
import { reactive, ref, nextTick } from 'vue';
import { router, Head, Link } from '@inertiajs/vue3';
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';

export default {

    layout : LayoutAuth,
    components: {
            Head,
            Link
    },
    props : {
        errors : Object,
        session : Object,
    },

    setup() {

        const refnip = ref(null);
        const phNip  = ref("Nomor Induk Pegawai");
        const phPass = ref("Kata Sandi");

        const form = reactive ({
            nip : '',
            password : '',
        });

        const password = reactive ({
            passwordType : "password",
        });

        const clearAllData = () => {
            form.nip = '',
            form.password = '',
            nextTick(() => {
                refnip.value.focus();
            });
        }

        const submit = () => {
            //Send Data to Server
            router.post('/login', {
                //data
                nip : form.nip,
                password : form.password,
            },
            {
                onError : () => {
                    createToast(
                        {
                            title: 'Error',
                            description: 'Maaf, Nomor Induk Pegawai atau Kata Sandi Anda Salah.'
                        },{
                            type: 'danger',
                            showIcon: 'true',
                            transition: 'zoom',
                        }
                    )
                    clearAllData()
                }
            });
        }

        const switchVisibility = () => password.passwordType = password.passwordType === "password" ? "text" :"password" ;

        return {switchVisibility, form, password, submit, phNip, phPass, refnip}
    },
}
</script>

<style>
    .title {
        font-size: 1.5em;
        color : #405189 !important;
        margin-bottom: 5px;
    }

    .sub-title {
        font-size: 1em;
        color : #405189 !important;
        margin-bottom: 5px;
    }

    .mosha__toast__content {
        font-family: "Rubik",sans-serif !important;
    }
</style>
