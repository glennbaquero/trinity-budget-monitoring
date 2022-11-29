<template>
	<div>
		<div class="row no-gutters equal">
			<div class="col-7 d-flex">
				<div class="card">
				  	<div class="card-header bg--white d-flex align-items-center">
				  		<!-- <div class="col-2 px-0"> -->
		 		  			<h4>PPP Available Budgets</h4>
				  		<!-- </div> -->
				  	</div>
				  	<div class="card-body p-5 pt-3">	
				  		<div class="d-flex align-items-center px-0 d-unset mb-4 justify-content-center">
				  			<label class="font-weight-normal font--12 mr-3">Specializations
				  				<select class="form-control" v-model="specialization" @change="update">
				  					<option v-for="specialization in specializations" :value="specialization.id">{{ specialization.name }}</option>
				  				</select>
				  			</label>
					       	<label class="font-weight-normal font--12">Budget Year
				  				<select class="form-control" v-model="year" @change="update">
				  					<option v-for="year in years" :value="year">{{ year }}</option>
				  				</select>
				  			</label>
				  		</div>
				  		<div class="chart-cntnr">
						    <h3 class="font-weight-bold clr--dark-green">Remaning Budget</h3>
						    <h4 class="font-weight-bold">As of {{ timestamp }}</h4>
					        <canvas id="myDoughnutChart" height="200"></canvas>
						</div>
				  	</div>
				</div>
			</div>
			<div class="col-5 pl-2 d-flex">
				<div class="card">
					<h4 class="card-header bg--white">Breakdown of Budget</h4>
					<div class="card-body frm-tbl">
						<div class="table-responsive mb-0">
							<table class="table table-striped">
								<slot name="header">
									<thead>
										<tr>
										    <th scope="col">PPP Name</th>
										    <th scope="col">Percentage</th>
										    <th scope="col" class="text-left">PO Date</th>
										</tr>
									</thead>
								</slot>

					            <tbody>
									<tr v-for="item in items">
										<td><span class="dot" :style="{'background': item.legend }"></span>{{ item.name }}</td>
									    <td>{{ item.request_amount }}</td>
									    <td>{{ item.po_date }}</td>
							    		</tr>
								</tbody>								
					        </table>								
						</div>
					    <div class="card-link bottom text-center">
					  		<a href="sales/po-request" class="link font--14">GO TO PO REQUEST</a>
					  	</div>															
			  		</div>
				</div>
			</div>	
		</div>
	</div>

