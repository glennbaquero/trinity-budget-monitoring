@extends('web.pages.manager.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manager</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Main Budget</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row no-gutters">
			<div class="col-12">
				<div class="card">
				  	<h4 class="card-header bg--white">Main Budgets</h4>
				  	<div class="card-body">
				  		<group-bar-chart 
							:data="{{ json_encode($data) }}"
							:date="{{ json_encode($date) }}"
							:years="{{ json_encode($years) }}"
							:months="{{ json_encode($months) }}"
							update-url="{{ route('manager.dashboard.type') }}"
							filter-url="{{ route('manager.dashboard.filter') }}"
				  		></group-bar-chart>
				  	</div>
				</div>
			</div>
		</div>

		<doughnut-chart
	  		:specializations="{{ $specializations }}"
			:data="{{ json_encode($doughnut_data) }}"
			:bg-color="{{ json_encode($doughnut_data_color) }}"
			:labels="{{ json_encode($doughnut_labels) }}"
			text="{{ $doughnut }}"
			update-url="{{ route('manager.dashboard.doughnut-update') }}"
			:table-data="{{ json_encode($table_data) }}"
			:years="{{ json_encode($years) }}"
		></doughnut-chart>
    </section>
</div>

@endsection