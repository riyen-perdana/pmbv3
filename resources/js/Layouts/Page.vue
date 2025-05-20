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
                <slot name="title" />
              </div>
              <slot name="breadcrumb" />
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12 col-lg-12">
              <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1"></h5>
                    <div class="flex-shrink-0 mb-3">
                      <slot name="action" />
                    </div>
                  </div>
                  <div class="card-body doted">
                    <div class="row g-3">
                      <div class="col-md-4">
                        <div class="search-box">
                          <slot name="search" />
                        </div>
                      </div>
                      <div class="col-md-auto ms-auto">
                        <div class="d-flex flex-row align-items-center gap-2">
                          <slot name="entries" />
                        </div>
                      </div>
                    </div>
										<div class="row">
											<slot name="table-pagination" />
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
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
</script>