</template>
<script>
	import ListMixin from 'Mixins/list.js';
	export default {
		props: {
			fetchUrl: String,			
			data: Array,
			specializations: Array,
			labels: Array,
			bgColor: Array,
			items: Array,
			updateUrl: String,
			text: String
		},

	    mixins: [ ListMixin ],


		data() {
			return {
				specialization: 0,
				timestamp: ""				
			}
		},

	    computed: {
		    years () {
		      const year = new Date().getFullYear()
		      return Array.from({length: year - 1999}, (value, index) => 2020 + index)
		    }	        
	    },		

		mounted() {
			this.init();
			this.chartRegister();
		},

        created() {
            setInterval(this.getNow, 10);
        },		

		methods: {
			chartRegister() {
				Chart.pluginService.register({
				  	beforeDraw: function(chart) {
				    	if (chart.config.options.elements.center) {
				      		// Get ctx from string
				      		var ctx = chart.chart.ctx;

					      	// Get options from the center object in options
					      	var centerConfig = chart.config.options.elements.center;
					      	var fontStyle = centerConfig.fontStyle || 'K2D';
					      	var txt = centerConfig.text;
					      	var color = centerConfig.color || '#000';
					      	var maxFontSize = centerConfig.maxFontSize || 75;
					      	var sidePadding = centerConfig.sidePadding || 20;
					      	var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
					      	// Start with a base font of 30px
					      	ctx.font = "800 30px " + fontStyle;

					      	// Get the width of the string and also the width of the element minus 10 to give it 5px side padding
					      	var stringWidth = ctx.measureText(txt).width;
					      	var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

					      	// Find out how much the font can grow in width.
					      	var widthRatio = elementWidth / stringWidth;
					      	var newFontSize = Math.floor(30 * widthRatio);
					      	var elementHeight = (chart.innerRadius * 2);

					      	// Pick a new font size so it will not be larger than the height of label.
					      	var fontSizeToUse = Math.min(newFontSize, elementHeight, maxFontSize);
					      	var minFontSize = centerConfig.minFontSize;
					      	var lineHeight = centerConfig.lineHeight || 25;
					      	var wrapText = false;

					      	if (minFontSize === undefined) {
					        	minFontSize = 20;
					      	}

					      	if (minFontSize && fontSizeToUse < minFontSize) {
					        	fontSizeToUse = minFontSize;
					        	wrapText = true;
					      	}

					      	// Set font settings to draw it correctly.
					      	ctx.textAlign = 'center';
					      	ctx.textBaseline = 'bottom';
					      	var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
					      	var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
					      	ctx.font = "bold " + fontSizeToUse + "px " + fontStyle;
					      	ctx.fillStyle = color;

					      	if (!wrapText) {
					        	ctx.fillText(txt, centerX, centerY);
					        	return;
					      	}

					      	var words = txt.split(' ');
					      	var line = '';
					      	var lines = [];

					      	// Break words up into multiple lines if necessary
					      	for (var n = 0; n < words.length; n++) {
					        	var testLine = line + words[n] + ' ';
					        	var metrics = ctx.measureText(testLine);
					        	var testWidth = metrics.width;
					        	if (testWidth > elementWidth && n > 0) {
					          		lines.push(line);
					          		line = words[n] + ' ';
					        	} else {
					          		line = testLine;
					        	}
					      	}

					      	// Move the center up depending on line height and number of lines
					      	centerY -= (lines.length / 2) * lineHeight;

					      	for (var n = 0; n < lines.length; n++) {
					        	ctx.fillText(lines[n], centerX, centerY);
					        	centerY += lineHeight;
					      	}
					      	//Draw text in center
					      	ctx.fillText(line, centerX, centerY);
				    	}
				  	}
				});
			},
            getNow: function() {
                const today = new Date();
                const date = (today.toLocaleString('default', { month: 'short' }))+'-'+today.toLocaleString('default', { day: '2-digit' })+'-'+today.getFullYear();
                const dateTime = date;
                this.timestamp = dateTime;
            },			
			init() {
				var ctx = document.getElementById("myDoughnutChart").getContext("2d");
				ctx.height = 100;

				var data = {
				  labels: this.labels,
				  datasets: [
				  	{
			          	label: null,
			          	backgroundColor: this.bgColor,
			          	data: this.data,
			        }
				  ]
				};

				var myDoughnutChart = new Chart(ctx, {
				  	type: 'doughnut',
				  	data: data,
				  	options: {
				         legend: {
				            display: false
				         },
					    tooltips: {enabled: false},
					    hover: {mode: null},
				  		elements: {
						    center: {
						      	text: this.text,
						      	color: '#3c813e', // Default is #000000
						      	fontStyle: 'K2D', // Default is Arial
						      	sidePadding: 30, // Default is 20 (as a percentage)
						      	minFontSize: 30, // Default is 20 (in px), set to false and text will not wrap.
						      	lineHeight: 40 // Default is 25 (in px), used for when text wraps
						    }
						}
					}
				});
			},

			update() {
				$('#myDoughnutChart').remove();
				$('.chart-cntnr').append('<canvas id="myDoughnutChart"></canvas>');
				axios.post(this.updateUrl, { specialization_id: this.specialization, year: this.year })
					.then(response => {
						this.data = response.data.doughnut_data;
						this.labels = response.data.doughnut_labels;
						this.bgColor = response.data.doughnut_data_color;
						this.items = response.data.items;						
						this.init();
					})
			},

		}
	}
</script>
