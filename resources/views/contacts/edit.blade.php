@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="pull-left">
            <h2>@lang('contact_list.edit_header')</h2>
          </div>
          <div class="pull-right">
              <a class="btn btn-primary" href="{{ route('contacts.index') }}"> @lang('contact_list.back_btn')</a>
          </div>
          @if ($errors->any())
        <div class="alert alert-danger">
          <strong>Error!</strong><br><br>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">@lang('contact_list.card_header')</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <form id="edictcontact" action="{{ route('contacts.update',$contact->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                     <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                            <div class="form-group">
                                <strong>@lang('contact_list.modal_name_field'):</strong>
                                <div class="input-group mb-3">
                                  <input type="text" value="{{ $contact->name }}" name="name" class="form-control" placeholder="@lang('contact_list.modal_name_field')">
                                  <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                            <div class="form-group">
                                <strong>@lang('contact_list.modal_phone_field'):</strong>
                                <div class="input-group mb-3">
                                  <input type="text" id="phone-number" name="phone" value="{{ $contact->phone }}" class="form-control" placeholder="(XXX) XXX-XXXX">
                                  <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                          <div class="form-group">
                              <strong>@lang('contact_list.modal_birth_field'):</strong>
                              <input type="date" id="datepicker-input" name="birthdate" value="{{ $contact->birthdate }}" class="form-control">
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                          <div class="form-group">
                            <strong>@lang('contact_list.modal_type_field'):</strong>
                            <div class="input-group mb-3">
                              <select class="form-control select2bs4" name="contacttype_id" style="width: 100%;">
                                <option value="" selected="selected" hidden="hidden">@lang('contact_list.modal_select_field')</option>
                                @foreach ($contacttypes as $typee)
                                    <option value="{{$typee->id}}" {{ $contact->contacttype_id == $typee->id ? ' selected ' : '' }}>{{$typee->type}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <strong>@lang('contact_list.modal_detail_field'):</strong>
                                <textarea class="form-control textarea" style="height:150px" name="description" placeholder="Descriptions">{{ $contact->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                          <button type="submit" class="btn btn-success btn-block">@lang('contact_list.update_btn')</button>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
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

$(document).ready(function()
{
    var now = new Date();

    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);

    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $("#datepicker-input").attr("max",today);

    $('#phone-number')

	.keydown(function (e) {
		var key = e.which || e.charCode || e.keyCode || 0;
		$phone = $(this);

    // Don't let them remove the starting '('
    if ($phone.val().length === 1 && (key === 8 || key === 46)) {
			$phone.val('(');
      return false;
		}
    // Reset if they highlight and type over first char.
    else if ($phone.val().charAt(0) !== '(') {
			$phone.val('('+String.fromCharCode(e.keyCode)+'');
		}

		// Auto-format- do not expose the mask as the user begins to type
		if (key !== 8 && key !== 9) {
			if ($phone.val().length === 4) {
				$phone.val($phone.val() + ')');
			}
			if ($phone.val().length === 5) {
				$phone.val($phone.val() + ' ');
			}
			if ($phone.val().length === 9) {
				$phone.val($phone.val() + '-');
			}
		}

		// Allow numeric (and tab, backspace, delete) keys only
		return (key == 8 ||
				key == 9 ||
				key == 46 ||
				(key >= 48 && key <= 57) ||
				(key >= 96 && key <= 105));
	})

	.bind('focus click', function () {
		$phone = $(this);

		if ($phone.val().length === 0) {
			$phone.val('(');
		}
		else {
			var val = $phone.val();
			$phone.val('').val(val); // Ensure cursor remains at the end
		}
	})

	.blur(function () {
		$phone = $(this);

		if ($phone.val() === '(') {
			$phone.val('');
		}
	});
});
  $(document).ready(function () {
    $('#edictcontact').validate({
      rules: {
        contacttype_id: {
          required: true,
        },

        birthdate: {
          required: true,
        },
      },
      messages: {
        contacttype_id: {
          required: "@lang('contact_list.modal_type_required')",
        },
        birthdate: {
          required:  "@lang('contact_list.modal_bith_required')",
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
