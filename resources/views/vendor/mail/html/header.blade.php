@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
@php
    $logoPath = public_path('images/logo-email.png');
    $logoSrc = asset('images/logo-email.png');

    if (is_file($logoPath) && isset($message)) {
        $logoSrc = $message->embed($logoPath);
    }
@endphp
<img src="{{ $logoSrc }}" width="180" height="48" class="logo" alt="PelletCasa" style="width:180px;height:auto;border:0;display:block;">
</a>
</td>
</tr>
