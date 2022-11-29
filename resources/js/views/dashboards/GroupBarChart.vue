<template>
	<div>
		<div id="canvas">
  		<div class="d-flex align-items-center mb-4" >
  			<div class="col px-0">
  				<label class="lbl">Budget Month
	  				<select class="form-control d-unset" v-model="payloads.month">
	  					<option v-for="month in months" :value="month.value">{{ month.name }}</option>
	  				</select>
	  			</label>
	  			<label class="lbl">Budget Year
	  				<select class="form-control d-unset" v-model="payloads.year">
	  					<option v-for="year in years" :value="year">{{ year }}</option>
	  				</select>
	  			</label>					  				
  			</div>
  			<div class="col px-0 text-right">
  				<button class="btn--action bordered " :class="isActive.monthly ? 'bg--btn-primary' : 'bg--light-gray'" @click="activated(0)">Monthly</button>
  				<button class="btn--action bordered" :class="isActive.weekly ? 'bg--btn-primary' : 'bg--light-gray'" @click="activated(1)">Weekly</button>
  				<button class="btn--action bordered" :class="isActive.daily ? 'bg--btn-primary' : 'bg--light-gray'" @click="activated(2)">Daily</button>
  			</div>
  		</div>
  		<!-- <span id="canvas"> -->
			<canvas id="myChartMonthly"></canvas>
  		<!-- </span> -->
  	<!-- 	<span v-show="isActive.weekly">
			<canvas id="myChartWeekly"></canvas>
  		</span> -->
  		<!-- <span v-show="isActive.daily">
			<canvas id="myChartDaily"></canvas>
  		</span> -->
  		</div>
	</div>
</template>

<script>
	export default {
		props: {
			data: Array,
			date: Array,
			years: Array,
			months: Array,
			updateUrl: String
		},

		data() {
			return {
				isActive: {
					monthly: true,
					weekly: false,
					daily: false,
				},

				payloads: {},

				dataArray: this.data,
				dateArray: this.date,
			}
		},

		watch: {
			dateArray(val) {
				if(val) {}
			},
			'payloads.month'(val) {
				this.activated(3, val);
			},
			'payloads.year'(val) {
				this.activated(3, this.payloads.month, val);
			}
		},

		mounted() {
			this.init();
		},

		methods: {
			init() {
				var ctx = document.getElementById("myChartMonthly").getContext("2d");
				ctx.height = 100;
				var myLineChart = new Chart(ctx, this.config(this.dateArray, this.dataArray));
			},

			config(date, dataSet) {
				var data = {
				  labels: date,
				  datasets: dataSet
				};

				var config = {
				  	type: 'bar',
				  	data: data,
				  	options: {
					    scales: {
					      	yAxes: [{
					        	ticks: {
					          		beginAtZero:true,
					        	}
					      	}],
					      	xAxes: [{
				                barThickness: 28,  // number (pixels) or 'flex'
				                maxBarThickness: 28 // number (pixels)
					      	}],
					    },
					    legend: {
				            display: true,
				            position: 'bottom',
				            labels: {
				                fontColor: '#000'
				            }
				        }
					}
				};

				return config;
			},

			activated(key=3, month=null, year=null) {
				switch(key) {
					case 0: 
						this.isActive.monthly = true;
						this.isActive.weekly = false;
						this.isActive.daily = false;
						break;
					case 1: 
						this.isActive.monthly = false;
						this.isActive.weekly = true;
						this.isActive.daily = false;
						break;
					case 2: 
						this.isActive.monthly = false;
						this.isActive.weekly = false;
						this.isActive.daily = true;
						break;
				}
				$('#myChartMonthly').remove();
				$('#canvas').append('<canvas id="myChartMonthly"></canvas>')

				axios.post(this.updateUrl, { type: key, month: month, year: year })
					.then(response => {
						this.dateArray = response.data.date;
						this.dataArray = response.data.data;
						var ctx = document.getElementById("myChartMonthly").getContext("2d");
						ctx.height = 100;
						var myLineChart = new Chart(ctx, this.config(this.dateArray, this.dataArray));
					})
			},

			filter() {
			}
		}
	}
</script>