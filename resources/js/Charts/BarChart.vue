<template>
  <Bar :data="chartData" :options="chartOptions" :style="styles" />
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import ChartDataLabels from 'chartjs-plugin-datalabels'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ChartDataLabels)

export default {
  name: 'BarChart',
  components: { Bar },
  props: ['data', 'labels'],
  computed: {
    styles () {
      return {
        margin: 'auto',
        height: '608px',
        position: 'relative'
      }
    }
  },
  data () {
    return {
      chartData: {
        datasets: [{
          data: this.data,
          backgroundColor: [
            '#a6cee3',
            '#1f78b4',
            '#b2df8a',
            '#33a02c',
            '#fb9a99',
            '#e31a1c',
            '#fdbf6f',
            '#ff7f00',
            '#cab2d6',
            '#6a3d9a',
            '#ffff99',
            '#b15928',
          ]
        }],
        labels: this.labels,
      },
      chartOptions: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            enabled: false
          },
          datalabels: {
            color: 'white',
            font: {
              size: 13
            },
            formatter: function(value, context) {
              return value.toString();
            }
          }
        }
      }
    }
  },
}
</script>
