<template>
    <div class="container" style="min-height: 250px; height: 40vh;">
        <Line :data="chartData" :options="options"/>
    </div>
</template>
<script setup>
import {ref, watchEffect} from 'vue'
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, PointElement, CategoryScale, LinearScale, LineElement)

defineProps({
    chartData: Object,
})

const options = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
        position: 'top',
    }
}

</script>