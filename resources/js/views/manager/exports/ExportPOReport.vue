<template>
	<div>
		<form-request :submit-url="exportUrl" @load="load" submit-on-success method="POST" :action="exportUrl">
		    <filter-box @refresh="fetch" :hide-refresh="true">
		        <template v-slot:left>
		            <date-range
		            class="mr-2"
		            @change="filter($event)"
		            ></date-range>
		           <!--  <action-button v-if="exportUrl" type="submit" :disabled="loading" class="btn-warning mr-2" icon="fa fa-download">Export</action-button> -->
		        </template>
		        <template v-slot:right>
					<button class="frm-btn" type="submit" ><img src="images/export-icon.svg">Export</button>
				</template>
		    </filter-box>
		</form-request>
	  	<data-table
		  	ref="data-table"
		  	class="row mx-0"
		  	:headers="headers"
		  	:filters="filters"
		  	:fetch-url="fetchUrl"
		  	:no-action="true"
		  	:disabled="disabled"
		  	:is-table="false"
		  	order-by="id"
		  	@load="load"
	  	>
			<template v-slot:body="{ items }">
				<tr v-for="item in items">
				    <td>{{ item.name }}</td>
				    <td>{{ item.short_description }}</td>
				    <td>{{ item.request_amount }}</td>
				    <td>{{ item.person_in_charge }}</td>
				</tr>
			</template>
		</data-table>
	</div>
</template>
<script>
	import ListMixin from 'Mixins/list.js';
	import DateRange from 'Components/datepickers/DateRange.vue';
	import FormRequest from 'Components/forms/FormRequest.vue';
	export default {
		props: {
			fetchUrl: String,
			exportUrl: String
		},

	    mixins: [ ListMixin ],

	    components: {
	        'date-range': DateRange,
	        'form-request': FormRequest,
	    },

	    computed: {
	        headers() {
	            let array = [
	                { text: 'PO Name', value: 'name' },
	                { text: 'Description', value: 'line_business' },
	                { text: 'Request Amount', value: '' },
	                { text: 'Person in Charge', value: '' },
	            ];

	            return array;
	        },
	    },
	}
</script>