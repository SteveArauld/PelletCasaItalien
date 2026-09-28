<x-mail::message>
# Vielen Dank, {{ $contact['name'] }}!

wir haben Ihre Nachricht erhalten und werden uns so schnell wie möglich bei Ihnen melden.

<x-mail::panel>
**Ihre Angaben**  
**E-Mail:** {{ $contact['email'] }}  
**Thema:** {{ filled($contact['subject'] ?? null) ? $contact['subject'] : '—' }}
</x-mail::panel>

## Ihre Nachricht

{{ $contact['message'] }}

Bei dringenden Anliegen erreichen Sie uns unter [{{ config('mail.admin_address') }}](mailto:{{ config('mail.admin_address') }}) oder telefonisch unter [+49 8722 965 418](tel:+498722965418).

<x-mail::button :url="route('shop')" color="primary">
Zum Shop
</x-mail::button>

Mit freundlichen Grüßen,<br>
Ihr Sr-pellethaus Team
</x-mail::message>
