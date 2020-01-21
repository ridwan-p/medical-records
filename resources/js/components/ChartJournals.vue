<template>
	<div v-if="isLoading" class="bg-chart-loading"></div>
	<apexcharts v-else type="line" height="350" :options="chartOptions" :series="series"></apexcharts>
</template>

<script>
	import Apexcharts from 'vue-apexcharts'
	export default {
		components:{ Apexcharts },
		data() {
			return {
				isLoading: false,
				chartOptions: {
					chart: {
						id: 'chart-journal-line'
					},
					stroke: {
						curve: 'smooth',
					},
					colors: ["#23408e"],
					xaxis: {
						categories: []
					}
				},
				series: [
					{
						name: lang['Journal'],
						data: []
					}
				],
				categories : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
			}
		},
		mounted() {
			this.isLoading = true
			this.getData().then(res => {
				this.isLoading = false;
			});
		},
		methods: {
			getData: function(params) {
				const end = new Date()
				const start = new Date( end.getFullYear() - 1, end.getMonth() + 1, 1 )

				return axios.get('/local-api/history-show-all', {
					params:{
						data_start: `${start.getFullYear()}-${start.getMonth() + 1 }-${start.getDate()}`,
						date_end: `${end.getFullYear()}-${end.getMonth() + 1 }-${end.getDate()}`,
						direction: 'asc',
						...params
					}
				}).then(res => {
					const cal = this.calculationSeries(res.data)
					this.series[0].data =cal.data
					this.chartOptions.xaxis.categories = cal.month
					return res
				})
			},
			calculationSeries : function(data) {
				let tmp = []
				let month = []
				let series = []

				for(const item of data) {
					const date = new Date(item.created_at)
					const mo = this.categories[date.getMonth()]
					tmp[mo] = tmp[mo] > 0 ? ++tmp[mo] : 1
				}

				for(const i in tmp) {
					series.push(tmp[i])
					month.push(i)
				}

				return {
					month: month,
					data: series
				}
			}
		}
	}
</script>

<style scoped>
	.bg-chart-loading {
		width: 100%;
		height: 350px;
		background: linear-gradient(to right, #eee 20%, #ddd 50%, #eee 80%);
	}
</style>