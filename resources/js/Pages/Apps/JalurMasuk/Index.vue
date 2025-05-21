<script setup>
import { Head, router } from "@inertiajs/vue3";
import { reactive, computed, watch } from "vue";
import LayoutApp from "@/Layouts/App.vue";
import PageLayout from "@/Layouts/Page.vue";
import Titlebox from "@/Components/Titlebox.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Emptytable from "@/Components/Emptytable.vue";
import Pagination from "@/Components/Pagination.vue";
import Form from "@/Pages/Apps/JalurMasuk/Form.vue";
import Alert from "@/Components/Alert.vue";
import { cloneDeep, debounce, pickBy } from "lodash";
import { create } from "lodash";

defineOptions({ layout: LayoutApp });

const props = defineProps({
  filters: Object,
  perPage: Number,
  jalurMasuk: Object,
});

const breadcrumbs = computed(() => {
  return [
    {
      label: "Master Data",
      isActive: false,
    },
    {
      label: "Jalur Masuk",
      url: "jalur-masuk",
    },
  ];
});

const clickButton = (id, jalurMasuk) => {
  data.id = id;
  if (id == "") {
    data.isEdit = false;
  } else {
    data.isEdit = true;
    data.dataEdit = jalurMasuk;
  }
  data.createOpen = true;
};

const data = reactive({
  params: {
    search: props.filters?.search,
    perPage: props.perPage,
  },
  createOpen: false,
  isEdit: false,
  openAlert: false,
  dataEdit: {},
  id: "",
});

const closeModal = () => {
  data.createOpen = false;
  data.isEdit = false;
  data.id = "";
  console.log(data.createOpen);
};

</script>

<template>
  <PageLayout>
    <template #title>
      <Titlebox
        :isDashboard="false"
        title="Data Jalur Masuk"
        subTitle="Manajemen Data Jalur Masuk Mahasiswa Baru Aplikasi E-Admisi"
      />
    </template>
    <template #breadcrumb>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <template #action>
      <button
        type="button"
        class="btn btn-success add-btn"
        @click="clickButton(data.id)"
      >
        <i class="ri-add-line align-bottom me-1"></i>Tambah Data
      </button>
    </template>
    <template #search>
      <input
        type="text"
        class="form-control search bg-light"
        placeholder="Cari Data Jalur Masuk"
        v-model="data.params.search"
      />
      <i class="ri-search-line search-icon"></i>
    </template>
    <template #entries>
      <select
        class="form-select mb-3"
        aria-label="Default select example"
        v-model="data.params.perPage"
      >
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </select>
      <span class="text-muted text-show">Entries</span>
    </template>
    <template #table-pagination>
      <div>
        <div class="table-responsive table-card mb-3 mt-3">
          <table
            class="table table-hover align-middle table-nowrap mb-0"
            id="jalurMasukTable"
          >
            <thead class="table-light boder-white">
              <tr>
                <th scope="col" style="width: 4%">No.</th>
                <th scope="col" style="width: 23%">Jalur Masuk</th>
                <th scope="col" style="width: 10%">Tahun</th>
                <th scope="col" style="width: 10%">Semester</th>
                <th scope="col" style="width: 20%">Tanggal Penting</th>
                <th scope="col" style="width: 10%">Status Aktif</th>
                <th scope="col" style="width: 10%">Kode Prefiks</th>
                <th scope="col" style="width: 13%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
          <Emptytable :data="jalurMasuk" />
        </div>
      </div>
      <!-- <div v-if="jenjang.data.length != 0">
        <Pagination :links="jenjang.links" :count="jenjang" />
      </div> -->
    </template>
    <template #form>
      <Form
        :show="data.createOpen"
        :isEdit="data.isEdit"
        :data="data.dataEdit"
        @close="closeModal"
      />
    </template>
  </PageLayout>
</template>
