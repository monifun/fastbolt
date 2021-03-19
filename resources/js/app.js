require('./bootstrap');

require('alpinejs');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import InlineSvg from 'vue-inline-svg';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .use(Toast)
    .component('inline-svg', InlineSvg)
    .mount(el);

InertiaProgress.init({ color: '#6366F1' });
