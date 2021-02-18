@component('mail::message')
    Hello {{ $data['user']['supplier_name'] }},
    <br>
    Thank you for choosing {{ config('app.name') }}!

    Click below to tender details <a href="{{ route('admin.tender.show',$data['tender']['id']) }}">Go to your tender</a>

    Sincerely,
    {{ config('app.name') }}.
@endcomponent
