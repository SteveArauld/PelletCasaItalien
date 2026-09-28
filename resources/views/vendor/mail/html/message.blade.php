<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
Sr-pellethaus
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{!! $slot !!}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{!! $subcopy !!}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
**Sr-pellethaus** · HOLZ &amp; PELLETS<br>
<a href="mailto:{{ config('mail.admin_address') }}">{{ config('mail.admin_address') }}</a>
· <a href="tel:+498722965418">+49 8722 965 418</a><br>
Industriestraße 8, 84359 Simbach am Inn, Deutschland<br><br>
© {{ date('Y') }} Sr-pellethaus. Alle Rechte vorbehalten.
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
