@extends('layouts.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              @if ($errors->any())
              <div class="alert alert-danger">
                  <strong>Vaya!</strong> Ocurrió un error.<br><br>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <div class="pull-right">
                {{-- <button type="button" class="btn btn-success mb-2 " href="{{ route('users.create') }}">Nuevo</button>                 --}}
                <a href="{{ route('users.create') }}" class="btn btn-success">Nuevo</a>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <section class="content">
        <div class="content-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">        
                  <h3 class="card-title">Usuarios</h3>            
                </div>
                <div class="card-body">
                  <table id="tablaUsuarios" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Correo electrónico</th>
                          <th>Ocupación</th>
                          <th></th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->profession }} </td>
                             <td>
                               <div>
                                  <a href="{{ route('users.edit',$usuario) }}" class="btn btn-link"><span class="fas fa-pencil-alt"></a>
                                  <a class="btn btn-link deleteUser" data-id="{{$usuario->id}}"><span class="fas fa-trash text-danger"></a>                               
                               </div>                                                                          
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Ocupación</th>
                            <th></th>
                        </tr>
                      </tfoot>
                  </table>
                </div>
              </div>
              </div>
            </div>
          </div>
      </section>
</div>

<div class="modal fade" aria-modal="false" id="deleteUserModal">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirmación</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Desea eliminar el usuario?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>       
        <form action="{{route('users.destroy')}}" method="POST">
          @csrf
          @method('DELETE')
          <input type="hidden", name="id" id="user_id">
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>                                            
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

{{-- <div class="modal fade" id="modalAddUser">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Registrar usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="adduser" method="POST" action="{{ route('users.store') }}">
            @csrf            
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="profession" class="col-md-4 col-form-label text-md-right">Profesión</label>

                <div class="col-md-6">
                    <input id="profession" type="text" class="form-control" name="profession" value="{{ old('profession') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electrónico</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmación</label>

                <div class="col-md-6">
                    <input id="passwordconfirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        Registrar
                    </button>
                </div>
            </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div> --}}
<!-- /.modal -->
@endsection
@section('scripts')
<script type="text/javascript">
  $(function () {
    $('#tablaUsuarios').DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

$(document).on('click','.deleteUser',function(){
  var userID=$(this).attr('data-id');
  $('#user_id').val(userID); 
  $('#deleteUserModal').modal('show'); 
});

  // $(document).ready(function () {
  //   $('#adduser').validate({
  //     rules: {
  //       name: {
  //         required: true,
  //       },
  //       profession: {
  //         required: true,
  //       },
  //       email: {
  //         required: true,
  //       },
  //       password: {
  //         required: true,
  //       },
  //       passwordconfirm: {
  //         required: true,
  //       },
  //     },
  //     messages: {
  //       name: {
  //         required: "Inserte el nombre",
  //       },
  //       profession: {
  //         required: "Inserte la profesión",
  //       },
  //       email: {
  //         required: "Inserte el correo electrónico",
  //       },
  //       password: {
  //         required: "Inserte contraseña",
  //       },
  //       passwordconfirm: {
  //         required: "Confirme la contraseña de nuevo",
  //       },
  //     },
  //     errorElement: 'span',
  //     errorPlacement: function (error, element) {
  //       error.addClass('invalid-feedback');
  //       element.closest('.form-group').append(error);
  //     },
  //     highlight: function (element, errorClass, validClass) {
  //       $(element).addClass('is-invalid');
  //     },
  //     unhighlight: function (element, errorClass, validClass) {
  //       $(element).removeClass('is-invalid');
  //     }
  //   });    
  // });
</script>
@endsection