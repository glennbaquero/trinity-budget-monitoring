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
				    <td>{{ item.person_in_charge }}</td>
				    <td>
				    	<action-button
				    	v-if="!hideButtons"
				    	small 
				    	color="btn--action bg--btn-red"
				    	alt-color="btn--action bg--gray"
				    	:show-alt="item.deleted_at"
				    	:action-url="item.archiveUrl"
				    	:alt-action-url="item.restoreUrl"
				    	icon="fas fa-trash"
				    	alt-icon="fas fa-trash-restore-alt"
				    	confirm-dialog
				    	:disabled="loading"
				    	title="Archive Item"
				    	alt-title="Restore Item"
				    	:message="'Are you sure you want to archive PO Request with ID ' + item.number + '?'"
				    	:alt-message="'Are you sure you want to restore PO Request with ID ' + item.number + '?'"
				    	@load="load"
				    	@success="sync"
				    	></action-button>
				    	<!-- <a :href="item.archiveUrl" class="btn--action bg--btn-red"><img src="images/delete-icon.svg"></a> -->
			      		<!-- <a href="#" class="btn--action bg--gray"><span><img src="images/retrieve-icon.svg"></span></a> -->
				    	<a :href="item.showUrl" class="btn--action bg--btn-blue"><i class="fa fa-eye"></i></a>
<!-- 			      		<a href="#" class="btn--action bg--btn-yellow"><span><img src="images/edit-icon.svg"></span></a>
 -->				    </td>
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