<template>
  <div class="container" style="min-height: 250px; height: 40vh;">
    <Bar v-if="loaded" :data="chartData" :options="options"/>
  </div>
</template>

<script>
import axios from "axios"
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
  name: 'BarChart',
  components: { Bar },
  data: () => ({
    loaded: false,
    chartData: {
        labels: [ 'January', 'February', 'March'],
        datasets: [
          {
            label: 'Data One',
            backgroundColor: '#f87979',
            data: [40, 20, 12]
          }
        ]
      },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        position: 'top',
      }
    }
  }),
  mounted () {
    this.loaded = false
    try {
      this.loaded = true
      axios.get('api/main_page_bar_data')
      .then(res => this.chartData = res.data)
      .catch(error => console.log(error));
    } catch (e) {
      console.error(e)
    }
  },
}

</script>