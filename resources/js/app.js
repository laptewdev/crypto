// require('./bootstrap');
import './bootstrap';
import Main from './src/components/Main.vue'
import Home from './src/components/Home.vue'

import.meta.glob([
    '../images/**'
])

import {createApp} from 'vue/dist/vue.esm-bundler.js';

const app = createApp({})

app.component('main-page', Main)
app.component('home-page', Home)

app.mount("#app")
