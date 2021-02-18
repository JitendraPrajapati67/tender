@extends('layouts.admin')
@section('content')
@can('tender_category_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tender.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tenderManagement.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tenderManagement.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TenderCategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Sr No.
                        </th>
                         <th>
                            {{ trans('cruds.tenderManagement.fields.tender_title') }}
                        </th>

                        <th>
                            {{ trans('cruds.tenderManagement.fields.datetime') }}
                        </th>

                        <th>
                            {{ trans('cruds.tenderManagement.fields.status') }}
                        </th>

                          <th>
                            Tender Type
                        </th>

                        <th>
                            {{ trans('cruds.tenderManagement.fields.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tender as $key => $tender)
                        <tr data-entry-id="{{ $tender->id }}">
                            <td>

                            </td>
                            <td>
                                {{ ++$key }}
                            </td>
                            <td>
                                {{ $tender->tender_title ?? '-' }}

                            </td>
                            
                            <td>
                               Open:-{{ date('Y-m-d', strtotime($tender->open_date)) ?? '' }}
                               Close:- {{ date('Y-m-d', strtotime($tender->close_date)) ?? '' }}
                            </td>
                            <td>
                            @if( date('Y-m-d') < date('Y-m-d', strtotime($tender->close_date)) )
                              Open
                            @else
                              Close
                            @endif
                            </td>
                            <td>
                              @if($tender->type==0)
                                  Free
                                @else
                                  Paid
                                @endif
                            </td>
                            <td>
                                @can('tender_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tender.show', $tender->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @if( Auth::user()->id == 1)
                                  <a class="btn btn-xs btn-info" href="{{ route('admin.tender.edit', $tender->id) }}">
                                        {{ trans('global.edit') }}
                                  </a>
                                  <form action="{{ route('admin.tender.destroy', $tender->id) }}" method="POST"  style="display: inline-block;">
                                      <input type="hidden" name="_method" value="DELETE">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <input type="submit" class=" delete  btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                  </form>
                                  <form action="{{ route('admin.tender.status') }}" method="POST"  style="display: inline-block;">
                                      <input type="hidden" name="_method" value="DELETE">
                                      <input type='hidden' name='id' value='{{$tender->id}}'>
                                      
                                      <input type='hidden' name='status' value='{{$tender->status}}'>
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      @if($tender->status == 0)
                                      <input type="submit" class="btn btn-xs btn-danger In-active" value="active ?">
                                      @else
                                      <input type="submit" class="btn btn-xs btn-danger In-active" value="In-active ?">
                                      @endif
                                  </form>
                                @else
                                   <a class="btn btn-xs btn-primary" href="{{ route('bid.create') }}/{{ $tender->id }}">
                                        Bid {{ trans('global.add') }}
                                  </a>  
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {

      function deleteFunction() {
          event.preventDefault(); // prevent form submit
          var form = event.target.form; // storing the form
                  swal({
            title: "Are you sure?",
            text: "Do You Want To Delete Tender?.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm){
            if (isConfirm) {
              form.submit();          // submitting the form when user press yes
            } else {
            }
          });
    }

$('.In-active').click(function(){
  event.preventDefault(); // prevent form submit
      var form = event.target.form;
           swal({
        title: '{{ trans('global.areYouSure') }} ',
        text: 'Do You Wont to Change Status tender?',
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();  
        } 
      });
  });
    $('.delete').click(function(){
      event.preventDefault(); // prevent form submit
      var form = event.target.form;
           swal({
        title: '{{ trans('global.areYouSure') }} ',
        text: 'Do You Wont to Delete tender?',
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();  
        } 
      });
    });
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('tender_category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tender.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      swal({
        title: '',
        text: '{{ trans('global.areYouSure') }}',
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { 

            location.reload() 

          })
        } 
      });

    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-TenderCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection
