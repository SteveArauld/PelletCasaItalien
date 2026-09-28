@extends('layouts.app')

@section('title', 'Mein Konto - Sr-pellethaus')
@section('body_class', 'page-template-default page theme-motta no-sidebar elementor-default elementor-kit-8')

@section('content')
<div id="page-header" class="page-header">
	<div class="container clearfix">
		<div class="page-header__content">
			<h1 class="page-header__title">Mein Konto</h1>
		</div>
	</div>
</div>

<div id="site-content" class="site-content">
	<div class="container clearfix" style="padding:40px 0;">

		@if (session('success'))
			<p class="woocommerce-message">{{ session('success') }}</p>
		@endif

		<p>Willkommen zurück, <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }}).</p>

		<form method="POST" action="{{ route('logout') }}" style="margin:10px 0 30px;">
			@csrf
			<button type="submit" class="button motta-button--ghost">Abmelden</button>
		</form>

		<h2>Meine Bestellungen</h2>
		@if ($orders->isEmpty())
			<p class="woocommerce-info">Sie haben noch keine Bestellungen aufgegeben.</p>
			<p><a class="button wc-backward" href="{{ route('shop') }}">Jetzt einkaufen</a></p>
		@else
			<table class="shop_table shop_table_responsive" cellspacing="0" style="width:100%;">
				<thead>
					<tr>
						<th>Bestellung</th>
						<th>Datum</th>
						<th>Status</th>
						<th>Gesamt</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($orders as $order)
						<tr>
							<td>#{{ $order->reference }}</td>
							<td>{{ $order->created_at->format('d.m.Y') }}</td>
							<td>{{ ucfirst($order->status) }}</td>
							<td>{{ number_format($order->total, 2) }} &euro;</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
	</div>
</div>
@endsection
