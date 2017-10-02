@extends('app')

@section('contentheader_title')

    <div class="row">
        <div class="col-md-10">
            <ol class="breadcrumb">
              
              <li class="active">Afiliados Observados</li>
            </ol>
        </div>
        <div class="col-md-12 text-right">
                
        
          <div class="btn-group"  data-toggle="tooltip" data-original-title="Exportar Informe de Observados" style="margin: 0;">
                    <a href="{!! url('export_excel_observations') !!}" class="btn btn-success btn-raised bg-blue" ><i class="glyphicon glyphicon-save glyphicon-lg"></i></a>
          </div>

          <div class="btn-group"  data-toggle="tooltip" data-original-title="Exportar Informe de Observados NO REVISADOS" style="margin: 0;">
                    <a href="{!! url('export_not_review') !!}" class="btn btn-success btn-raised bg-red" ><i class="glyphicon glyphicon-save glyphicon-lg"></i></a>
          </div>

          
        </div>          
    </div>

@endsection

@section('main-content')
<div class="row">
        <div class="col-md-12">
            <div class="box box-warning">

              <div class="box-header with-border">
                    <h3 class="box-title"><span class="glyphicon glyphicon-search"></span> Búsqueda</h3>
                </div>

                <div class="box-body">
                        <table class="table table-bordered" id="observation-table">
                                <thead>
                                    <tr>
                                  
                                        <th> Nro. Carnet </th>
                                      {{--  <th> Matricula </th> --}}
                                      {{--  <th> Grado </th> --}}
                                        <th> Nombres</th>
                                        <th> Apellidos</th>
                                     
                                        <th> Estado </th>
                                        <th> Observacion </th>
                                        <th> Accion </th>
                                      
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        {{-- <th></th> --}}
                                        {{-- <th></th> --}}
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>

                        </table>
                </div> 
            </div>
        </div>
</div>
   


@push('scripts')
<script>
$(function() {
    $('#observation-table').DataTable({
        processing: true,   
        serverSide: true,
        ajax: '{!! route('getdataobservations') !!}',
        columns: [
            
            { data: 'identity_card', name: 'identity_card' },
            //{ data: 'registration', name: 'registration' },
            //{ data: 'shortened', name: 'shortened' },
            { data: 'names', name: 'names' },
            { data: 'surnames', name: 'surnames' },
            { data: 'state', name: 'state',orderable: false, searchable: true},
            { data: 'observation', name: 'observation' },
            { data: 'action', name: 'action' , orderable: false, searchable: false }

        ],
        initComplete: function(){
            this.api().columns().every(function(){
                var column = this;
                var input = document.createElement('input');

                $(input).appendTo($(column.footer()).empty()).on(
                    'change',function(){
                    
                        column.search($(this).val()).draw();
                    });
            });
        }
    });

});

$(document).ready(function(){
    $('input[type=text]').addClass('form-control');
});
</script>
@endpush

@endsection