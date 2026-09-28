@extends('layouts.app')

@section('title', 'Registrieren - Sr-pellethaus')
@section('body_class', 'page-template-default page theme-motta no-sidebar elementor-default elementor-kit-8')

@section('content')
<div id="page-header" class="page-header">
	<div class="container clearfix">
		<div class="page-header__content">
			<h1 class="page-header__title">Konto erstellen</h1>
		</div>
	</div>
</div>

<div id="site-content" class="site-content">
	<div class="container clearfix" style="max-width:480px;padding:40px 0;">

		@if ($errors->any())
			<div class="woocommerce-error" style="margin-bottom:20px;">
				<ul style="margin:0;">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form method="POST" action="{{ route('register') }}" class="motta-auth-form">
			@csrf
			<p class="form-row">
				<label for="register-name">Name <span class="required">*</span></label>
				<input type="text" id="register-name" name="name" value="{{ old('name') }}" required class="motta-input--base" style="width:100%;">
			</p>
			<p class="form-row">
				<label for="register-email">E-Mail-Adresse <span class="required">*</span></label>
				<input type="email" id="register-email" name="email" value="{{ old('email') }}" required class="motta-input--base" style="width:100%;">
			</p>
			<p class="form-row">
				<label for="register-password">Passwort <span class="required">*</span></label>
				<input type="password" id="register-password" name="password" required class="motta-input--base" style="width:100%;">
			</p>
			<p class="form-row">
				<label for="register-password-confirm">Passwort bestätigen <span class="required">*</span></label>
				<input type="password" id="register-password-confirm" name="password_confirmation" required class="motta-input--base" style="width:100%;">
			</p>
			<button type="submit" class="button alt motta-button--bg-color-black">Registrieren</button>
		</form>

		<p style="margin-top:20px;">Bereits ein Konto? <a href="{{ route('login') }}">Jetzt anmelden</a></p>
	</div>
</div>
@endsection
