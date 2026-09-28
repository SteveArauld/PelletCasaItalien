<x-mail::message>
# Vielen Dank für Ihre Bestellung, {{ $order->first_name ?: $order->name }}!

Ihre Bestellung **#{{ $order->reference }}** wurde erfolgreich aufgenommen und wird nun bearbeitet.

@if(($order->payment_method ?? null) === 'vorkasse')
Bitte überweisen Sie den Gesamtbetrag und senden Sie uns eine Kopie Ihrer Überweisung an [{{ config('mail.admin_address') }}](mailto:{{ config('mail.admin_address') }}).
@endif

## Bestellübersicht

<x-mail::table>
| Produkt | Menge | Preis |
| :------ | :---: | ----: |
@foreach($order->items as $item)
| {{ $item->product_name }} | {{ $item->quantity }} | {{ number_format((float) $item->unit_price, 2, ',', '.') }} € |
@endforeach
| **Gesamtsumme** |  | **{{ number_format((float) $order->total, 2, ',', '.') }} €** |
</x-mail::table>

<x-mail::panel>
**Lieferadresse**<br>
{{ $order->name }}<br>
{{ $order->address }}@if($order->address_2), {{ $order->address_2 }}@endif<br>
{{ $order->postal_code }} {{ $order->city }}@if($order->country), {{ $order->country }}@endif<br>
@if($order->phone)
Tel.: {{ $order->phone }}
@endif
</x-mail::panel>

<x-mail::button :url="route('tracking-order', ['order_id' => $order->reference, 'email' => $order->email])" color="primary">
Bestellung verfolgen
</x-mail::button>

Bei Fragen zu Ihrer Bestellung schreiben Sie uns jederzeit an [{{ config('mail.admin_address') }}](mailto:{{ config('mail.admin_address') }}).

Mit freundlichen Grüßen,<br>
Ihr Sr-pellethaus Team
</x-mail::message>
