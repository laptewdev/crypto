<template>
    <div class="container" style="min-height: 250px; height: 50vh;">
        <Line :data="chartData" :options="options"/>
    </div>
</template>
<script setup>
import {ref, watchEffect} from 'vue'
import { Line } from 'vue-chartjs'
import zoomPlugin from 'chartjs-plugin-zoom';
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, PointElement, CategoryScale, LinearScale, LineElement, zoomPlugin)

defineProps({
    chartData: Object,
})

const options = ref({
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
})

</script>