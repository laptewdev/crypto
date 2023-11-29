<template>
    <div class="row">
        <div class="col-3">
            <div class="row">
                <div class="row">
                    <SearchForm
                        v-model:name="name"
                        @update:name="afterCryptoId=cryptoId;cryptoId=name; crytpoIdActive(cryptoId, afterCryptoId);"
                    />
                </div>
            
                <div class="row crypto-list">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="item in data">
                            <div class="list-group-item-button" @click="afterCryptoId=cryptoId;cryptoId=$event.target.id; crytpoIdActive(cryptoId, afterCryptoId);" :id="item['name']"></div>
                            <div class="list-group-item-text">
                                <h5 class="card-title">{{ item['name'] }}</h5>
                                <p class="card-text">{{ item['price'] }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="col">
            <div class="row">
                {{ cryptoId }}
                <HomeChart
                    :chartData="chartData['data']"
                    :options="chartData['options']"
                />
            </div>
            <div class="row">
                <HomeChartSearch
                    v-model:interval="interval"
                    v-model:startTime="startTime"
                    v-model:endTime="endTime"
                />
            </div>
        </div>
    </div>
    
</template>
<script setup>
import axios from "axios"
import {ref, watchEffect, computed} from 'vue'

import SearchForm from './SearchForm.vue'
import HomeChartSearch from "./HomeChartSearch.vue"
import HomeChart from './HomeChart.vue'

const cryptoId = ref("BTCUSDT")
const afterCryptoId = ref("BTCUSDT")

const name = ref("")

const data = ref([])
const chartData = ref(
    {
        data:{
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    label: 'Data loading...',
                    backgroundColor: '#ffffff',
                    borderColor: '#ffffff',
                    pointBackgroundColor: '#7cfaa2',
                    borderWidth: 1,
                    pointBorderColor: '#7cfaa27a',
                    //Data to be represented on y-axis
                    data: [40, 20, 30, 50, 90, 10, 20, 40, 50, 70, 90, 100]
                }
            ]
        },
        options:{
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'top',
            },
            plugins:{
                zoom:{
                    limits: {
                        y: {min: 'original', max: 'original'},
                    },
                    pan:{
                        enabled: true
                    },
                    zoom:{
                        wheel: {
                            enabled: true,
                        },
                        pinch: {
                            enabled: true
                        },
                        drag:{
                            enabled: false
                        },
                        mode: 'xy',
                    },
                }
            },
        }
    }
)

const currentDateTime = (skipMonths) => {
      const current = new Date();
      const date = current.getFullYear()+'-'+(current.getMonth()+1-skipMonths)+'-'+current.getDate();
      const time = current.getHours() + ":" + current.getMinutes() + ":" + current.getSeconds();
      const dateTime = date +' '+ time;

      return dateTime;
}

const interval = ref("5m")
const startTime = ref(currentDateTime(1))
const endTime = ref(currentDateTime(0))

const apiUrl = computed(()=>{
    return `api/home_data?name=${name.value}`;
})
const apiChartUrl = computed(()=>{
    return `api/home_chart_data?symbol=${cryptoId.value}&interval=${interval.value}&start_time=${startTime.value}&end_time=${endTime.value}`
})

const getData = () => {
    axios.get(apiUrl.value)
    .then(res => data.value = res.data)
    .catch(error => console.log(error));
}

const getChartData = () => {
    axios.get(apiChartUrl.value)
    .then(res => chartData.value = res.data)
    .catch(error => console.log(error));
}

watchEffect(() => {getData(); getChartData()})

const crytpoIdActive = (id, afterId) =>{
    if (afterId != null && document.getElementById(afterId)){
        document.getElementById(afterId).parentNode.classList.remove('active')
    }
    if(document.getElementById(id)){
        document.getElementById(id).parentNode.classList.add('active')
    }
}

</script>

<style>
    .crypto-list{
        height: 500px;
        overflow: hidden;
        overflow-y: scroll;
    }
    .crypto-list::-webkit-scrollbar{
        width: 6px;
    }
    .crypto-list::-webkit-scrollbar-track{
        background-color: #000000;
    }
    .crypto-list::-webkit-scrollbar-thumb{
        background-color: #7cfaa2;
        border-radius: 20px;
    }

    .list-group-item-button{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        
    }

    .list-group-item.active{
        background-color: #7cfaa27a;
        border-color: #7cfaa2;
    }
</style>