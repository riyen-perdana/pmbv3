<template>
    <header id="page-topbar">
      <div class="layout-width">
        <div class="navbar-header">
          <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box horizontal-logo">
              <Link href="/" class="logo-light">
                <span class="logo-lg">
                    <div class="d-flex flex-row gap-2 mt-1">
                        <img src="../../../public/images/logo-uin.png" height="60px" />
                        <div class="d-inline-flex flex-column align-items-start">
                            <div class="judul">E-Admisi</div>
                            <div class="sub-judul">Universitas Islam Negeri Sultan Syarif Kasim Riau</div>
                        </div>
                    </div>
                </span>
              </Link>
            </div>

            <button type="button" class="
                btn btn-sm
                px-3
                fs-16
                header-item
                vertical-menu-btn
                topnav-hamburger
              " id="topnav-hamburger-icon">
              <span class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
              </span>
            </button>

          </div>

          <div class="d-flex align-items-center">
            <div class="dropdown ms-sm-3 header-item topbar-user">
              <button type="button" @click="isOpen" class="btn" :class="{'show': !menu.openMenu}"  id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border:none !important;">
                <span class="d-flex align-items-center">
                  <img class="rounded-circle header-profile-user" :src="`https://ui-avatars.com/api/?name=${$page.props.auth.user?.name}&amp;background=4e73df&amp;color=ffffff&amp;`"
                    alt="Header Avatar" />
                  <span class="text-start ms-xl-2">
                    <div v-if="$page.props.auth.user != null">
                        <span class=" d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ $page.props.auth.user.name }}</span>
                        <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ $page.props.auth.user.roles[0].name }}</span>
                    </div>
                    <div v-else>
                        <span class=" d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ $page.props.auth.peserta?.nm_siswa }}</span>
                        <span class=" d-none d-xl-inline-block ms-1 fw-medium user-name-text">Peserta</span>
                    </div>
                  </span>
                </span>
              </button>
              <div class="dropdown-menu dropdown-menu-end" :class="{'show': !menu.openMenu}" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 64.8px, 0px);" data-popper-placement="bottom-end">
                <!-- item-->
                <!-- <h6 class="dropdown-header">{{ $page.props.auth.user.name }}</h6> -->
                <Link class="dropdown-item" href="/pages/profile">
                    <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                    <span class="align-middle">Profil</span>
                </Link>
                <Link class="dropdown-item" href="/logout" method="POST" as="button"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                  <span class="align-middle" data-key="t-logout">Logout</span></Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
  </template>

  <script>
  import { reactive } from 'vue';
  import { Link } from '@inertiajs/vue3';
  export default {

  props : {
        auth : Object,
        peserta : Object
  },
    components : {
        Link
    },
    setup() {

      const menu = reactive({
        openMenu : 'false'
      });

      const isOpen = () => {
        menu.openMenu = !menu.openMenu;
      }

      return { isOpen, menu}
    },
  }
  </script>

<style>
  .judul {
    font-size: 25px;
    color: white;
    font-family: "Montserrat", sans-serif;
    text-transform: uppercase !important;
  }
  .sub-judul {
    font-size: 13px;
    color: white;
    font-family: "Montserrat", sans-serif;
    margin-top: -5px;
  }
</style>
