<template>
  <Head>
    <title>
      .:: E-admisi Universitas Islam Negeri Sultan Syarif Kasim Riau ::.
    </title>
  </Head>
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="h-100">
          <div class="row mb-3 pb-1 p-3">
            <div
              class="page-title-box d-sm-flex align-items-center justify-content-between"
            >
              <div class="flex-grow-1">
                <Titlebox
                  :isDashboard="false"
                  title="Data Jenjang Pendidikan"
                  subTitle="Manajemen Data Jenjang Pendidikan Aplikasi E-Admisi"
                />
              </div>
              <Breadcrumb :items="breadcrumbs" />
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12 col-lg-12">
              <div class="card" id="t_jenjang">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1"></h5>
                    <div class="flex-shrink-0">
                      <button
                        type="button"
                        class="btn btn-success add-btn"
                        @click="clickButton(data.id)"
                      >
                        <i class="ri-add-line align-bottom me-1"></i>Tambah Data
                      </button>
                    </div>
                  </div>
                </div>
                <div class="card-body doted">
                  <div class="row g-3">
                    <div class="col-md-4">
                      <div class="search-box">
                        <input
                          type="text"
                          class="form-control search bg-light"
                          placeholder="Cari Data Jenjang Pendidikan"
                          v-model="data.params.search"
                        />
                        <i class="ri-search-line search-icon"></i>
                      </div>
                    </div>
                    <div class="col-md-auto ms-auto">
                      <div class="d-flex flex-row align-items-center gap-2">
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
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div>
                      <div class="table-responsive table-card mb-3 mt-3">
                        <table
                          class="table table-hover align-middle table-nowrap mb-0"
                          id="jenjangTable"
                        >
                          <thead class="table-light boder-white">
                            <tr>
                              <th scope="col" style="width: 4%">No.</th>
                              <th scope="col" style="width: 10%">
                                Kode Jenjang
                              </th>
                              <th scope="col" style="width: 63%">
                                Jenjang Pendidikan
                              </th>
                              <th scope="col" style="width: 10%">
                                Status Aktif
                              </th>
                              <th scope="col" style="width: 13%">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="(jjng, index) in jenjang.data"
                              :key="index"
                            >
                              <td class="r_atas">
                                {{
                                  (jenjang.current_page - 1) *
                                    jenjang.per_page +
                                  index +
                                  1
                                }}.
                              </td>
                              <td class="r_atas">{{ jjng.kd_jenjang }}</td>
                              <td class="r_atas">{{ jjng.nm_jenjang }}</td>
                              <td class="r_atas">
                                <span
                                  :class="
                                    jjng.is_aktif == 'Y'
                                      ? 'badge bg-success'
                                      : 'badge bg-danger'
                                  "
                                  >{{
                                    jjng.is_aktif == "Y"
                                      ? "Aktif"
                                      : "Tidak Aktif"
                                  }}</span
                                >
                              </td>
                              <td class="r_atas">
                                <div class="hstack gap-2 flex-wrap">
                                  <!-- Buttons Group -->
                                  <button
                                    type="button"
                                    class="btn btn-secondary btn-sm"
                                    @click="clickButton(jjng.id, jjng)"
                                  >
                                    <i
                                      class="ri-edit-2-line label-icon align-middle fs-10 me-1"
                                    ></i>
                                    Edit&nbsp;&nbsp;&nbsp;
                                  </button>
                                  <button
                                    type="button"
                                    class="btn btn-danger btn-sm"
                                    @click="destroy(jjng.id)"
                                  >
                                    <i
                                      class="ri-delete-bin-2-line label-icon align-middle fs-10 me-1"
                                    ></i>
                                    Hapus
                                  </button>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <Emptytable :data="jenjang" />
                      </div>
                      <div v-if="jenjang.data.length != 0">
                        <Pagination :links="jenjang.links" :count="jenjang" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Form
      :show="data.createOpen"
      :isEdit="data.isEdit"
      :dataEdit="data.dataEdit"
      @close="closeModal"
    />
    <Alert
      :show="data.openAlert"
      :id="data.id"
      @close-alert="closeAlert"
      @delete-data="deleteJenjang"
    />
  </div>
</template>

<script setup>
import { Head, router } from "@inertiajs/vue3";
import { reactive, computed, watch } from "vue";
import LayoutApp from "@/Layouts/App.vue";
import Titlebox from "@/Components/Titlebox.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Emptytable from "@/Components/Emptytable.vue";
import Pagination from "@/Components/Pagination.vue";
import Form from "@/Pages/Apps/Jenjang/Form.vue";
import Alert from "@/Components/Alert.vue";
import { cloneDeep, debounce, pickBy } from "lodash";

defineOptions({ layout: LayoutApp });

const props = defineProps({
  filters: Object,
  perPage: Number,
  jenjang: Object,
});

const breadcrumbs = computed(() => {
  return [
    {
      label: "Master Data",
      isActive: false,
    },
    {
      label: "Jenjang Pendidikan",
      url: "jenjang",
    },
  ];
});

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

//Modal
const clickButton = (id, jenjang) => {
  data.id = id;
  if (id == "") {
    data.isEdit = false;
  } else {
    data.isEdit = true;
    data.dataEdit = jenjang;
  }
  data.createOpen = true;
};

const closeModal = () => {
  data.createOpen = false;
  data.isEdit = false;
  data.id = "";
};

const destroy = (id) => {
  data.openAlert = true;
  data.id = id;
};

const closeAlert = () => {
  data.openAlert = !data.openAlert;
  data.isEdit = false;
  data.id = 0;
};

const deleteJenjang = (id) => {
  router.delete(`/apps/jenjang/${id}`, {
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => {
      closeAlert;
      createToast(
        {
          title: "Berhasil",
          description: "Data Jenjang Berhasil Dihapus.",
        },
        {
          type: "success",
          showIcon: true,
          transition: "zoom",
        }
      );
    },
    onError: () => {
      closeAlert;
      createToast(
        {
          title: "Error",
          description: "Gagal Menghapus Data Jenjang.",
        },
        {
          type: "danger",
          showIcon: "true",
          transition: "zoom",
        }
      );
    },
  });
};

watch(
  () => cloneDeep(data.params),
  debounce(() => {
    let param = pickBy(data.params);
    router.get("/apps/jenjang", param, {
      replace: true,
      preserveState: true,
      preserveScroll: true,
    });
  }, 150)
);
</script>

<style>
btn-mr {
  margin-right: 5px;
}

td.r_atas {
  vertical-align: top;
}
</style>
