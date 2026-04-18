<x-mail::message>
{{-- Salutations --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Oups !')
@else
# @lang('Bonjour !')
@endif
@endif

{{-- Introduction --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach

{{-- Bouton d'action --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success' => 'success',
        'error' => 'error',
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Conclusion --}}
@foreach ($outroLines as $line)
{{ $line }}
@endforeach

{{-- Signature --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Cordialement,<br>
L'équipe de la **{{ config('app.name') }}**
@endif

{{-- Lien de secours --}}
@isset($actionText)
<x-slot:subcopy>
Si vous rencontrez des difficultés avec le bouton "{{ $actionText }}",
copiez et collez l'URL ci-dessous dans votre navigateur Web :
<span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
