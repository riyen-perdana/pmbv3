<template>

    <Head>
        <title>.:: E-admisi Universitas Islam Negeri Sultan Syarif Kasim Riau ::.</title>
    </Head>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="row mb-3 pb-1 p-3">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <div class="flex-grow-1">
                                <Titlebox :isDashboard="true"
                                    subTitle="Dashboard E-Admisi Universitas Islam Negeri Sultan Syarif Kasim Riau" />
                            </div>
                            <Breadcrumb :items="breadcrumbs" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Profil Data Peserta dan Portofolio</h4>
                                </div><!-- end card header -->
                                <div class="card-body form-steps">
                                    <form class="vertical-navs-step">
                                        <div class="row gy-5">
                                            <div class="col-lg-3">
                                                <div class="pt-4 mb-4 mb-lg-2 pb-lg-2">
                                                    <div v-if="$page.props.auth.peserta?.foto_siswa">
                                                        <div class="row g-4">
                                                            <div class="foto-center">
                                                                <div class="mx-auto">
                                                                    <img
                                                                        :src="`/storage/fotopeserta/${$page.props.auth.peserta?.foto_siswa}`"
                                                                        alt="user-img"
                                                                        class="profil-peserta rounded-circle"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col text-center">
                                                            <div class="p-2">
                                                                <h5 class="mb-1">{{ $page.props.auth.peserta.nm_siswa }}</h5>
                                                                <p class="text-muted mb-0">{{ $page.props.auth.peserta.nisn_siswa }}</p>
                                                                <p class="text-muted mb-0">{{ $page.props.auth.peserta.nik_siswa }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nav flex-column custom-nav nav-pills" role="tablist"
                                                    aria-orientation="vertical">
                                                    <button class="nav-link active" id="v-data-pribadi"
                                                        data-bs-toggle="pill" data-bs-target="#v-tab-data-pribadi"
                                                        type="button" role="tab" aria-controls="v-tab-data-pribadi"
                                                        aria-selected="true">
                                                        <span class="step-title me-2">
                                                            <i class="ri-close-circle-fill step-icon me-2"></i>
                                                            Langkah 1
                                                        </span>
                                                        Data Pribadi
                                                    </button>
                                                    <button class="nav-link" id="v-data-pilihan"
                                                        data-bs-toggle="pill" data-bs-target="#v-tab-data-pilihan"
                                                        type="button" role="tab" aria-controls="v-tab-data-pilihan"
                                                        aria-selected="false">
                                                        <span class="step-title me-2">
                                                            <i class="ri-close-circle-fill step-icon me-2"></i>
                                                            Langkah 2
                                                        </span>
                                                        Data Pilihan Program Studi
                                                    </button>
                                                    <button class="nav-link" id="v-data-prestasi"
                                                        data-bs-toggle="pill" data-bs-target="#v-tab-data-prestasi"
                                                        type="button" role="tab" aria-controls="v-tab-data-prestasi"
                                                        aria-selected="false">
                                                        <span class="step-title me-2">
                                                            <i class="ri-close-circle-fill step-icon me-2"></i>
                                                            Langkah 3
                                                        </span>
                                                        Data Prestasi Non Akademik
                                                    </button>
                                                    <button class="nav-link" id="v-pills-finish-tab"
                                                        data-bs-toggle="pill" data-bs-target="#v-pills-finish"
                                                        type="button" role="tab" aria-controls="v-pills-finish"
                                                        aria-selected="false">
                                                        <span class="step-title me-2">
                                                            <i class="ri-close-circle-fill step-icon me-2"></i>
                                                            Langkah 4
                                                        </span>
                                                        Nilai Rapor
                                                    </button>
                                                    <button class="nav-link" id="v-pills-finish-tab"
                                                        data-bs-toggle="pill" data-bs-target="#v-pills-finish"
                                                        type="button" role="tab" aria-controls="v-pills-finish"
                                                        aria-selected="false">
                                                        <span class="step-title me-2">
                                                            <i class="ri-close-circle-fill step-icon me-2"></i>
                                                            Langkah 5
                                                        </span>
                                                        Cetak kartu Peserta
                                                    </button>
                                                </div>
                                                <!-- end nav -->
                                            </div> <!-- end col-->
                                            <div class="col-lg-9">
                                                <div class="px-lg-4">
                                                    <div class="tab-content">

                                                        <!-- Data Pribadi -->
                                                        <Dapri title="Data Pribadi" :agama="agama" :peserta="$page.props.auth.peserta"
                                                            :provinsi="provinsi" :sekolahData="sekolah" />

                                                        <!-- Data Pilihan -->
                                                        <Pilihan title="Pilihan Program Studi" :peserta="$page.props.auth.peserta" :prodi_12="props.prodi_12" :prodi_34="props.prodi_34" />

                                                        <!-- Data Prestasi Non Akademik -->
                                                        <Prestasi title="Data Prestasi Non Akademik" :bidang="props.bidang" :inkel ="props.inkel" :tingkat="props.tingkat" :prestasi="props.prestasi" />

                                                        <!-- <div class="tab-pane fade" id="v-pills-bill-address"
                                                            role="tabpanel" aria-labelledby="v-pills-bill-address-tab">
                                                            <div>
                                                                <h5>Shipping Address</h5>
                                                                <p class="text-muted">Fill all information below</p>
                                                            </div>

                                                            <div>
                                                                <div class="row g-3">
                                                                    <div class="col-12">
                                                                        <label for="address"
                                                                            class="form-label">Address</label>
                                                                        <input type="text" class="form-control"
                                                                            id="address" placeholder="1234 Main St">
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <label for="address2" class="form-label">Address
                                                                            2 <span
                                                                                class="text-muted">(Optional)</span></label>
                                                                        <input type="text" class="form-control"
                                                                            id="address2"
                                                                            placeholder="Apartment or suite">
                                                                    </div>

                                                                    <div class="col-md-5">
                                                                        <label for="country"
                                                                            class="form-label">Country</label>
                                                                        <select class="form-select" id="country">
                                                                            <option value="">Choose...</option>
                                                                            <option>United States</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <label for="state"
                                                                            class="form-label">State</label>
                                                                        <select class="form-select" id="state">
                                                                            <option value="">Choose...</option>
                                                                            <option>California</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <label for="zip" class="form-label">Zip</label>
                                                                        <input type="text" class="form-control" id="zip"
                                                                            placeholder="">
                                                                    </div>
                                                                </div>

                                                                <hr class="my-4 text-muted">

                                                                <div class="form-check mb-2">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="same-address">
                                                                    <label class="form-check-label"
                                                                        for="same-address">Shipping address is the same
                                                                        as my billing address</label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="save-info">
                                                                    <label class="form-check-label" for="save-info">Save
                                                                        this information for next time</label>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                                <button type="button"
                                                                    class="btn btn-light btn-label previestab"
                                                                    data-previous="v-pills-bill-info-tab"><i
                                                                        class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                                    Back to Billing Info</button>
                                                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab
nexttab" data-nexttab="v-pills-payment-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to
                                                                    Payment</button>
                                                            </div>
                                                        </div>
                                                        end tab pane -->
                                                        <!-- <div class="tab-pane fade" id="v-pills-payment" role="tabpanel"
                                                            aria-labelledby="v-pills-payment-tab">
                                                            <div>
                                                                <h5>Payment</h5>
                                                                <p class="text-muted">Fill all information below</p>
                                                            </div>

                                                            <div>
                                                                <div class="my-3">
                                                                    <div class="form-check form-check-inline">
                                                                        <input id="credit" name="paymentMethod"
                                                                            type="radio" class="form-check-input"
                                                                            checked required>
                                                                        <label class="form-check-label"
                                                                            for="credit">Credit card</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input id="debit" name="paymentMethod"
                                                                            type="radio" class="form-check-input"
                                                                            required>
                                                                        <label class="form-check-label"
                                                                            for="debit">Debit card</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input id="paypal" name="paymentMethod"
                                                                            type="radio" class="form-check-input"
                                                                            required>
                                                                        <label class="form-check-label"
                                                                            for="paypal">PayPal</label>
                                                                    </div>
                                                                </div>

                                                                <div class="row gy-3">
                                                                    <div class="col-md-12">
                                                                        <label for="cc-name" class="form-label">Name on
                                                                            card</label>
                                                                        <input type="text" class="form-control"
                                                                            id="cc-name" placeholder="" required>
                                                                        <small class="text-muted">Full name as displayed
                                                                            on card</small>
                                                                        <div class="invalid-feedback">
                                                                            Name on card is required
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label for="cc-number" class="form-label">Credit
                                                                            card number</label>
                                                                        <input type="text" class="form-control"
                                                                            id="cc-number" placeholder="" required>
                                                                        <div class="invalid-feedback">
                                                                            Credit card number is required
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <label for="cc-expiration"
                                                                            class="form-label">Expiration</label>
                                                                        <input type="text" class="form-control"
                                                                            id="cc-expiration" placeholder="" required>
                                                                        <div class="invalid-feedback">
                                                                            Expiration date required
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <label for="cc-cvv"
                                                                            class="form-label">CVV</label>
                                                                        <input type="text" class="form-control"
                                                                            id="cc-cvv" placeholder="" required>
                                                                        <div class="invalid-feedback">
                                                                            Security code required
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                                <button type="button"
                                                                    class="btn btn-light btn-label previestab"
                                                                    data-previous="v-pills-bill-address-tab"><i
                                                                        class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                                                    Back to Shipping Info</button>
                                                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab
nexttab" data-nexttab="v-pills-finish-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Order
                                                                    Complete</button>
                                                            </div>
                                                        </div> -->
                                                        <!-- end tab pane -->
                                                        <!-- <div class="tab-pane fade" id="v-pills-finish" role="tabpanel"
                                                            aria-labelledby="v-pills-finish-tab">
                                                            <div class="text-center pt-4 pb-2">

                                                                <div class="mb-4">
                                                                    <lottie colors="primary:#0ab39c,secondary:#405189"
                                                                        :options="defaultOptions" :height="120"
                                                                        :width="120" />
                                                                </div>
                                                                <h5>Your Order is Completed !</h5>
                                                                <p class="text-muted">You Will receive an order
                                                                    confirmation email with details of your order.</p>
                                                            </div>
                                                        </div> -->
                                                        <!-- end tab pane -->
                                                    </div>
                                                    <!-- end tab content -->
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </form>
                                </div>
                            </div>
                            <!-- end -->
                        </div>
                        <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import LayoutApp from '@/Layouts/App.vue';
import Tilebox from '@/Components/Tilebox.vue';
import Titlebox from '@/Components/Titlebox.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Dapri from '@/Components/Portofolio/Dapri.vue';
import Pilihan from '@/Components/Portofolio/Pilihan.vue';
import Prestasi from '@/Components/Portofolio/Prestasi.vue';

defineOptions({ layout: LayoutApp });

const breadcrumbs = computed(() => {
    return [
        {
            label: 'Peserta',
            isActive: false,
        },
        {
            label: 'Dashboard',
            url: 'dashboard'
        }
    ]
});

const props = defineProps({
    provinsi: Object,
    agama: Object,
    peserta: Object,
    sekolah: Object,
    prodi_12: Object,
    prodi_34: Object,
    bidang: Object,
    tingkat: Object,
    inkel : Object,
    prestasi : Object
});

</script>

<style>
.btn-mr {
    margin-right: 5px;
}

td.r_atas {
    vertical-align: top;
}

.card-header {
    border-bottom: 1px solid #e9ebec;
}

.profil-peserta {
    height: 100px;
    width: 100px;
}

.foto-center {
    text-align: center !important;
}
</style>
