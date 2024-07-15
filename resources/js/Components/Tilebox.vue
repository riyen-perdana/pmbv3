<template>
    <div class="card card-animate">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <p class="text-uppercase fw-medium text-muted mb-0">
                        {{ title }}
                    </p>
                </div>
            </div>
            <div class="d-flex align-items-end justify-content-between mt-4">
                <div>
                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                        <span class="counter-value" data-target="559.25"
                            >{{ jumlah }}
                        </span> {{ satuan }}
                    </h4>
                    <Link :href="uri" class="text-decoration-underline text-muted">{{ uri_title }}</Link>
                </div>
                <div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title rounded fs-3" :class="colorSpan">
                            <i :class="icon + ' ' + color"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- end card body -->
    </div>
</template>

<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
  title : String,
  jumlah : Number,
  uri   : String,
  uri_title : String,
  satuan: String,
  icon  : String,
  color : String,
  colorSpan : String
})

</script>
