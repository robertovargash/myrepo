@extends('layouts.main')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="pull-right">
            <button type="button" class="btn btn-success mb-2 " data-toggle="modal" data-target="#modalAddContact">@lang('contact_list.btn_new')</button>
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">@lang('contact_list.contact_card_title')</h3>
            </div>
            <div class="card-body">
              <table id="tablacontacts" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>@lang('contact_list.contact_name_th')</th>
                      <th>@lang('contact_list.contact_phone_th')</th>
                      <th>@lang('contact_list.contact_birth_th')</th>
                      <th>@lang('contact_list.contact_type_th')</th>
                      <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->birthdate}} </td>
                        <td>{{ $contact->contacttype->type }}</td>
                         <td>
                           <div>
                              <a href="{{ route('contacts.edit',$contact) }}" class="btn btn-link"><span class="fas fa-pencil-alt"></a>
                              <a class="btn btn-link deleteContact" data-id="{{$contact->id}}"><span class="fas fa-trash text-danger"></a>
                           </div>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
          </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
</div>


<div class="modal fade" aria-modal="false" id="deleteContactModal">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('contact_list.delete_modal_title')</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>@lang('contact_list.delete_modal_message')</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('contact_list.delete_modal_closebtn')</button>
        <form action="{{route('contacts.destroy')}}" method="POST">
          @csrf
          @method('DELETE')
          <input type="hidden", name="id" id="contact_id">
          <button type="submit" class="btn btn-danger">@lang('contact_list.delete_modal_deletebtn')</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modalAddContact">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('contact_list.add_modal_title')</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addcontact" action="{{ route('contacts.store') }}" method="POST">
          @csrf
           <div class="row">
              <div class="col-12">
                  <div class="form-group">
                      <strong>@lang('contact_list.modal_name_field'):</strong>
                      <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="@lang('contact_list.modal_name_field')">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="col-12">
                  <div class="form-group">
                      <strong>@lang('contact_list.modal_phone_field'):</strong>
                      <div class="input-group mb-3">
                        <input type="text" name="phone" class="form-control" placeholder="@lang('contact_list.modal_phone_field')" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                    <strong>@lang('contact_list.modal_birth_field'):</strong>
                    <input type="date" name="birthdate" class="form-control">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <strong>@lang('contact_list.modal_type_field'):</strong>
                  <div class="input-group mb-3">
                    <select class="form-control select2bs4" name="contacttype_id">
                      <option value="" selected="selected" hidden="hidden">@lang('contact_list.modal_select_field')</option>
                      @foreach ($contacttypes as $typee)
                          <option value="{{$typee->id}}">{{$typee->type}}</option>
                      @endforeach
                  </select>
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-list"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                  <div class="form-group">
                      <strong>@lang('contact_list.modal_detail_field'):</strong>
                      <textarea class="form-control textarea" style="height:150px" name="description" placeholder="Descriptions">No details</textarea>
                  </div>
              </div>
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success btn-block">@lang('contact_list.modal_insertbtn')</button>
              </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection
@section('scripts')
<script type="text/javascript">
  $(function () {
    $('#tablacontacts').DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

$(document).on('click','.deleteContact',function(){
  var contactID=$(this).attr('data-id');
  $('#contact_id').val(contactID);
  $('#deleteContactModal').modal('show');
});

  $(document).ready(function () {
    $('#addcontact').validate({
      rules: {
        contacttype_id: {
          required: true,
        },
        name: {
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
        name: {
          required: "@lang('contact_list.modal_required_name')",
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
