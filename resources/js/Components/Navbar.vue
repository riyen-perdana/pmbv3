<template>
    <!-- ========== App Menu ========== -->
    <div class="app-menu navbar-menu">
        <div id="scrollbar">
            <div class="container-fluid">
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    <li class="nav-item">
                        <Link class="nav-link menu-link" href="/apps/dashboard">
                        <i class="bx bxs-dashboard"></i> <span data-key="t-dashboards">Dashboard</span>
                        </Link>
                    </li> <!-- end Dashboard Menu -->
                    <li class="nav-item">
                        <Link class="nav-link menu-link" href="#sidebarMD" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarMD">
                        <i class="bx bx-data"></i> <span data-key="t-sidebarMD">Master Data</span>
                        </Link>
                        <div class="collapse menu-dropdown" id="sidebarMD">
                            <ul class="nav nav-sm flex-column">
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
                                    <a class="nav-link menu-link" href="#sidebarArea" data-bs-toggle="collapse"
                                        role="button" aria-expanded="false" aria-controls="sidebarAdvanceUI">
                                        <i class="bx bx-area"></i> <span data-key="t-rektor">Area</span>
                                    </a>
                                    <div class="collapse menu-dropdown" id="sidebarArea">
                                        <li class="nav-item">
                                            <Link href="/apps/provinsi" class="nav-link"
                                                data-key="t-provinsi">Provinsi
                                            </Link>
                                        </li>
                                        <li class="nav-item">
                                            <Link href="/apps/kabkot" class="nav-link"
                                                data-key="t-kabupaten-kota">Kabupaten/Kota
                                            </Link>
                                        </li>
                                        <li class="nav-item">
                                            <Link href="/apps/kecamatan" class="nav-link"
                                                data-key="t-kecamatan">Kecamatan
                                            </Link>
                                        </li>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="#sidebarSekolah" data-bs-toggle="collapse"
                                        role="button" aria-expanded="false" aria-controls="sidebarAdvanceUI">
                                        <i class="bx bxs-bank"></i> <span data-key="t-rektor">Pendidikan</span>
                                    </a>
                                    <div class="collapse menu-dropdown" id="sidebarSekolah">
                                        <li class="nav-item">
                                            <Link href="/apps/sekolah" class="nav-link"
                                                data-key="t-provinsi">Menengah
                                            </Link>
                                        </li>
                                        <li class="nav-item">
                                            <Link href="/apps/kabkot" class="nav-link"
                                                data-key="t-kabupaten-kota">Kabupaten/Kota
                                            </Link>
                                        </li>
                                        <li class="nav-item">
                                            <Link href="/apps/kecamatan" class="nav-link"
                                                data-key="t-kecamatan">Kecamatan
                                            </Link>
                                        </li>
                                    </div>
                                </li>
                    <li class="nav-item">
                        <Link class="nav-link menu-link" href="/apps/jabatan">
                        <i class="bx bx-sitemap"></i> <span data-key="t-rank">Jabatan</span>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link menu-link" href="/apps/roles">
                        <i class="bx bxs-key"></i> <span data-key="t-role">Otoritas</span>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link menu-link" href="/apps/permissions">
                        <i class="bx bx-fingerprint"></i> <span data-key="t-permission">Permission</span>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link menu-link" href="/apps/surat-masuk">
                        <i class="bx bx-envelope"></i> <span data-key="t-permission">Surat Masuk</span>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="/apps/surat-keluar">
                            <i class="bx bx-mail-send"></i> <span data-key="t-permission">Surat
                                Keluar</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="/apps/dokumen">
                            <i class="bx bxs-file-archive"></i> <span data-key="t-permission">Dokumen</span>
                        </a>
                    </li>
                </ul>
            </div>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarAuth">
                <i class="bx bx-lock"></i> <span data-key="t-sidebarAuth">Authentikasi</span>
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
            </li> <!-- end Dashboard Menu -->
            <li class="nav-item">
                <Link class="nav-link menu-link" href="#sidebarUnor" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarUnor">
                <i class="bx bx-home"></i> <span data-key="t-sidebarAuth">Unit Organisasi</span>
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
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link
    },
    setup() {
    },
}
</script>
