<template>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for="item in data">
            <div class="card crypto-table__cell">
                <div class="card-body">
                    <h5 class="card-title">{{ item['name'] }}</h5>
                    <p class="card-text">{{ item['price'] }}$</p>
                </div>
            </div>
        </div>
        <div class="row">
            <BarChart/>
        </div>
    </div>
</template>
<script setup>
import axios from "axios"
import {ref, onMounted} from 'vue'
import BarChart from './BarChart.vue'

const data = ref([])

const getData = () => {
    axios.get('api/cryptorank')
    .then(res => data.value = res.data)
    .catch(error => console.log(error));
}

onMounted(() => {getData()})



</script>