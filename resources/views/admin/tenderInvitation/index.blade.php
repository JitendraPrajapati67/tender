@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Tender Invitation List
        </div>

        <div class="card-body">
            @include('partials.notification')
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-TenderCategory">
                    <thead>
                    <tr>
                        <th width="10"></th>
                        <th>Sr No.</th>
                        <th>{{ trans('cruds.tenderManagement.fields.tender_title') }}</th>
                        <th>{{ trans('cruds.tenderManagement.fields.datetime') }}</th>
                        <th>{{ trans('cruds.tenderManagement.fields.status') }}</th>
                        <th>Tender Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tender as $key => $tender)
                        <tr data-entry-id="{{ $tender->id }}">
                            <td></td>
                            <td>{{ ++$key }}</td>
                            <td>{{ $tender->tender_title ?? '-' }}</td>
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
                            <td>@if($tender->type==0) Free @else Paid @endif </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{ route('admin.tender.invitation.users') }}" id="tenderForm" method="post">
                @csrf
                <input type="hidden" name="tender_ids" value="">
            </form>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('tender_invitation')
            let sendButtonText = 'Send Invitation'
            let sendButton = {
                text: sendButtonText,
                url: "{{ route('admin.tender.invitation.users') }}",
                className: 'btn-primary',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')
                        return
                    }
                    // console.log(ids);
                    $("#tenderForm input[name=tender_ids]").val(ids);
                    $("#tenderForm").submit();
                    // $.ajax({
                    //     headers: {'x-csrf-token': _token},
                    //     method: 'POST',
                    //     url: config.url,
                    //     data: {ids: ids, _method: 'POST'}
                    // }).done(function () {
                    //     location.reload()
                    // })

                }
            }
            dtButtons.push(sendButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[1, 'asc']],
                pageLength: 10,
            });
            let table = $('.datatable-TenderCategory:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
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
            table.on('column-visibility.dt', function (e, settings, column, state) {
                visibleColumnsIndexes = []
                table.columns(":visible").every(function (colIdx) {
                    visibleColumnsIndexes.push(colIdx);
                });
            })
        })

    </script>
@endsection
