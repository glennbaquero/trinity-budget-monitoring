@extends('web.pages.manager.master')

@section('meta:title', 'My Account')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">User Information</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manager</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">User Information</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <ul class="nav frm-tabs" id="myTab" role="tablist">
            <li class="frm-tabs__item">
                <a class="frm-tabs__link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile Details</a>
            </li>
            <li class="frm-tabs__item">
                <a class="frm-tabs__link" id="change-pw-tab" data-toggle="tab" href="#change-pw" role="tab" aria-controls="change-pw" aria-selected="true">Change Password</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                <manager-user-view
                :editable="false"
                fetch-url="{{ route('manager.profiles.fetch') }}"
                submit-url="{{ route('manager.profiles.update') }}"
                ></manager-user-view>   

            </div>
            <div class="tab-pane fade" id="change-pw" role="tabpanel" aria-labelledby="change-pw-tab">
                <change-password submit-url="{{ route('manager.profiles.change-password') }}"></change-password>
            </div>
        </div>

    </section>
</div>

@endsection