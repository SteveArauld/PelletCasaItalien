@extends('layouts.app')

@section('title', 'Bestellung verfolgen - Sr-pellethaus')
@section('body_class', 'page-template-default page theme-motta no-sidebar elementor-default elementor-kit-8')

@section('content')
<div id="site-content" class="site-content pages-shell">
	<div class="container clearfix">
		<section class="track-page">
			<h1 class="track-page__title">Bestellung verfolgen</h1>
			<p class="track-page__intro">
				To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.
			</p>

			<div class="track-card">
				<form method="GET" action="{{ route('tracking-order') }}" class="track-form">
					<div class="track-form__row">
						<div class="track-field">
							<label for="order_id">Order ID</label>
							<input id="order_id" type="text" name="order_id" value="{{ $orderId }}" placeholder="Found in your order confirmation email" required>
						</div>
						<div class="track-field">
							<label for="track_email">Billing email</label>
							<input id="track_email" type="email" name="email" value="{{ $email }}" placeholder="Die E-Mail-Adresse, die Sie beim Bestellen verwendet haben" required>
						</div>
					</div>
					<button type="submit" class="track-submit">Track</button>
				</form>

				@if ($notFound)
					<div class="pages-alert pages-alert--error">
						Keine Bestellung mit diesen Angaben gefunden.
					</div>
				@endif

				@if ($order)
					<div class="track-result">
						<div class="track-result__header">
							<strong>Bestellung {{ $order->reference }}</strong>
							<span class="track-result__status">{{ ucfirst($order->status) }}</span>
						</div>
						<p>E-Mail: {{ $order->email }}</p>
						<p>Datum: {{ $order->created_at?->format('d.m.Y H:i') }}</p>
						<p>Gesamt: €{{ number_format((float) $order->total, 2) }}</p>
						@if ($order->items->isNotEmpty())
							<ul class="track-result__items">
								@foreach ($order->items as $item)
									<li>
										<span>{{ $item->product_name ?: ($item->product?->name ?? 'Produkt') }}</span>
										<span>× {{ $item->quantity }}</span>
										<span>€{{ number_format((float) $item->unit_price, 2) }}</span>
									</li>
								@endforeach
							</ul>
						@endif
					</div>
				@endif
			</div>
		</section>
	</div>
</div>
@endsection
