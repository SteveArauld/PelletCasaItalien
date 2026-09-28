<x-mail::message>
# Neue Bestellung #{{ $order->reference }}

Eine neue Bestellung wurde soeben auf **Sr-pellethaus** aufgegeben.

<x-mail::panel>
**Kunde:** {{ $order->name }} ([{{ $order->email }}](mailto:{{ $order->email }}))  
**Telefon:** {{ $order->phone ?: '—' }}  
**Zahlung:** {{ $order->payment_method ?: '—' }}  
**Status:** {{ $order->status }}  
**Lieferadresse:** {{ $order->address }}@if($order->address_2), {{ $order->address_2 }}@endif, {{ $order->postal_code }} {{ $order->city }}
@if($order->notes)

**Anmerkungen:** {{ $order->notes }}
@endif
</x-mail::panel>

## Positionen

<x-mail::table>
| Produkt | Menge | Preis |
| :------ | :---: | ----: |
@foreach($order->items as $item)
| {{ $item->product_name }} | {{ $item->quantity }} | {{ number_format((float) $item->unit_price, 2, ',', '.') }} € |
@endforeach
| **Gesamtsumme** |  | **{{ number_format((float) $order->total, 2, ',', '.') }} €** |
</x-mail::table>

<x-mail::button :url="'mailto:'.$order->email" color="primary">
Kunde kontaktieren
</x-mail::button>

Mit freundlichen Grüßen,<br>
Sr-pellethaus System
</x-mail::message>
