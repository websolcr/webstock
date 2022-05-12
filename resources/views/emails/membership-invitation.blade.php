@component('mail::message')
# You have been invited

Organization "{{ $organization }}" is waiting for your acceptance...

@component('mail::button', ['url' => $signedUrl])
Accept
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
