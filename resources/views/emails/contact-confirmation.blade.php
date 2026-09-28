<x-mail::message>
# Grazie, {{ $contact['name'] }}!

abbiamo ricevuto il tuo messaggio e ti risponderemo il prima possibile.

<x-mail::panel>
**I tuoi dati**  
**E-mail:** {{ $contact['email'] }}  
**Oggetto:** {{ filled($contact['subject'] ?? null) ? $contact['subject'] : '—' }}
</x-mail::panel>

## Il tuo messaggio

{{ $contact['message'] }}

Per questioni urgenti puoi contattarci all’indirizzo [{{ config('mail.admin_address') }}](mailto:{{ config('mail.admin_address') }}) oppure telefonicamente al [+39 02 8475 1932](tel:+390284751932).

<x-mail::button :url="route('shop')" color="primary">
Vai al negozio
</x-mail::button>

Cordiali saluti,<br>
Il team PelletCasa
</x-mail::message>
