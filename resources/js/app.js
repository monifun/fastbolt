require('./bootstrap');

require('alpinejs');

require('@/Filters/currency');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import VueDateFns from "vue-date-fns";

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(VueDateFns, "HH:mm:ss dd-MM-yyyy");

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
