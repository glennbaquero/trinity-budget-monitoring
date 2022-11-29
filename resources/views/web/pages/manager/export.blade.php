@extends('web.pages.manager.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">Export Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manager</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Export Management</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

		<ul class="nav frm-tabs" id="myTab" role="tablist">
		  	<li class="frm-tabs__item">
		    	<a class="frm-tabs__link active" id="ppp-request-tab" data-toggle="tab" href="#ppp-request" role="tab" aria-controls="ppp-request" aria-selected="true">PPP Requests</a>
		  	</li>
		  	<li class="frm-tabs__item">
		    	<a class="frm-tabs__link" id="po-request-tab" data-toggle="tab" href="#po-request" role="tab" aria-controls="po-request" aria-selected="false">PO Requests</a>
		  	</li>
		</ul>

		<div class="tab-content" id="myTabContent">
		  	<div class="tab-pane fade show active" id="ppp-request" role="tabpanel" aria-labelledby="ppp-request-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">List of Approved PPP</h4>
				  	<div class="card-body frm-tbl">
				  		<export-ppp-report-table
							fetch-url="{{ route('manager.ppp-request.fetch') }}"
							export-url="{{ route('manager.ppp.export') }}"
				  		></export-ppp-report-table>
				  	</div>
				</div>
		  	</div>
		  	<div class="tab-pane fade" id="po-request" role="tabpanel" aria-labelledby="po-request-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">List of Approved PO</h4>
				  	<div class="card-body frm-tbl">
				  		<export-po-report-table
							fetch-url="{{ route('manager.po-request.fetch') }}"
							export-url="{{ route('manager.po.export') }}"
				  		></export-po-report-table>
				  	</div>
				</div>
		  	</div>
		</div>
    </section>
</div>

@endsection