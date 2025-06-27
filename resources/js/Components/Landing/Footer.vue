<template>
    <!-- Start footer -->
    <footer class="custom-footer bg-dark py-5 position-relative" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mt-4">
                    <div>
                        <div class="d-flex flex-row gap-2 mt-1">
                            <img src="../../../../public/images/logo-uin.png" height="60px" />
                            <div class="d-inline-flex flex-column align-items-start">
                                <div class="judul fw-semibold">E-Admisi</div>
                                <div class="sub-judul fw-semibold">Universitas Islam Negeri Sultan
                                    Syarif Kasim Riau</div>
                            </div>
                        </div>
                        <div class="mt-4 fs-13">
                            <p class="ff-secondary">Jl. H.R. Soebrantas KM. 15 No. 155 <br>Kec. Tuah Madani - Pekanbaru 28298 <br>PO Box. 1004 Telepon (0761) 562051<br>Faksimili (0761) 562052</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 ms-lg-auto">
                    <div class="row">
                        <div class="col-sm-4 mt-4">

                        </div>
                        <div class="col-sm-4 mt-4">
                            <h5 class="text-white mb-0">Sistem Informasi</h5>
                            <div class="text-muted mt-3">
                                <ul class="list-unstyled ff-secondary footer-list fs-14">
                                    <li><a class="support" href="https://uin-suska.ac.id">Website Utama</a></li>
                                    <li><a class="support" href="https://sireg.uin-suska.ac.id/beranda-sireg-uin-suska-riau.html">Aplikasi Sireg</a></li>
                                    <li><a class="support" href="https://iraise.uin-suska.ac.id">Aplikasi Iraise</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4 mt-4">
                            <h5 class="text-white mb-0">Support</h5>
                            <div class="text-muted mt-3">
                                <ul class="list-unstyled ff-secondary footer-list fs-14">
                                    <li><Link class="support" href="https://wa.me/628117627773">C3 [08117627773 - WA Only]</Link></li>
                                    <li><Link class="support" href="https://wa.me/6285376037244">085376037244 [Akademik]</Link></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row text-center text-sm-start align-items-center mt-5">
                <div class="col-sm-6">

                    <div>
                        <p class="cp-right mb-0">
                            Pusat Teknologi Informasi dan Pangkalan Data UIN SUSKA Riau @2024
                        </p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end mt-3 mt-sm-0">
                        <ul class="list-inline mb-0 footer-social-link">
                            <li class="list-inline-item">
                                <Link href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-facebook-fill"></i>
                                    </div>
                                </Link>
                            </li>
                            <li class="list-inline-item">
                                <Link href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-github-fill"></i>
                                    </div>
                                </Link>
                            </li>
                            <li class="list-inline-item">
                                <Link href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-linkedin-fill"></i>
                                    </div>
                                </Link>
                            </li>
                            <li class="list-inline-item">
                                <Link href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-google-fill"></i>
                                    </div>
                                </Link>
                            </li>
                            <li class="list-inline-item">
                                <Link href="javascript: void(0);" class="avatar-xs d-block">
                                    <div class="avatar-title rounded-circle">
                                        <i class="ri-dribbble-line"></i>
                                    </div>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<style>
.cp-right {
    font-size: 13px !important;
}

.support {
    font-size: 12px !important;
}
</style>
