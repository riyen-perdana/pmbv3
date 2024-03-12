<template>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <Header />
        <Navbar />
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
        <div class="main-content">
            <div class="page-content">
                <slot />
            </div>
            <Footer />
        </div>
    </div>
</template>

<script>

import Header from '../Components/Header.vue';
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';

export default {

    //Register Components
    components : {
        Header,Navbar,Footer
    },

    setup() {

    },
}
</script>
