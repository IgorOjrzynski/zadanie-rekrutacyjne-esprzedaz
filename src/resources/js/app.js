import './bootstrap';

import { createApp } from 'vue';
import PetsApp from './components/PetsApp.vue';

const el = document.getElementById('app');

if (el) {
    const props = {
        pets: JSON.parse(el.dataset.pets || '[]'),
    };

    createApp(PetsApp, props).mount('#app');
}
