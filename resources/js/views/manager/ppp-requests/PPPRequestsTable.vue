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
				    <td>{{ item.name }}</td>
				    <td>{{ item.line_business }}</td>
				    <td>{{ item.date_period }}</td>
				    <td>{{ item.brand }}</td>
				    <td>{{ item.request_amount }}</td>
				    <td>
				    	{{ item.attachment_count }}
	    	    		<i v-if="item.showAttachmentIcon" class="clr--light-gray ml-2 fa fa-paperclip"></i>
				    </td>
				    <td class="text-center">
				    	<a :href="item.showUrl" v-if="!item.denied_at" class="btn--action bg--btn-blue"><span class="btn-label"><i class="fa fa-eye"></i></span>View</a>
				    	<a :href="item.showUrl" v-if="item.denied_at" class="btn--action bg--btn-yellow"><span><img src="images/edit-icon.svg"></span> Edit</a>
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
	                { text: 'PPP Name', value: 'name' },
	                { text: 'Line Business', value: 'line_business' },
	                { text: 'Date Period', value: '' },
	                { text: 'Brand', value: 'brand' },
	                { text: 'Amount', value: 'requested_amount' },
	                { text: 'Attachments', value: '' },
	            ];

	            return array;
	        },
	    },
	}
</script>