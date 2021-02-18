@extends('layouts.admin')
@section('content')
@can('tender_category_create')
    <!-- <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('bid.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bidManagement.title_singular') }}
            </a>
        </div>
    </div> -->
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bidManagement.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TenderCategory">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>{{ trans('cruds.tenderManagement.fields.tender_title') }}</th>
                        <th>Tender Category</th>
                        <th>Tender Close Date</th>
                        <th>Bid Date</th>
                        <th>Status</th>
                        <th>{{ trans('cruds.tenderManagement.fields.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bids as $key => $bid)
                        <tr data-entry-id="{{ $bid->id }}">
                            <td></td>
                            <td>{{ $bid->tender_title ?? '-' }}</td>
                            <td>{{ $bid->category_name ?? '-' }}</td>
                            <td>{{ $bid->close_date ?? '' }}</td>
                            <td>{{ $bid->created_at ?? '' }}</td>
                            <td>
                              @if($bid->status==1)
                               Active
                              @else
                               In-Active
                              @endif
                            </td>
                            <td>
                                @can('tender_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('bid.show', $bid->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('tender_category_edit')
                                    <!-- <a class="btn btn-xs btn-info" href="{{ route('bid.edit', $bid->id) }}">
                                        {{ trans('global.edit') }}
                                    </a> -->
                                @endcan
                                <a class="btn btn-xs btn-info" href="{{ route('bid.edit', $bid->id) }}">
                                Close
                                </a>
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

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
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
