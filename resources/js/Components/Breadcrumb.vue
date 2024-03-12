<template>
    <div class="page-title-right">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" >
                <span v-for="(item,index) in items" :key="index">
                    <li class="breadcrumb-item" :class="{'active':item.isActive}">
                        <Link v-if="item.url" :href="item.url">{{ item.label }}</Link>
                        <span v-else class="text-gray-500">{{ item.label }}</span>
                        <span v-if="index < (items.length-1)" class="mx-2">&gt;</span>
                    </li>
                </span>
            </ol>
        </nav>
        <!-- <span v-for="(item, index) in items"
          :key="index">
            <Link v-if="item.url" :href="item.url">{{ item.label }}</Link>
            <span v-else class="text-gray-500">{{ item.label }}</span>
            <span v-if="index < (items.length-1)" class="mx-2">&gt;</span>
        </span> -->
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components : {
        Link,
    },

    props : {
        items : {
            type : Array,
            required : true,
        }
    },

}

</script>
