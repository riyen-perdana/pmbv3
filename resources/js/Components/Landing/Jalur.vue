<template>
        <!-- start plan -->
        <section class="section" id="jalur">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h3 class="mb-3 fw-bold text-uppercase">Jalur Masuk</h3>
                            <p class="text-muted mb-4">Jalur Masuk Universitas Islam Negeri Sultan Syarif Kasim Riau</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="card plan-box mb-0 border border-dark shadow-lg">
                            <div class="card-body p-4 m-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fw-bold">Undangan Mandiri</h5>
                                        <p class="text-muted mb-0">Seleksi Jalur Prestasi</p>
                                    </div>
                                    <div class="avatar-sm">
                                        <div class="avatar-title bg-light rounded-circle text-primary">
                                            <i class="ri-book-mark-line fs-20"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-4 text-center">
                                    <h4>Tanggal Penting</h4>
                                </div>

                                <div>
                                    <ul class="list-unstyled text-muted vstack gap-3">
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Pradaftar</b><br> [01 Juli 2025 - 16 Juli 2025]
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Pembayaran Pendaftaran</b><br> [01 Juli 2025 - 16 Juli 2025]
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Pendaftaran</b><br> [01 Juli 2025 - 16 Juli 2025]
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Cetak Kartu Peserta</b><br>[01 Juli 2025 - 16 Juli 2025]
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Verifikasi</b><br> [01 Juli 2025 - 16 Juli 2025]
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 text-success me-1">
                                                    <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <b>Pengumuman Kelulusan</b><br>[19 Juli 2025]
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="mt-4 justify-content-end d-flex">
                                        <Link href="/syarat-ketentuan#latar-belakang" class="btn btn-danger w-100">Syarat dan Ketentuan</Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!-- end container -->
        </section>
        <!-- end plan -->
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
