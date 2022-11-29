@extends('web.pages.sales.master')
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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Sales Agent</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">PPP Available Budget</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
      	<ppp-doughnut
      		:specializations="{{ $specializations }}"
    		:data="{{ json_encode($doughnut_data) }}"
    		:bg-color="{{ json_encode($doughnut_data_color) }}"
    		:labels="{{ json_encode($doughnut_labels) }}"
    		:items="{{ json_encode($items) }}"
    		text="{{ $doughnut }}"
    		fetch-url="{{ route('web.ppp-available.fetch') }}"
            update-url="{{ route('web.ppp-available.ppp-budget.doughnut-update') }}"	
    	></ppp-doughnut> 
    </section>

</div>

    </section>
</div>

@endsection