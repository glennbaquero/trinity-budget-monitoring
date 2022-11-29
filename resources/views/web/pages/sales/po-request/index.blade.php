@extends('web.pages.sales.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">Purchase Order Request</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Sales Agent</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">PO Request Index</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="row mb-2">
            <div class="col-sm-6">
		        <ul class="nav frm-tabs" id="myTab" role="tablist">
				  	<li class="frm-tabs__item">
				    	<a @click="initList('table-1')" class="frm-tabs__link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
				  	</li>
				  	<li class="frm-tabs__item">
				    	<a @click="initList('table-2')" class="frm-tabs__link" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved</a>
				  	</li>
				  	<li class="frm-tabs__item">
				    	<a @click="initList('table-3')" class="frm-tabs__link" id="denied-tab" data-toggle="tab" href="#denied" role="tab" aria-controls="denied" aria-selected="false">Denied</a>
				  	</li>
				  	<li class="frm-tabs__item">
				    	<a @click="initList('table-4')" class="frm-tabs__link" id="resubmit-tab" data-toggle="tab" href="#resubmit" role="tab" aria-controls="resubmit" aria-selected="false">Resubmitted</a>
				  	</li>
				  	<li class="frm-tabs__item">
				    	<a @click="initList('table-5')" class="frm-tabs__link" id="archived-tab" data-toggle="tab" href="#archived" role="tab" aria-controls="archived" aria-selected="false">Archived</a>
				  	</li>
				</ul>
            </div>
            <div class="col-sm-6 text-right">
            	<a href="sales/add-po-request" class="frm-btn">Create PO</a>
            </div>
        </div>


        <div class="tab-content" id="myTabContent">
		  	<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Pending PO Requests</h4>
				  	<div class="card-body">
				  		<po-request-table
                            ref="table-1"
							fetch-url="{{ route('web.po-request.fetch', ['status' => 1]) }}"
					  	></po-request-table>
				  	</div>
				</div>
		  	</div>
		  	<div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Approved PO Requests</h4>
				  	<div class="card-body">
					  	<po-request-table
                            ref="table-2"
                            disabled
							fetch-url="{{ route('web.po-request.fetch', ['status' => 2]) }}"
					  	></po-request-table>
				  	</div>
			  	</div>
		  	</div>
		  	<div class="tab-pane fade" id="denied" role="tabpanel" aria-labelledby="denied-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Denied PO Requests</h4>
				  	<div class="card-body">
					  	<po-request-table
                            ref="table-3"
                            disabled
							fetch-url="{{ route('web.po-request.fetch', ['status' => 3]) }}"
					  	></po-request-table>
				  	</div>
			  	</div>
		  	</div>
		  	<div class="tab-pane fade" id="resubmit" role="tabpanel" aria-labelledby="resubmit-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Archive PO Requests</h4>
				  	<div class="card-body">
					  	<po-request-table
                            ref="table-4"
                            disabled
							fetch-url="{{ route('web.po-request.fetch', ['status' => 4]) }}"
					  	></po-request-table>
				  	</div>
			  	</div>
			</div>
		  	<div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Archive PO Requests</h4>
				  	<div class="card-body">
					  	<po-request-table
                            ref="table-5"
                            disabled
							fetch-url="{{ route('web.po-request.fetch-archive') }}"
					  	></po-request-table>
				  	</div>
			  	</div>
			</div>
		</div>

    </section>
</div>
@endsection