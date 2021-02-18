@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="{{ $chart1->options['column_class'] }}">
                            <h3>{!! $chart1->options['chart_title'] !!}</h3>
                            {!! $chart1->renderHtml() !!}
                        </div>
                        <div class="{{ $chart2->options['column_class'] }}">
                            <h3>{!! $chart2->options['chart_title'] !!}</h3>
                            {!! $chart2->renderHtml() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Invite Tenders
                </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-TenderCategory">
                            <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>{{ trans('cruds.tenderManagement.fields.tender_title') }}</th>
                                <th>{{ trans('cruds.tenderManagement.fields.datetime') }}</th>
                                <th>{{ trans('cruds.tenderManagement.fields.status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inviteTenders as $key => $record)
                                <tr data-entry-id="{{ $record->tender->id }}">
                                    <td>{{ ++$key }}</td>
                                    <td>{{  $record->tender->tender_title ?? '-' }}</td>
                                    <td>
                                        Open:-{{ date('Y-m-d', strtotime( $record->tender->open_date)) ?? '' }}
                                        Close:- {{ date('Y-m-d', strtotime( $record->tender->close_date)) ?? '' }}
                                    </td>
                                    <td>
                                        @if( date('Y-m-d') < date('Y-m-d', strtotime( $record->tender->close_date)) )
                                            Open
                                        @else
                                            Close
                                        @endif
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
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart1->renderJs() !!}{!! $chart2->renderJs() !!}
@endsection
