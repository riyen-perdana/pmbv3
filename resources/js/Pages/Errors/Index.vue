<template>
    <Head>
        <title>.:: E-admisi Universitas Islam Negeri Sultan Syarif Kasim Riau ::.</title>
    </Head>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">

        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden p-0">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-4 text-center">
                        <div class="error-500 position-relative">
                            <img src="../../../../public/images/error500.png" alt="" class="img-fluid error-500-img error-img" />
                            <h1 class="title text-muted">{{ status }}</h1>
                        </div>
                        <div>
                            <h4>{{ title }}</h4>
                            <p class="text-muted w-75 mx-auto">{{ description }}</p>
                            <Link href="/apps/dashboard" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Kembali Ke Dashboard</Link>
                        </div>
                    </div><!-- end col-->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth-page content -->
    </div>
<!-- end auth-page-wrapper -->
</template>

<script>
import { Head, Link } from '@inertiajs/vue3';
  export default {
    components : {
      Head, Link
    },
    props: {
      status: Number,
    },
    computed : {
        title() {
          return {
            503: 'Perbaikan',
            500: 'Server Kami Bermasalah',
            404: 'Apakah Anda Tersesat ?',
            403: 'Otorisasi Bermasalah',
            405: 'Metode Tidak Diizinkan'
          }[this.status]
        },
        description() {
          return {
            503: 'Situs dalam perbaikan, Silahkan kembali beberapa saat lagi.',
            500: 'Silahkan kembali beberapa saat lagi.',
            404: 'Halaman yang anda cari tidak kami temukan.',
            403: 'Maaf, anda tidak diizinkan mengakses halaman ini',
            405: 'Maaf, Metode yang anda gunakan tidak diizinkan',
          }[this.status]
        },
    }
  }
</script>
