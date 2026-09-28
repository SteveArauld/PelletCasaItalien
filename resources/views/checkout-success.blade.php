@extends('layouts.app')

@section('title', 'Bestellung bestätigt - Sr-pellethaus')
@section('body_class', 'page-template-default page theme-motta woocommerce woocommerce-order-received no-sidebar elementor-default elementor-kit-8')

@section('content')
@php
	$paymentLabels = ['vorkasse' => 'Vorkasse'];
	$paymentLabel = $paymentLabels[$order->payment_method] ?? ucfirst((string) $order->payment_method);
@endphp

<div id="page-header" class="page-header page-header--checkout">
	<div class="container clearfix">
		<div class="page-header__content">
			<h1 class="page-header__title">Kasse</h1>
		</div>
	</div>
</div>

<div id="site-content" class="site-content">
	<div class="container clearfix ph-order-received">
		<p class="ph-order-received__thanks">Vielen Dank. Deine Bestellung ist eingegangen.</p>

		<ul class="ph-order-received__overview woocommerce-order-overview">
			<li>
				<span class="ph-order-received__label">Bestellnummer:</span>
				<strong>{{ $order->reference }}</strong>
			</li>
			<li>
				<span class="ph-order-received__label">Datum:</span>
				<strong>{{ $order->created_at->translatedFormat('j. F Y') }}</strong>
			</li>
			<li>
				<span class="ph-order-received__label">Gesamt:</span>
				<strong>€{{ number_format($order->total, 2) }}</strong>
			</li>
			<li>
				<span class="ph-order-received__label">Zahlungsart:</span>
				<strong>{{ $paymentLabel }}</strong>
			</li>
		</ul>

		@if($order->payment_method === 'vorkasse')
			<div class="ph-order-received__instructions">
				<p>Vielen Dank für deine Bestellung. Sobald die Zahlung bei uns eingegangen ist, wird deine Bestellung reserviert und versendet.</p>
				<p>Bitte sende uns eine Kopie deiner Vorkasse-Überweisung an <a href="mailto:kontakt@sr-pellethaus.de">kontakt@sr-pellethaus.de</a>.</p>
				<p>Wichtig: Stelle sicher, dass der Name und die Lieferadresse auf der Überweisung mit den Angaben in deiner Bestellung übereinstimmen, damit die Bank die Zahlung nicht storniert.</p>
			</div>
		@endif

		<section class="ph-order-received__details">
			<h2>Bestelldetails</h2>
			<table class="shop_table order_details">
				<thead>
					<tr>
						<th class="product-name">Produkt</th>
						<th class="product-total">Gesamtsumme</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($order->items as $item)
						<tr>
							<td class="product-name">{{ $item->product_name }} <strong class="product-quantity">×&nbsp;{{ $item->quantity }}</strong></td>
							<td class="product-total">€{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>Zwischensumme:</th>
						<td>€{{ number_format($order->total, 2) }}</td>
					</tr>
					<tr>
						<th>Gesamt:</th>
						<td><strong>€{{ number_format($order->total, 2) }}</strong></td>
					</tr>
					<tr>
						<th>Zahlungsart:</th>
						<td>{{ $paymentLabel }}</td>
					</tr>
					@if($order->notes)
						<tr>
							<th>Anmerkung:</th>
							<td>{{ $order->notes }}</td>
						</tr>
					@endif
					<tr>
						<th>Aktionen:</th>
						<td>
							<a class="ph-order-received__invoice" href="mailto:kontakt@sr-pellethaus.de?subject=Rechnung%20{{ $order->reference }}">Rechnung</a>
						</td>
					</tr>
				</tfoot>
			</table>
		</section>

		<section class="ph-order-received__address">
			<h2>Rechnungsadresse</h2>
			<address>
				@if($order->company){{ $order->company }}<br>@endif
				{{ $order->name }}<br>
				{{ $order->address }}@if($order->address_2), {{ $order->address_2 }}@endif<br>
				{{ $order->postal_code }} {{ $order->city }}@if($order->state), {{ $order->state }}@endif<br>
				@if($order->phone){{ $order->phone }}<br>@endif
				{{ $order->email }}
			</address>
		</section>
	</div>
</div>
@endsection
