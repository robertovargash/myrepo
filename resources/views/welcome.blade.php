@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@lang('contact_list.home')</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $contacts }}</h3>
                  <p>@lang('contact_list.card_contacts')</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('contacts.index') }}" class="small-box-footer">@lang('contact_list.more_info') <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $contacttypes }}</h3>

                  <p>@lang('contact_list.card_ctype')</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">@lang('contact_list.more_info') <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    </div>
@endsection
