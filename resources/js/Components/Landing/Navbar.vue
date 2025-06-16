<template>
    <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
        <div class="container">
            <div class="navbar-brand-box horizontal-logo">
              <Link href="/" class="logo-light">
                <span class="logo-lg">
                    <div class="d-flex flex-row gap-2 mt-1">
                        <img src="../../../../public/images/logo-uin.png" height="60px" />
                        <div class="d-inline-flex flex-column align-items-start">
                            <div class="judul fw-semibold" style="color: black;">E-Admisi</div>
                            <div class="sub-judul fw-semibold" style="color: black;">Universitas Islam Negeri Sultan Syarif Kasim Riau</div>
                        </div>
                    </div>
                </span>
              </Link>
            </div>
            <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mt-2 mt-lg-0 ms-auto" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-semibold" href="/#hero">Beranda</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link fs-14 fw-semibold" href="/#kelulusan">Kelulusan</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-semibold" href="/#pembayaran">Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-semibold" href="/#jalur">Jalur Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-14 fw-semibold" href="/#footer">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

onMounted(() => {
    document.addEventListener("scroll", function () {
        var pageTopbar = document.getElementById("navbar");
        if (pageTopbar) {
          document.body.scrollTop >= 50 || document.documentElement.scrollTop >= 50 ? pageTopbar.classList.add(
            "is-sticky") : pageTopbar.classList.remove("is-sticky");
        }
      });
});

</script>
