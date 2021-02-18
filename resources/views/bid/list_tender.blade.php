@extends('layouts.admin')
@section('content')

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
                                @if($tender->status==0)
                                  Close
                                @else
                                  Open
                                @endif
                                
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.tender.show', $tender->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                                @if(isset($bids[$tender->id]))
                                  <a class="btn btn-xs btn-primary" href="{{ route('bid.edit',$bids[$tender->id]) }}">
                                        Bid Edit
                                  </a> 
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
