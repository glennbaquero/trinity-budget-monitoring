<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('fonts/K2D/style.css') }}"> --}}
	<style type="text/css">
		.table-data {
		  	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
		}

		.table-data td, .table-data th {
		  	border: 0px solid #ddd;
		  	padding: 8px;
		}

		.table-data td {
			width: 50%;
		}
		
		.no-bgcolor {
			background-color: black;
		}

		.table-data tr:nth-child(even){background-color: #f2f2f2;}

		.table-data th {
		  	padding-top: 35px;
		  	padding-bottom: 35px;
		  	text-align: left;
		  	background-color: #bc3c3c;
		  	color: white;
		  	text-align: center;
		  	font-size: 27px;
		}

	</style>
{{-- 	<style type="text/css">
		/* Style the body */
		body {
		  	margin: 0;
		    font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
		    font-size: 1rem;
		    font-weight: 400;
		    line-height: 1.5;
		    color: #212529;
		    background-color: #fff;
		}

		.wrapper {
		    position: relative;
		}
		.wrapper, body, html {
		    min-height: 100%;
		    font-family: 'K2D';
		}

		@media (min-width: 768px)
		body:not(.sidebar-mini-md) .content-wrapper, body:not(.sidebar-mini-md) .main-footer, body:not(.sidebar-mini-md) .main-header {
		    transition: margin-left .3s ease-in-out;
		    margin-left: 250px;
		}
		.wrapper .content-wrapper {
		    min-height: calc(100vh - calc(3.5rem + 1px) - calc(3.5rem + 1px));
		}
		.content-wrapper {
		    background: white;
		}

		.content-wrapper>.content {
		    padding: 0 .5rem;
		}
		article, aside, figcaption, figure, footer, header, hgroup, main, nav, section {
		    display: block;
		}
		*, ::after, ::before {
		    box-sizing: border-box;
		}
		section {
		    display: block;
		}
		.row {
		    display: -ms-flexbox;
		    display: flex;
		    -ms-flex-wrap: wrap;
		    flex-wrap: wrap;
		    margin-right: -7.5px;
		    margin-left: -7.5px;
		}
		.container-fluid {
		    width: 100%;
		    padding-right: 7.5px;
		    padding-left: 7.5px;
		    margin-right: auto;
		    margin-left: auto;
		}

		.col-12 {
		    -ms-flex: 0 0 100%;
		    flex: 0 0 100%;
		    max-width: 100%;
		}
		.col-3 {
		    -ms-flex: 0 0 25%;
		    flex: 0 0 25%;
		    max-width: 25%;
		}
		.col-4 {
		    -ms-flex: 0 0 33.333333%;
		    flex: 0 0 33.333333%;
		    max-width: 33.333333%;
		}
		.col-6 {
		    -ms-flex: 0 0 50%;
		    flex: 0 0 50%;
		    max-width: 50%;
		}
		.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
		    position: relative;
		    width: 100%;
		    padding-right: 7.5px;
		    padding-left: 7.5px;
		}

		.callout {
		    border-radius: .25rem;
		    margin-bottom: 1rem;
		    text-align: center;
		}

		/*.callout.callout-info {
		    border-left-color: #117a8b;
		}*/

		.invoice {
		    background: #fff;
		    border: 1px solid rgba(0,0,0,.125);
		    position: relative;
		}
		.p-3 {
		    padding: 1rem!important;
		}
		.mb-3, .my-3 {
		    margin-bottom: 1rem!important;
		}

		.h4, h4 {
		    font-size: 1.5rem;
		}
		.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
		    margin-bottom: .5rem;
		    font-family: inherit;
		    font-weight: 500;
		    line-height: 1.2;
		    color: inherit;
		}

		/* Header/Logo Title */
		.header {
		  	padding: 30px;
		  	text-align: center;
		  	color: black;
		  	font-size: 70px;
		}

		/* Page Content */
		.content {padding:20px;}

		label {
			font-weight: bold;
		}

		p {
		    display: block;
		    margin-block-start: 0;
		    margin-block-end: 0;
		    margin-inline-start: 0px;
		    margin-inline-end: 0px;
		    font-size: 18px;
		}
	</style> --}}
</head>
<body >
	<table width="100%" class="table-data">
		<thead>
			<tr>
				<th colspan="2">TrinityHeath Philippines</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					PERSON IN CHARGE (SALES): 
					<p><b>{{ $data->user->renderName() }}</b></p>
				</td>
				<td style="text-align: right">
					REQUEST CREATED DATE: 
					<p><b>{{ $data->renderDate() }}</b></p>
				</td>
			</tr>
			<tr>
				<td>
					PURCHASE ORDER # : 
					<p><b>{{ $data->renderRequestOrderNumber() }}</b></p>
				</td>
				<td>
					PURCHASE ORDER : 
					<p><b>{{ $data->name }}</b></p>
				</td>
			</tr>
			<tr>
				<td>
					PPP BUDGET : 
					<p><b>{{ $data->pppRequest->name }}</b></p>
				</td>
				<td>
					DISTRICT MANAGER APPROVED DATE : 
					<p><b>{{ $data->renderDateColumn('district_manager_approved_at') }}</b></p>
				</td>
			</tr>
			<tr>
				<td>
					MANAGER APPROVED DATE : 
					<p><b>{{ $data->renderDateColumn('manager_approved_at') }}</b></p>
				</td>
				<td>
					MANAGEMENT APPROVED DATE : 
					<p><b>{{ $data->renderDateColumn('super_admin_approved_at') }}</b></p>
				</td>
			</tr>
			<tr>
				<td>
					PO BUDGET : 
					<p><b>{{ $data->renderRequestAmount(false) }}</b></p>
				</td>
				<td>
					SUPPLIER : 
					<p><b>{{ $data->supplier ?? 'N/A' }}</b></p> 
				</td>
			</tr>
			<tr>
				<td>
					PROGRAM TITLE :
					<p><b>{{ $data->program_title }}</b></p>
				</td>
				<td>
					PURPOSE :
					<p><b>{{ $data->purpose ?? 'N/A' }}</b></p>
				</td>
			</tr>
			<tr>
				<td>
					DESCRIPTION :
					<p><b>{{ $data->description ?? 'N/A' }}</b></p>
				</td>
				<td>
					OBJECTIVE :
					<p><b>{{ $data->objective ?? 'N/A' }} Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia ipsam id nostrum vel adipisci nulla eos? Aliquam nobis, dignissimos beatae minus dolorem expedita accusantium modi pariatur hic. Natus, autem, dolor!</b></p>
				</td>
			</tr>
			<tr>
				<td>
					SCHEME :
					<p><b>{{ $data->scheme ?? 'N/A' }}</b></p>
				</td>
				<td>
					MECHANICS :
					<p><b>{{ $data->mechanics ?? 'N/A' }}</b></p>
				</td>
			</tr>
			<tr>
				<td>
					ADDITIONAL NOTES :
					<p><b>{{ $data->additional_notes ?? 'N/A' }}</b></p>
				</td>
				<td>
					ADDITIONAL INSTRUCTION :
					<p><b>{{ $data->additional_instruction ?? 'N/A' }}</b></p>
				</td>
			</tr>
		</tbody>
	</table>

{{-- 	<div class="wrapper">
		<div class="content-wrapper">
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<br>
							<div class="callout ">
								<h4><b>TRINITY HEALTH PH</b></h4>
							</div>
							<div class=" p-3 mb-3">
								<div class="row">
									<div class="col-6 mb-3">
										<label>PURCHASE ORDER # :</label> 
										<p>{{ $data->renderRequestOrderNumber() }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>PURCHASE ORDER :</label> 
										<p>{{ $data->name }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>PPP BUDGET :</label> 
										<p>{{ $data->pppRequest->name }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>DISTRICT MANAGER APPROVED DATE :</label> 
										<p>{{ $data->renderDateColumn('district_manager_approved_at') }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>MANAGER APPROVED DATE :</label> 
										<p>{{ $data->renderDateColumn('manager_approved_at') }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>MANAGEMENT APPROVED DATE :</label> 
										<p>{{ $data->renderDateColumn('super_admin_approved_at') }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>PO BUDGET :</label> 
										<p>{{ $data->renderRequestAmount() }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>SUPPLIER :</label> 
										<p>{{ $data->supplier ?? 'N/A' }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>PROGRAM TITLE :</label> 
										<p>{{ $data->program_title }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>PURPOSE :</label> 
										<p>{{ $data->purpose ?? 'N/A' }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>DESCRIPTION :</label> 
										<p>{{ $data->description ?? 'N/A' }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>OBJECTIVE :</label> 
										<p>{{ $data->objective ?? 'N/A' }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>SCHEME :</label> 
										<p>{{ $data->scheme ?? 'N/A' }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>MECHANICS :</label> 
										<p>{{ $data->mechanics ?? 'N/A' }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>ADDITIONAL NOTES :</label> 
										<p>{{ $data->additional_notes ?? 'N/A' }}</p>
									</div>
									<div class="col-6 mb-3">
										<label>ADDITIONAL INSTRUCTION :</label> 
										<p>{{ $data->additional_instruction ?? 'N/A' }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div> --}}
</body>
</html>