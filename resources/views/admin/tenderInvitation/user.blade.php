@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Select users for invitation
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-TenderCategory">
                    <thead>
                    <tr>
                        <th width="10"></th>
                        <th>Sr No.</th>
                        <th>Name of company</th>
                        <th>Company registration number</th>
                        <th>Company contact person</th>
                        <th>Main email address</th>
                        <th>Mobile number</th>
                        <th>Company address</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $tender)
                        <tr data-entry-id="{{ $tender->id }}">
                            <td></td>
                            <td>{{ ++$key }}</td>
                            <td>{{ $tender->supplier_name ?? '-' }}</td>
                            <td>{{ $tender->company_reg_number ?? '-' }}</td>
                            <td>{{ $tender->company_contact_person ?? '-' }}</td>
                            <td>{{ $tender->email ?? '-' }}</td>
                            <td>{{ $tender->mobile ?? '-' }}</td>
                            <td>{{ $tender->address ?? '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{ route('admin.tender.invitation.send') }}" id="tenderSendForm" method="post">
                @csrf
                <input type="hidden" name="tender_ids" value="{{ $tenderIds }}">
                <input type="hidden" name="user_ids" value="">
            </form>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
{{--            @can('tender_invitation')--}}
            let sendButtonText = 'Send Invitation'
            let sendButton = {
                text: sendButtonText,
                url: "{{ route('admin.tender.invitation.send') }}",
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
                    $("#tenderSendForm input[name=user_ids]").val(ids);
                    $("#tenderSendForm").submit();
                }
            }
            dtButtons.push(sendButton)
{{--            @endcan--}}

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

                table.column(index).search(value, strict).draw()
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
