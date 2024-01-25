require('./bootstrap');

import { createApp } from 'vue';
import ShortlinkForm from './components/ShortlinkForm.vue';

const app = createApp({});
app.component('shortlink-form', ShortlinkForm);
app.mount('#app');

