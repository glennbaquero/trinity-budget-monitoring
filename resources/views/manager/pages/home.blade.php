@extends('web.master')

@section('meta:title', $page->renderMeta('title'))
@section('meta:description', $page->renderMeta('description'))
@section('meta:keywords', $page->renderMeta('keywords'))
@section('og:image', $page->renderMetaImage())
@section('og:title', $page->renderMeta('og_title'))
@section('og:description', $page->renderMeta('og_description'))

@section('content')

<div class="jumbotron">
	<div class="col-sm-12 offset-md-6 col-md-6 text-center text-md-right">
		<h1 class="display-4">{{ config('app.name') }}</h1>
		<p class="lead">In Information Technology, a boilerplate is a unit of writing that can be reused over and over without change. By extension, the idea is sometimes applied to reusable programming, as in boilerplate code.</p>
		<hr class="my-4">
		<p>{{ $quote }}</p>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-5 order-2 order-sm-2 order-md-1">
			<h3 class="font-weight-bold">{{ $pageItems['frame_1_text'] }}</h3>
			<div>
				{!! $pageItems['frame_1_content'] !!}
			</div>
		</div>

		<div class="col-12 col-sm-12 col-md-7 order-1 order-sm-1 order-md-2">
			<img src="{{ $pageItems['frame_1_image'] }}" class="img-fluid img-thumbnail mb-3">
			<a href="{{ $pageItems['frame_1_link'] }}" class="btn btn-block btn-light mb-3">{{ $pageItems['frame_1_link_label'] }}</a>
		</div>
	</div>
</div>

{{-- <div class="container mt-5">
	<div class="col-sm-12 text-sm-center mb-5">
		<h1>{{ config('app.name') }}</h1>
	</div>
	<div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Guards</a></li>
                <li class="nav-item"><a class="nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">CMS</a></li>
                @if (auth('admin')->check())
	                <li class="nav-item"><a class="nav-link" data-target="#tab3" href="javascript:void(0)" data-toggle="tab">Data Table</a></li>
	                <li class="nav-item"><a class="nav-link" data-target="#tab4" href="javascript:void(0)" data-toggle="tab">CRUD</a></li>
                @endif
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane show active" id="tab1">
                	<div class="row justify-content-center">
                		<div class="col-sm-4">
							<div class="card">
								<div class="card-header">Admin</div>
								<div class="card-body">
									@if (auth('admin')->check())
										<h5 class="card-title text-primary">Get started!</h5>
										<p class="card-text">You are logged in as Admin User</p>
									@else
										<h5 class="card-title text-danger">Login Required...</h5>
										<p class="card-text">Please click on the link below to login</p>
									@endif
								</div>
								<div class="card-footer">
									<a class="btn btn-primary" href="{{ route('admin.login') }}">Login</a>
									<a class="btn btn-info" href="{{ route('admin.dashboard') }}">Dashboard</a>
								</div>
							</div>
						</div>

						<div class="col-sm-4 offset-sm-2">
							<div class="card">
								<div class="card-header">Web</div>
								<div class="card-body">
									@if (\Auth::guard('web')->check())
										<h5 class="card-title text-primary">Get started!</h5>
										<p class="card-text">You are logged in as Web User</p>
									@else
										<h5 class="card-title text-danger">Login Required...</h5>
										<p class="card-text">Please click on the link below to login</p>
									@endif
								</div>
								<div class="card-footer">
									<a class="btn btn-primary" href="{{ route('web.login') }}">Login</a>
									<a class="btn btn-info" href="{{ route('web.dashboard') }}">Dashboard</a>
								</div>
							</div>
						</div>
                	</div>
                </div>

                <div class="tab-pane" id="tab2">
                	<div class="row justify-content-center">
	                	<div class="col-sm-4">
							<div class="card">
								<img src="{{ $pageItems['frame_1_image'] }}" class="card-img-top">
								<div class="card-header">{{ $pageItems['frame_1_text'] }}</div>
								<div class="card-body">
									 <blockquote class="blockquote mb-0">
										{!! $pageItems['frame_1_content'] !!}
										<footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
									</blockquote>
								</div>
								<div class="card-footer">
									<a class="btn btn-primary btn-block" href="{{ $pageItems['frame_1_link'] }}" target="_blank">
										{{ $pageItems['frame_1_link_label'] }}
									</a>
								</div>
							</div>
						</div>
					</div>
                </div>
				
				@if (auth('admin')->check())
	                <div class="tab-pane" id="tab3">

	                    <sample-items-list
				        fetch-url="{{ route('admin.sample-items.fetch') }}"
				        export-url="{{ route('admin.sample-items.export') }}"
				        ></sample-items-list>

	                </div>

	                <div class="tab-pane" id="tab4">

	                    <sample-item-view
						fetch-url="{{ route('admin.sample-items.fetch-item') }}"
						submit-url="{{ route('admin.sample-items.store') }}"
						></sample-item-view>

	                </div>
				@endif
            </div>
        </div>
    </div>

</div> --}}

@endsection