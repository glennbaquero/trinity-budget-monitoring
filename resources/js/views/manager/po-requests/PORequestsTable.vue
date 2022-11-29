<template>
	<div>
	  	<data-table
		  	ref="data-table"
		  	class="row mx-0"
		  	:headers="headers"
		  	:filters="filters"
		  	:fetch-url="fetchUrl"
		  	:no-action="false"
		  	:disabled="disabled"
		  	:is-table="false"
		  	order-by="id"
		  	@load="load"
	  	>
			<template v-slot:body="{ items }">
				<tr v-for="item in items">
				    <td>{{ item.po_number }}</td>
				    <td>{{ item.name }}</td>
				    <td>{{ item.short_description }}</td>
				    <td>{{ item.request_amount }}</td>
				    <td class="d-flex">
	    	    		<div class="tbl-avatar mr-2">
	    					<img :src="item.image_path" class="img-fit cover">
	    				</div>
				    	{{ item.person_in_charge }}
				    </td>
				    <td class="text-center">
				    	<a :href="item.showUrl" class="btn--action bg--btn-blue"><span class="btn-label"><i class="fa fa-eye"></i></span>View</a>
				    	<!-- <a :href="" class="btn--action bg--btn-blue"><i class="fa fa-eye"></i> View</a> -->
				    </td>
				</tr>
			</template>
		</data-table>
	</div>
</template>
<script>
	import ListMixin from 'Mixins/list.js';
	import ActionButton from 'Components/buttons/SaleRepActionButton.vue';
	export default {
		props: {
			fetchUrl: String
		},

	    mixins: [ ListMixin ],

	    components: {
	        'action-button': ActionButton,
	    },

	    computed: {
	        headers() {
	            let array = [
	                { text: '#', value: 'number' },
	                { text: 'PO Name', value: 'name' },
	                { text: 'Description', value: 'description' },
	                { text: 'Request Amount', value: 'request_amount' },
	                { text: 'Person in Charge', value: 'request_amount' },
	            ];

	            return array;
	        },
	    },
	}
</script>