@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) combiecito -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="pull-left">
            <h2>@lang('contact_list.editing_type')</h2>
          </div>
          <div class="pull-right">
              <a class="btn btn-primary" href="{{ route('contacttypes.index') }}"> @lang('contact_list.ctlist')</a>
          </div>        </div><!-- /.col -->            
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
          <div class="card card-default">
            <div class="card-body">
                <form id="edictcontact" action="{{ route('contacttypes.update',$contacttype->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                     <div class="row">                            
                        <div class="col-12">
                            <div class="form-group">
                                <strong>@lang('contact_list.contact_type_th'):</strong>
                                <div class="input-group mb-3">
                                  <input type="text" value="{{ $contacttype->type }}" name="type" class="form-control" placeholder="@lang('contact_list.contact_type_th')">
                                  <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                                  </div>                        
                                </div>
                            </div>
                        </div>                        
                        <div class="col-12 text-left">
                          <button type="submit" class="btn btn-success btn-block">@lang('contact_list.update_btn')</button>
                        </div>
                    </div>            
                  </form>
            </div>
          </div>   
        </div>    
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function () {
    $('#edictcontact').validate({
      rules: {
        type: {
          required: true,
        },
      },
      messages: {
        type: {
          required: "@lang('contact_list.add_modalctype_field')",
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });  
</script>
@endsection