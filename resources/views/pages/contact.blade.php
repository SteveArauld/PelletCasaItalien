@extends('layouts.app')

@section('title', 'Kontaktieren Sie uns - Sr-pellethaus')
@section('body_class', 'page-template-default page theme-motta no-sidebar elementor-default elementor-kit-8')

@section('content')
<div id="site-content" class="site-content pages-shell">
	<div class="container clearfix">
		<section class="contact-page">
			<h1 class="contact-page__title">Kontaktieren Sie uns</h1>

			<div class="contact-intro">
				<p><strong>Wir sind für Sie da</strong></p>
				<p>Haben Sie Fragen zu unseren Produkten, Ihrer Bestellung, den Lieferbedingungen oder benötigen Sie eine individuelle Beratung?</p>
				<p>Das Team von Sr-Pelletshaus steht Ihnen gerne zur Verfügung. Wir unterstützen Privatkunden und Unternehmen bei der Auswahl von Brennholz, Holzpellets, Holzbriketts und weiteren Holzbrennstoffen.</p>
				<p>Kontaktieren Sie uns telefonisch, per E-Mail oder über unser Kontaktformular. Unser Kundenservice beantwortet Ihre Anfragen schnell und zuverlässig.</p>
			</div>

			<div class="contact-info">
				<div class="contact-info__item">
					<span class="contact-info__icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" width="28" height="28"><path fill="currentColor" d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5L4 8V6l8 5 8-5v2z"/></svg>
					</span>
					<a href="mailto:kontakt@sr-pellethaus.de">kontakt@sr-pellethaus.de</a>
				</div>
				<div class="contact-info__item">
					<span class="contact-info__icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" width="28" height="28"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg>
					</span>
					<a href="tel:+498722965418">+49 8722 965 418</a>
				</div>
				<div class="contact-info__item">
					<span class="contact-info__icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" width="28" height="28"><path fill="currentColor" d="M21.5 3.5 2.5 12l8.2 2.3L13 22.5l8.5-19z"/></svg>
					</span>
					<span>Industriestraße 8, 84359 Simbach am Inn, Deutschland</span>
				</div>
			</div>

			<div class="contact-form-wrap">
				<h2 class="contact-form-wrap__title">Kontaktformular</h2>

				@if (session('success'))
					<div class="pages-alert pages-alert--success">{{ session('success') }}</div>
				@endif

				@if ($errors->any())
					<div class="pages-alert pages-alert--error">
						@foreach ($errors->all() as $error)
							<p>{{ $error }}</p>
						@endforeach
					</div>
				@endif

				<form method="POST" action="{{ route('contact.store') }}" class="contact-form">
					@csrf
					<div class="contact-field">
						<label for="contact-name">Ihr Name</label>
						<input id="contact-name" type="text" name="name" value="{{ old('name') }}" required>
					</div>
					<div class="contact-field">
						<label for="contact-email">Ihre E-Mail</label>
						<input id="contact-email" type="email" name="email" value="{{ old('email') }}" required>
					</div>
					<div class="contact-field">
						<label for="contact-subject">Thema</label>
						<input id="contact-subject" type="text" name="subject" value="{{ old('subject') }}">
					</div>
					<div class="contact-field">
						<label for="contact-message">Ihre Nachricht</label>
						<textarea id="contact-message" name="message" rows="6" required>{{ old('message') }}</textarea>
					</div>
					<button type="submit" class="contact-submit">Meine Anfrage einreichen</button>
				</form>
			</div>
		</section>
	</div>
</div>
@endsection
