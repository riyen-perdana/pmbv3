import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { InertiaProgress } from '@inertiajs/progress';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
      },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
    .mixin({
        methods: {
            //method "hasAnyPermission"
            hasAnyPermission: function (permissions) {
                //get permissions from props
                let allPermissions = this.$page.props.auth.permissions;
                let hasPermission = false;
                permissions.forEach(function(item){
                    if(allPermissions[item]) hasPermission = true;
                });
                return hasPermission;
            },
            formatDate(string) {
                let bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];
                let tanggal = string.split("-")[2];
                let bulan = string.split("-")[1];
                let tahun = string.split("-")[0];
                const hari = new Date(tahun+"/"+bulan+"/"+tanggal);
                return tanggal + " " + bulanIndo[Math.abs(bulan)] + " " + tahun;
            },
        },
    })
      .use(plugin)
      .mount(el)
  },
});

InertiaProgress.init()
