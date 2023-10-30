// require('./bootstrap');
import './bootstrap';
import Main from './src/components/Main.vue'

import {createApp} from 'vue/dist/vue.esm-bundler.js';

const app = createApp({})

app.component('main-page', Main)

app.mount("#app")
