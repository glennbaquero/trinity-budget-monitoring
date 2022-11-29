@extends('web.pages.manager.master')

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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manager</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">PO Request</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

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
		    	<a @click="initList('table-4')" class="frm-tabs__link" id="resubmitted-tab" data-toggle="tab" href="#resubmitted" role="tab" aria-controls="resubmitted" aria-selected="false">Resubmitted</a>
		  	</li>
		</ul>


		<div class="tab-content" id="myTabContent">
		  	<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Pending PO Request</h4>
				  	<div class="card-body frm-tbl">
				  		<manager-po-request-table
                            ref="table-1"
							fetch-url="{{ route('manager.po-request.fetch', ['tab' => 'pending']) }}"
						></manager-po-request-table>
				  	</div>
				</div>
		  	</div>
		  	<div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Approved PO Request</h4>
				  	<div class="card-body frm-tbl">
					  	<manager-po-request-table
                            ref="table-2"
                            disabled
							fetch-url="{{ route('manager.po-request.fetch', ['tab' => 'approved']) }}"
					  	></manager-po-request-table>
				  	</div>
				</div>
		  	</div>
		  	<div class="tab-pane fade" id="denied" role="tabpanel" aria-labelledby="denied-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Denied PO Request</h4>
				  	<div class="card-body frm-tbl">
					  	<manager-po-request-table
                            ref="table-3"
                            disabled
							fetch-url="{{ route('manager.po-request.fetch', ['tab' => 'denied']) }}"
					  	></manager-po-request-table>
				  	</div>
				</div>
		  	</div>
		  	<div class="tab-pane fade" id="resubmitted" role="tabpanel" aria-labelledby="resubmitted-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Pending PO Request</h4>
				  	<div class="card-body frm-tbl">
				  		<manager-po-request-table
                            ref="table-4"
                            disabled
							fetch-url="{{ route('manager.po-request.fetch', ['tab' => 'resubmitted']) }}"
					  	></manager-po-request-table>
				  	</div>
				</div>
		  	</div>
		</div>
    </section>
</div>

@endsection