<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/buttons.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/select.dataTables.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/coreui.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/dropzone.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/perfect-scrollbar.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/dropdowntree.css') }}" rel="stylesheet" />

    @yield('styles')
</head>

<body class="c-app">
    @include('partials.menu')
    <div class="c-wrapper">
        <header class="c-header c-header-fixed px-3">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
                <i class="fas fa-fw fa-bars"></i>
            </button>

            <a class="c-header-brand d-lg-none" href="#">{{ trans('panel.site_title') }}</a>

            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
                <i class="fas fa-fw fa-bars"></i>
            </button>

            <ul class="c-header-nav ml-auto">
                @if(count(config('panel.available_languages', [])) > 1)
                <li class="c-header-nav-item dropdown d-md-down-none">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach(config('panel.available_languages') as $langLocale => $langName)
                        <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                        @endforeach
                    </div>
                </li>
                @endif

                <ul class="c-header-nav ml-auto">
                    <li class="c-header-nav-item dropdown notifications-menu">
                        <a href="#" class="c-header-nav-link" data-toggle="dropdown">
                            <i class="far fa-bell"></i>
                            @php($alertsCount = \Auth::user()->userUserAlerts()->where('read', false)->count())
                            @if($alertsCount > 0)
                            <span class="badge badge-warning navbar-badge">
                                {{ $alertsCount }}
                            </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            @if(count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at', 'ASC')->get()->reverse()) > 0)
                            @foreach($alerts as $alert)
                            <div class="dropdown-item">
                                <a href="{{ $alert->alert_link ? $alert->alert_link : "#" }}" target="_blank" rel="noopener noreferrer">
                                    @if($alert->pivot->read === 0) <strong> @endif
                                        {{ $alert->alert_text }}
                                        @if($alert->pivot->read === 0) </strong> @endif
                                    </a>
                                </div>
                                @endforeach
                                @else
                                <div class="text-center">
                                    {{ trans('global.no_alerts') }}
                                </div>
                                @endif
                            </div>
                        </li>
                    </ul>

                </ul>
            </header>

            <div class="c-body">
                <main class="c-main">


                    <div class="container-fluid">
                        @if(session('message'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                            </div>
                        </div>
                        @endif
                        @if($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @yield('content')

                    </div>


                </main>
                <form id="logoutform" @if( Auth::user()->id == 1) action="{{ route('admin.logout') }}" @else action="{{ route('logout') }}" @endif method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('js/coreui.min.js')}}"></script>
        <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('js/buttons.flash.min.js')}}"></script>
        <script src="{{asset('js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('js/buttons.print.min.js')}}"></script>
        <script src="{{asset('js/buttons.colVis.min.js')}}"></script>
        <script src="{{asset('js/pdfmake.min.js')}}"></script>
        <script src="{{asset('js/vfs_fonts.js')}}"></script>
        <script src="{{asset('js/jszip.min.js')}}"></script>
        <script src="{{asset('js/dataTables.select.min.js')}}"></script>
        <script src="{{ asset('js/jquery.bootstrap.treeselect.js') }}"></script>

        <script src="{{asset('js/ckeditor.js')}}"></script>
        <script src="{{asset('js/moment.min.js')}}"></script>
        <script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>
        <script src="{{asset('js/select2.full.min.js')}}"></script>
        <script src="{{asset('js/dropzone.min.js')}}"></script>
        <script src="{{ asset('js/main.js') }}"></script>


        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            $(function() {
              let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
              let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
              let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
              let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
              let printButtonTrans = '{{ trans('global.datatables.print') }}'
              let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
              let selectAllButtonTrans = '{{ trans('global.select_all') }}'
              let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

              let languages = {
                'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
                'hi': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Hindi.json'
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                  url: languages['{{ app()->getLocale() }}']
              },
              columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                orderable: false,
                searchable: false,
                targets: -1
            }],
            select: {
              style:    'multi+shift',
              selector: 'td:first-child'
          },
          order: [],
          scrollX: true,
          pageLength: 100,
          dom: 'lBfrtip<"actions">',
          buttons: [
          {
            extend: 'selectAll',
            className: 'btn-primary',
            text: selectAllButtonTrans,
            exportOptions: {
              columns: ':visible'
          },
          action: function(e, dt) {
              e.preventDefault()
              dt.rows().deselect();
              dt.rows({ search: 'applied' }).select();
          }
      },
      {
        extend: 'selectNone',
        className: 'btn-primary',
        text: selectNoneButtonTrans,
        exportOptions: {
          columns: ':visible'
      }
  },
  {
    extend: 'copy',
    className: 'btn-default',
    text: copyButtonTrans,
    exportOptions: {
      columns: ':visible'
  }
},
{
    extend: 'csv',
    className: 'btn-default',
    text: csvButtonTrans,
    exportOptions: {
      columns: ':visible'
  }
},
{
    extend: 'excel',
    className: 'btn-default',
    text: excelButtonTrans,
    exportOptions: {
      columns: ':visible'
  }
},
{
    extend: 'pdf',
    className: 'btn-default',
    text: pdfButtonTrans,
    exportOptions: {
      columns: ':visible'
  }
},
{
    extend: 'print',
    className: 'btn-default',
    text: printButtonTrans,
    exportOptions: {
      columns: ':visible'
  }
},
{
    extend: 'colvis',
    className: 'btn-default',
    text: colvisButtonTrans,
    exportOptions: {
      columns: ':visible'
  }
}
]
});

            $.fn.dataTable.ext.classes.sPageButton = '';
        });

    </script>
    <script>
        $(document).ready(function () {
            $(".notifications-menu").on('click', function () {
                if (!$(this).hasClass('open')) {
                    $('.notifications-menu .label-warning').hide();
                    $.get('/admin/user-alerts/read');
                }
            });
        });

    </script>
    @yield('scripts')
</body>

</html>
