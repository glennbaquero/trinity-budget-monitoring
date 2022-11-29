@extends('web.pages.manager.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">PPP Budget</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manager</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">PPP Budget</a></li>
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
				    	<a  @click="initList('table-1')" class="frm-tabs__link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
				  	</li>
				  	<li class="frm-tabs__item">
				    	<a  @click="initList('table-2')" class="frm-tabs__link" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved</a>
				  	</li>
				  	<li class="frm-tabs__item">
				    	<a  @click="initList('table-3')" class="frm-tabs__link" id="denied-tab" data-toggle="tab" href="#denied" role="tab" aria-controls="denied" aria-selected="false">Denied</a>
				  	</li>
				  	<li class="frm-tabs__item">
				    	<a  @click="initList('table-4')" class="frm-tabs__link" id="resubmit-tab" data-toggle="tab" href="#resubmit" role="tab" aria-controls="resubmit" aria-selected="false">Resubmitted</a>
				  	</li>
				</ul>
            </div>
            @if(!auth()->guard('manager')->user()->is_assistant_manager)
            <div class="col-sm-6 text-right">
            	<a href="{{ route('manager.ppp-request.create') }}" class="frm-btn">Create PPP</a>
            </div>
            @endif
        </div>

        <div class="tab-content" id="myTabContent">
		  	<div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Pending PPP</h4>
				  	<div class="card-body frm-tbl">
				  		<manager-ppp-request-table
                            ref="table-1"
							fetch-url="{{ route('manager.ppp-request.fetch', ['status' => 1]) }}"
				  		></manager-ppp-request-table>
				  	</div>
				</div>
		  	</div>
		  	<div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Approved PPP</h4>
				  	<div class="card-body frm-tbl">
				  		<manager-ppp-request-table
                            ref="table-2"
                            disabled
							fetch-url="{{ route('manager.ppp-request.fetch', ['status' => 2]) }}"
				  		></manager-ppp-request-table>
				  	</div>
				</div>
		  	</div>
		  	<div class="tab-pane fade" id="denied" role="tabpanel" aria-labelledby="denied-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Denied PPP</h4>
				  	<div class="card-body frm-tbl">
				  		<manager-ppp-request-table
                            ref="table-3"
                            disabled
							fetch-url="{{ route('manager.ppp-request.fetch', ['status' => 3]) }}"
				  		></manager-ppp-request-table>
				  	</div>
				</div>
		  	</div>
		  	<div class="tab-pane fade" id="resubmit" role="tabpanel" aria-labelledby="resubmit-tab">
		  		<div class="card">
				  	<h4 class="card-header bg--white">Resubmitted PPP</h4>
				  	<div class="card-body frm-tbl">
				  		<manager-ppp-request-table
                            ref="table-4"
                            disabled
							fetch-url="{{ route('manager.ppp-request.fetch', ['status' => 4]) }}"
				  		></manager-ppp-request-table>
				  	</div>
				</div>
		  	</div>
		</div>
    </section>
</div>

@endsection