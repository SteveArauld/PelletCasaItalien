<x-mail::message>
# Neue Kontaktanfrage

Sie haben eine neue Nachricht über das Kontaktformular auf **Sr-pellethaus** erhalten.

<x-mail::panel>
**Name:** {{ $contact['name'] }}  
**E-Mail:** [{{ $contact['email'] }}](mailto:{{ $contact['email'] }})  
**Thema:** {{ filled($contact['subject'] ?? null) ? $contact['subject'] : '—' }}
</x-mail::panel>

## Nachricht

{{ $contact['message'] }}

<x-mail::button :url="'mailto:'.$contact['email']" color="primary">
Antworten
</x-mail::button>

Mit freundlichen Grüßen,<br>
Sr-pellethaus System
</x-mail::message>
