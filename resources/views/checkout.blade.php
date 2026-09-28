@extends('layouts.app')

@section('title', 'Kasse - Sr-pellethaus')
@section('body_class', 'page-template-default page theme-motta woocommerce woocommerce-checkout no-sidebar elementor-default elementor-kit-8')

@section('content')
@php
	$germanStates = [
		'BW' => 'Baden-Württemberg',
		'BY' => 'Bayern',
		'BE' => 'Berlin',
		'BB' => 'Brandenburg',
		'HB' => 'Bremen',
		'HH' => 'Hamburg',
		'HE' => 'Hessen',
		'MV' => 'Mecklenburg-Vorpommern',
		'NI' => 'Niedersachsen',
		'NW' => 'Nordrhein-Westfalen',
		'RP' => 'Rheinland-Pfalz',
		'SL' => 'Saarland',
		'SN' => 'Sachsen',
		'ST' => 'Sachsen-Anhalt',
		'SH' => 'Schleswig-Holstein',
		'TH' => 'Thüringen',
	];
@endphp

<div id="page-header" class="page-header page-header--checkout">
	<div class="container clearfix">
		<div class="page-header__content">
			<h1 class="page-header__title">Kasse</h1>
		</div>
	</div>
</div>

<div id="site-content" class="site-content">
	<div class="container clearfix ph-checkout">
		@if ($errors->any())
			<div class="woocommerce-error ph-checkout__errors">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form method="POST" action="{{ route('checkout.store') }}" class="ph-checkout__form" id="checkout-form">
			@csrf
			<div class="ph-checkout__layout">
				<div class="ph-checkout__main">
					<section class="ph-checkout__section">
						<h2 class="ph-checkout__section-title">Kontaktinformationen</h2>
						<label class="ph-field">
							<span class="ph-field__label">E-Mail-Adresse</span>
							<input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required autocomplete="email">
						</label>
						<p class="ph-checkout__guest-note">Du bestellst gerade als Gast.</p>
					</section>

					<section class="ph-checkout__section">
						<h2 class="ph-checkout__section-title">Rechnungsadresse</h2>

						<label class="ph-field">
							<span class="ph-field__label">Land/Region</span>
							<select name="country" required>
								<option value="DE" {{ old('country', 'DE') === 'DE' ? 'selected' : '' }}>Deutschland</option>
								<option value="AT" {{ old('country') === 'AT' ? 'selected' : '' }}>Österreich</option>
								<option value="CH" {{ old('country') === 'CH' ? 'selected' : '' }}>Schweiz</option>
							</select>
						</label>

						<div class="ph-field-row">
							<label class="ph-field">
								<span class="ph-field__label">Vorname</span>
								<input type="text" name="first_name" value="{{ old('first_name') }}" required autocomplete="given-name">
							</label>
							<label class="ph-field">
								<span class="ph-field__label">Nachname</span>
								<input type="text" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name">
							</label>
						</div>

						<label class="ph-field">
							<span class="ph-field__label">Unternehmen (optional)</span>
							<input type="text" name="company" value="{{ old('company') }}" autocomplete="organization">
						</label>

						<label class="ph-field">
							<span class="ph-field__label">Adresse</span>
							<input type="text" name="address" value="{{ old('address') }}" required autocomplete="address-line1">
						</label>

						<div class="ph-checkout__address2" data-address2-wrap @if(old('address_2')) style="display:block" @endif>
							<label class="ph-field">
								<span class="ph-field__label">Wohnung, Suite usw. (optional)</span>
								<input type="text" name="address_2" value="{{ old('address_2') }}" autocomplete="address-line2">
							</label>
						</div>
						@unless(old('address_2'))
							<button type="button" class="ph-checkout__add-line" data-toggle-address2>+ Wohnung, Suite usw. hinzufügen</button>
						@endunless

						<div class="ph-field-row">
							<label class="ph-field">
								<span class="ph-field__label">Postleitzahl</span>
								<input type="text" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal-code">
							</label>
							<label class="ph-field">
								<span class="ph-field__label">Stadt</span>
								<input type="text" name="city" value="{{ old('city') }}" required autocomplete="address-level2">
							</label>
						</div>

						<div class="ph-field-row">
							<label class="ph-field">
								<span class="ph-field__label">Bundesland (optional)</span>
								<select name="state">
									<option value="">—</option>
									@foreach($germanStates as $code => $label)
										<option value="{{ $code }}" {{ old('state', 'BY') === $code ? 'selected' : '' }}>{{ $label }}</option>
									@endforeach
								</select>
							</label>
							<label class="ph-field">
								<span class="ph-field__label">Telefon</span>
								<input type="tel" name="phone" value="{{ old('phone') }}" autocomplete="tel">
							</label>
						</div>
					</section>

					<section class="ph-checkout__section">
						<h2 class="ph-checkout__section-title">Zahlungsoptionen</h2>
						<label class="ph-payment-option is-selected">
							<input type="radio" name="payment_method" value="vorkasse" checked>
							<span class="ph-payment-option__body">
								<span class="ph-payment-option__title">Vorkasse</span>
								<span class="ph-payment-option__desc">Zahle direkt auf unser Bankkonto. Bitte verwende deine Bestellnummer als Verwendungszweck. Deine Bestellung wird erst nach Zahlungseingang versendet.</span>
							</span>
						</label>

						<label class="ph-checkout__note-toggle">
							<input type="checkbox" name="add_note" value="1" {{ old('add_note', old('notes') ? '1' : '') ? 'checked' : '' }} data-toggle-notes>
							<span>Eine Notiz zu deiner Bestellung hinzufügen</span>
						</label>
						<div class="ph-checkout__notes" data-notes-wrap @if(! old('notes') && ! old('add_note')) hidden @endif>
							<textarea name="notes" rows="4" placeholder="Anmerkungen zu deiner Bestellung">{{ old('notes') }}</textarea>
						</div>

						<p class="ph-checkout__legal">
							Indem du fortfährst, stimmst du unseren
							<a href="{{ url('/agb/') }}">Allgemeinen Geschäftsbedingungen</a>
							und der
							<a href="{{ url('/datenschutzerklaerung/') }}">Datenschutzerklärung</a>
							zu.
						</p>

						<button type="submit" class="ph-checkout__submit">Zahlungspflichtig bestellen</button>
					</section>
				</div>

				<aside class="ph-checkout__summary">
					<div class="ph-checkout__summary-card">
						<h2 class="ph-checkout__summary-title">Bestellübersicht</h2>
						<ul class="ph-checkout__items">
							@foreach ($cart as $productId => $qty)
								@continue(! isset($products[$productId]))
								@php($product = $products[$productId])
								@php($lineTotal = $product->price * $qty)
								@php($saved = $product->isOnSale() ? ($product->regular_price - $product->price) * $qty : 0)
								<li class="ph-checkout__item">
									<div class="ph-checkout__item-thumb">
										<img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" width="64" height="64" loading="lazy">
										<span class="ph-checkout__item-qty">{{ $qty }}</span>
									</div>
									<div class="ph-checkout__item-info">
										<p class="ph-checkout__item-name">{{ $product->name }}</p>
										<p class="ph-checkout__item-price">
											@if($product->isOnSale())
												<del>€{{ number_format($product->regular_price, 2) }}</del>
												<span>€{{ number_format($product->price, 2) }}</span>
												@if($saved > 0)
													<span class="ph-checkout__save">Spare €{{ number_format($saved, 2) }}</span>
												@endif
											@else
												<span>€{{ number_format($product->price, 2) }}</span>
											@endif
										</p>
									</div>
									<div class="ph-checkout__item-total">€{{ number_format($lineTotal, 2) }}</div>
								</li>
							@endforeach
						</ul>

						<details class="ph-checkout__coupon">
							<summary>Gutscheine hinzufügen</summary>
							<div class="ph-checkout__coupon-body">
								<input type="text" name="coupon" placeholder="Gutscheincode" disabled>
								<button type="button" class="ph-checkout__coupon-btn" disabled>Anwenden</button>
							</div>
						</details>

						<div class="ph-checkout__totals">
							<div class="ph-checkout__total-row">
								<span>Zwischensumme</span>
								<span>€{{ number_format($total, 2) }}</span>
							</div>
							<div class="ph-checkout__total-row ph-checkout__total-row--grand">
								<span>Gesamtsumme</span>
								<span>€{{ number_format($total, 2) }}</span>
							</div>
						</div>
					</div>
				</aside>
			</div>
		</form>
	</div>
</div>
@endsection
