<template>
    <!-- ========== App Menu ========== -->
    <div class="app-menu navbar-menu">
        <div id="scrollbar">
            <div class="container-fluid">
                <div v-if="$page.props.auth.user && $page.props.auth.user.roles[0].id != 7">
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <Link class="nav-link menu-link" href="/apps/dashboard">
                            <i class="bx bxs-dashboard"></i> <span data-key="t-dashboards">Dashboard</span>
                            </Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link menu-link" href="#sidebarMD" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarMD">
                            <i class="bx bx-data"></i> <span data-key="t-sidebarMD">Master Data</span>
                            </Link>
                            <div class="collapse menu-dropdown" id="sidebarMD">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <Link class="nav-link menu-link" href="/apps/jalur-masuk">
                                        <i class="bx bxs-map-alt"></i> <span data-key="t-jalur-masuk">Jalur Masuk</span>
                                        </Link>
                                    </li>
                                    <li class="nav-item">
                                        <Link class="nav-link menu-link" href="/apps/rektor">
                                        <i class="bx bx-group"></i> <span data-key="t-rektor">Rektor</span>
                                        </Link>
                                    </li>
                                    <li class="nav-item">
                                        <Link class="nav-link menu-link" href="/apps/akreditasi">
                                        <i class="bx bx-bar-chart"></i> <span data-key="t-rektor">Akreditasi</span>
                                        </Link>
                                    </li>
                                    <li class="nav-item">
                                        <Link class="nav-link menu-link" href="/apps/jenjang">
                                        <i class="bx bx-line-chart"></i><span data-key="t-fakultas">Jenjang</span>
                                        </Link>
                                    </li>
                                    <li class="nav-item">
                                        <Link class="nav-link menu-link" href="/apps/agama">
                                        <i class="bx bx-book-alt"></i><span data-key="t-fakultas">Agama</span>
                                        </Link>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="#sidebarArea" data-bs-toggle="collapse"
                                            role="button" aria-expanded="false" aria-controls="sidebarAdvanceUI">
                                            <i class="bx bx-area"></i> <span data-key="t-rektor">Area</span>
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarArea">
                                            <li class="nav-item">
                                                <Link href="/apps/provinsi" class="nav-link" data-key="t-provinsi">Provinsi</Link>
                                            </li>
                                            <li class="nav-item">
                                                <Link href="/apps/kabkot" class="nav-link" data-key="t-kabupaten-kota">
                                                Kabupaten/Kota
                                                </Link>
                                            </li>
                                            <li class="nav-item">
                                                <Link href="/apps/kecamatan" class="nav-link" data-key="t-kecamatan">Kecamatan
                                                </Link>
                                            </li>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="#sidebarSekolah" data-bs-toggle="collapse" role="button"
                                            aria-expanded="false" aria-controls="sidebarAdvanceUI">
                                            <i class="bx bxs-bank"></i> <span data-key="t-rektor">Pendidikan</span>
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarSekolah">
                                            <li class="nav-item">
                                                <Link href="/apps/sekolah" class="nav-link" data-key="t-provinsi">Menengah
                                                </Link>
                                            </li>
                                            <li class="nav-item">
                                                <Link href="/apps/kabkot" class="nav-link" data-key="t-kabupaten-kota">Tinggi
                                                </Link>
                                            </li>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="#sidebarPenilaian" data-bs-toggle="collapse" role="button"
                                            aria-expanded="false" aria-controls="sidebarAdvanceUI">
                                            <i class="bx bxs-bank"></i> <span data-key="t-rektor">Jalur Prestasi</span>
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarPenilaian">
                                            <li class="nav-item">
                                                <Link href="/apps/prestasi" class="nav-link" data-key="t-prestasi">Bidang Prestasi</Link>
                                            </li>
                                            <li class="nav-item">
                                                <Link href="/apps/tingkat" class="nav-link" data-key="t-tingkat">Tingkat Prestasi</Link>
                                            </li>
                                            <li class="nav-item">
                                                <Link href="/apps/jenis" class="nav-link" data-key="t-inkel">Kategori Prestasi
                                                </Link>
                                            </li>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link menu-link" href="#sidebarMD" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarMD">
                            <i class="bx bx-data"></i> <span data-key="t-sidebarMD">Authentikasi</span>
                            </Link>
                            <div class="collapse menu-dropdown" id="sidebarAuth">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <Link class="nav-link menu-link" href="/apps/permissions">
                                            <i class="bx bxs-user-account"></i> <span data-key="t-user">Permission</span>
                                        </Link>
                                    </li>
                                    <li class="nav-item">
                                        <Link class="nav-link menu-link" href="/apps/roles">
                                            <i class="bx bxs-key"></i> <span data-key="t-role">Otoritas</span>
                                        </Link>
                                    </li>
                                    <li class="nav-item">
                                        <Link class="nav-link menu-link" href="/apps/pengguna">
                                            <i class="bx bx-fingerprint"></i> <span data-key="t-permission">Pengguna</span>
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link menu-link" href="#sidebarUnor" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarUnor">
                            <i class="bx bx-data"></i> <span data-key="t-sidebarUnor">Unit Organisasi</span>
                            </Link>
                            <div class="collapse menu-dropdown" id="sidebarUnor">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <Link class="nav-link menu-link" href="/apps/fakultas">
                                            <i class="bx bx-building-house"></i> <span data-key="t-user">Fakultas</span>
                                        </Link>
                                    </li>
                                    <li class="nav-item">
                                        <Link class="nav-link menu-link" href="/apps/prodi">
                                            <i class="bx bxs-key"></i> <span data-key="t-role">Program Studi</span>
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link menu-link" href="#sidebarPeserta" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarPeserta">
                            <i class="bx bx-data"></i> <span data-key="t-sidebarPeserta">Peserta</span>
                            </Link>
                            <div class="collapse menu-dropdown" id="sidebarPeserta">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item" style="width: 200px !important;">
                                        <Link class="nav-link menu-link" href="/apps/peserta">
                                            <i class="bx bx-book-bookmark"></i> <span data-key="t-peserta">Undangan Mandiri</span>
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div v-else-if="$page.props.auth.user && $page.props.auth.user.roles[0].id == 7">
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <Link class="nav-link menu-link" href="/peserta/dashboard">
                            <i class="bx bxs-dashboard"></i> <span data-key="t-dashboards">Dashboard</span>
                            </Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link menu-link" href="#sidebarProdi" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarProdi">
                            <i class="bx bx-data"></i> <span data-key="t-sidebarProdi">Fakultas {{ $page.props.auth.fakultas[0].nm_fakultas }}</span>
                            </Link>
                            <div class="collapse menu-dropdown" id="sidebarProdi">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item" v-for="(prodi,index) in $page.props.auth.prodi" :key="prodi.id">
                                        <Link class="nav-link menu-link" :href="`/apps/dekan/prodi/${prodi.id}`">
                                            <i class="bx bx-building-house"></i> <span data-key="t-prodi">{{ prodi.nm_prodi }}</span>
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div v-else>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <Link class="nav-link menu-link" href="/peserta/dashboard">
                            <i class="bx bxs-dashboard"></i> <span data-key="t-dashboards">Dashboard</span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

export default {
    components: {
        Link
    },
    setup() {

      const page = usePage()
      return { page }


    },
}
</script>
