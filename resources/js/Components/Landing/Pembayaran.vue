<template>
    <!-- start faqs -->
    <section class="section" id="pembayaran">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h1 class="mb-3 fw-bold text-uppercase">Tata Cara Pembayaran</h1>
                        <p class="text-muted mb-4">Pembayaran Pendaftaran Dilakukan Dengan Melibatkan Dua Bank Mitra,
                            Yaitu Bank Syariah Indonesia (BSI) Dan Bank Tabungan Negara Syariah (BTNS)</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row g-lg-5 g-4">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0 me-1">
                            <i class="ri-bank-line fs-24 align-middle text-success me-1"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fw-bold">Bank Syariah Indonesia (BSI)</h5>
                        </div>
                    </div>
                    <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box"
                        id="genques-accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="genques-headingOne">
                                <button class="accordion-button fw-semibold fs-14" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#genques-collapseOne" aria-expanded="true"
                                    aria-controls="genques-collapseOne">
                                    Anjungan Tunai Mandiri (ATM)
                                </button>
                            </h2>
                            <div id="genques-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="genques-headingOne" data-bs-parent="#genques-accordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Masukkan Kartu ATM BSI</li>
                                        <li>Masukkan PIN Kartu ATM</li>
                                        <li>Pilih Menu Pembayaran/Pembelian</li>
                                        <li>Pilih Menu Akademik/Institusi</li>
                                        <li>Masukkan kode institusi dan ID pembayaran dengan format : 5560+(Kode
                                            Pembayaran pradaftar)</li>
                                        <li>Nama Pendaftar akan muncul di layar ATM, pastikan nama dan jumlah sudah
                                            sesuai</li>
                                        <li>Tekan Proses Pembayaran</li>
                                        <li>Selesai</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="genques-headingTwo">
                                <button class="accordion-button fw-semibold fs-14 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#genques-collapseTwo"
                                    aria-expanded="false" aria-controls="genques-collapseTwo">
                                    Mobile Banking
                                </button>
                            </h2>
                            <div id="genques-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="genques-headingTwo" data-bs-parent="#genques-accordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Buka Aplikasi BSI Mobile</li>
                                        <li>Pilih Menu Bayar</li>
                                        <li>Pilih Menu Akademik</li>
                                        <li>Pilih Nomor Rekening</li>
                                        <li>Ketik 5560 di bagian Nama Akademik</li>
                                        <li>Masukkan Kode pembayaran dari pradaftar ke ID Pelanggan</li>
                                        <li>Tekan Selanjutnya</li>
                                        <li>Masukkan PIN BSI Mobile</li>
                                        <li>Pastikan Nama dan Nominal sudah sesuai, Klik Selanjutnya</li>
                                        <li>Selesai</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="genques-headingThree">
                                <button class="accordion-button fw-semibold fs-14 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#genques-collapseThree"
                                    aria-expanded="false" aria-controls="genques-collapseThree">
                                    ATM Bersama
                                </button>
                            </h2>
                            <div id="genques-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="genques-headingThree" data-bs-parent="#genques-accordion">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Masukkan kartu ATM</li>
                                        <li>Masukkan PIN kartu</li>
                                        <li>Pilih menu Transfer</li>
                                        <li>Pilih Transfer ke Bank Lain atau Antar Bank</li>
                                        <li>Masukkan kode bank BSI (451) + Kode Virtual Account (900) + Kode Institusi (5560) + Kode bayar pradaftar, contoh 45190055601234xxxxxxxx</li>
                                        <li>Masukkan jumlah transfer Rp. 250.000 + <strong>biaya admin Rp. 2.000</strong> Total Rp. 252.000</li>
                                        <li>Tekan benar, layar akan menampilkan konfirmasi Nama Pendaftar dan jumlah transfer, jika benar lanjut</li>
                                        <li>Transaksi selesai</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end accordion-->
                </div>
                <!-- end col -->
                <div class="col-lg-6">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0 me-1">
                            <i class="ri-bank-line fs-24 align-middle text-success me-1"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fw-bold">Bank Tabungan Negara Syariah (BTNS)</h5>
                        </div>
                    </div>

                    <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box"
                        id="privacy-accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="privacy-headingOne">
                                <button class="accordion-button fw-semibold fs-14 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#privacy-collapseOne"
                                    aria-expanded="false" aria-controls="privacy-collapseOne">
                                    Anjungan Tunai Mandiri (ATM)
                                </button>
                            </h2>
                            <div id="privacy-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="privacy-headingOne" data-bs-parent="#privacy-accordion">
                                <div class="accordion-body">

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="privacy-headingTwo">
                                <button class="accordion-button fw-semibold fs-14" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#privacy-collapseTwo" aria-expanded="true"
                                    aria-controls="privacy-collapseTwo">
                                    Mobile Banking
                                </button>
                            </h2>
                            <div id="privacy-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="privacy-headingTwo" data-bs-parent="#privacy-accordion">
                                <div class="accordion-body">

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="privacy-headingThree">
                                <button class="accordion-button fw-semibold fs-14 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#privacy-collapseThree"
                                    aria-expanded="false" aria-controls="privacy-collapseThree">
                                    ATM Bersama
                                </button>
                            </h2>
                            <div id="privacy-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="privacy-headingThree" data-bs-parent="#privacy-accordion">
                                <div class="accordion-body">

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="privacy-headingFour">
                                <button class="accordion-button fw-semibold fs-14 collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#privacy-collapseFour"
                                    aria-expanded="false" aria-controls="privacy-collapseFour">
                                    Teller
                                </button>
                            </h2>
                            <div id="privacy-collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="privacy-headingFour" data-bs-parent="#privacy-accordion">
                                <div class="accordion-body">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end accordion-->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end faqs -->
</template>

<script setup>

</script>
