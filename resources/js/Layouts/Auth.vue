<template>
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
            <div class="bg-overlay"></div>
            <!-- auth-page content -->
            <div class="auth-page-content overflow-hidden pt-lg-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card overflow-hidden">
                                <div class="row g-0">
                                    <div class="col-lg-6 d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block">
                                        <div class="p-lg-5 p-4 auth-one-bg h-100">
                                            <div class="bg-overlay"></div>
                                            <div class="position-relative h-100 d-flex flex-column">
                                                <div class="mt-auto">
                                                    <!-- end carousel -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <slot />
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                    </div>
                    <!-- end row -->
                </div>
                <footer class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <p class="mb-0 text-dark">
                                        &copy; Pusat Teknologi Informasi dan Pangkalan Data Universitas Islam Negeri Sultan Syarif Kasim Riau
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end container -->
            </div>

            <!-- end auth page content -->
        </div>
    </template>

    <script>
    export default {

    }
    </script>
