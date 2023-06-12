import './bootstrap';
import '../css/app.css';
import '@fortawesome/free-solid-svg-icons';
import 'flowbite';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import vue3StarRatings from "vue3-star-ratings";

//fortawesome icons
import { faArrowRight, faArrowLeft, faXmark, faCircleQuestion, faUsers, faClock, faStar, faHeart, faHeadset, faLock} from '@fortawesome/free-solid-svg-icons';

library.add(faArrowRight, faArrowLeft, faXmark, faCircleQuestion, faUsers, faClock, faStar, faHeart, faHeadset, faLock);

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Экскурсии';

createInertiaApp({
    title: (title) => title,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component('font-awesome-icon', FontAwesomeIcon)
            .component("vue3-star-ratings", vue3StarRatings)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
