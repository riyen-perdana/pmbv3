<template>
    <div class="row g-0 text-center text-sm-start align-items-center mb-4" style="margin-top:20px;">
        <div class="col-sm-6 text-muted">
            Menampilkan Data Dari {{ count.from }} Sampai {{ count.to }} Dari {{ count.total }} Data
        </div>
        <!-- end col -->
        <div class="col-sm-6">
            <ul class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                <li :class="[
                        'page-item',
                        link.url == null ? 'disabled' : '',
                        link.active ? 'active' : '',
                    ]"
                    v-for="(link, index) in links" :key="index">
                        <Link
                            preserve-scroll
                            class="page-link"
                            :href="link.url === null ? '#' : link.url+'&perPage='+perPage"
                            v-html="link.label">
                        </Link>
                </li>
            </ul>
        </div><!-- end col -->
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
    props : {
        links : Array,
        count : Object,
        perPage: Number,
    },
    components : {
        Link
    },
    setup() {

    },
}
</script>
