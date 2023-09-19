<script>
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement, CategoryScale } from 'chart.js'
import ChartDataLabels from 'chartjs-plugin-datalabels'

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale, ChartDataLabels)

export default {
  name: 'PieChart',
  components: { Pie },
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
          tooltip: {
            enabled: true
          },
          datalabels: {
            // labels: {
            //   title: null
            // },
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

<template>
  <Pie
    :data="chartData"
    :options="chartOptions"
    :style="styles"
  />
</template>
