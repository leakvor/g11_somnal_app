<template>
  <NavBar />
  <div class="container mt-3 ps-3">
    <h2 class="dashboard-title text-dark">Company Dashboard</h2>
    <div class="card-container row mt-6 px-4">
      <<router-link  to="/paid-adjay" class="col-md-5 card text-decoration-none text-dark mx-auto">
        <div class="card-body text-center">
          <img src="../../assets/company/revenue-icon.png" alt="Revenue" />
          <p class="mt-3">Revenue</p>
          <h5 class="text-primary">{{ getRevenue() }}</h5>
        </div>
      </router-link>
      <a href="" class="col-md-5 card text-decoration-none text-dark mx-auto">
        <div class="card-body text-center">
          <img src="../../assets/company/user-icon.png" alt="User" />
          <p class="mt-3">User</p>
          <h5 class="text-primary">500</h5>
        </div>
      </a>
    </div>
    <div class="mt-5">
      <canvas id="myChart" style="width: 100%; min-height: 400px; height: 400px"></canvas>
    </div>
  </div>
</template>

<script>
import NavBar from '../../Components/NavBar.vue'

export default {
  name: 'Dashboard',
  components: {
    NavBar
  },
  mounted() {
    this.renderChart()
  },
  methods: {
    renderChart() {
      const ctx = document.getElementById('myChart').getContext('2d')
      const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
          ],
          datasets: [
            {
              label: 'January 1, 2022 - December 31, 2022',
              data: [65, 59, 80, 81, 56, 55, 40, 55, 30, 80, 60, 90],
              backgroundColor: [
                '#14213d',
                '#F94144',
                '#F3722C',
                '#F8961E',
                '#F9C74F',
                '#90BE6D',
                '#43AA8B',
                '#577590',
                '#277DA1',
                '#4895EF',
                '#9A7BFF',
                '#F27B35'
              ],
              borderWidth: 1
            }
          ]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                font: {
                  size: 14
                }
              }
            },
            x: {
              ticks: {
                font: {
                  size: 14
                }
              }
            }
          },
          plugins: {
            title: {
              display: true,
              text: 'Revenue for monthly',
              font: {
                size: 18
              }
            },
            tooltip: {
              mode: 'index',
              intersect: false,
              bodyFont: {
                size: 14
              },
              titleFont: {
                size: 16
              }
            }
          },
          interaction: {
            mode: 'index'
          }
        }
      })
    },
    getRevenue() {
      const data = [65, 59, 80, 81, 56, 55, 40, 55, 30, 80, 60, 90]
      const totalRevenue = data.reduce((acc, val) => acc + val, 0)
      return `$${totalRevenue}.00`
    }
  }
}
</script>

<style scoped>
.dashboard-title {
  font-size: 24px;
  font-weight: normal;
  margin-bottom: 20px;
}
.card {
  border: 1px solid #ccc;
  border-radius: 10px;
  padding: 15px;
  transition: all 0.5s ease-in-out;
}
.card:hover {
  border-color: rgba(0, 128, 0, 0.607);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transform: scale(1.01);
}
.card img {
  width: 50px;
  height: 50px;
}
.card p {
  margin-top: 10px;
}
.card h5 {
  color: #007bff;
}
.card p,
h5 {
  line-height: 10px;
}
#myChart {
  margin-top: 20px;
}
</style>
