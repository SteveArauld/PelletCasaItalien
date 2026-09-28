@extends('layouts.app')

@section('title', 'Help Center - Sr-pellethaus')
@section('body_class', 'page-template-default page theme-motta no-sidebar elementor-default elementor-kit-8')

@section('content')
<div id="site-content" class="site-content help-center-page">
	<section class="help-hero">
		<div class="container clearfix">
			<h1 class="help-hero__title">How can we help you?</h1>
			<p class="help-hero__subtitle">Our crew of superheroes are standing by for Help &amp; Support!</p>

			<form class="help-search" action="{{ route('help-center') }}" method="get" role="search">
				<input type="search" name="q" value="{{ request('q') }}" placeholder="Search help topics" aria-label="Search help topics">
				<button type="submit" aria-label="Search">
					<svg width="22" height="22" viewBox="0 0 32 32" aria-hidden="true"><path fill="currentColor" d="M28.8 26.544l-5.44-5.44c1.392-1.872 2.24-4.192 2.24-6.704 0-6.176-5.024-11.2-11.2-11.2s-11.2 5.024-11.2 11.2 5.024 11.2 11.2 11.2c2.512 0 4.832-0.848 6.688-2.24l5.44 5.44 2.272-2.256zM6.4 14.4c0-4.416 3.584-8 8-8s8 3.584 8 8-3.584 8-8 8-8-3.584-8-8z"></path></svg>
				</button>
			</form>

			<p class="help-popular">
				<strong>Popular sections:</strong>
				<a href="{{ route('shop') }}">Shop with an expert</a>,
				<a href="{{ route('login') }}">Help with password</a>,
				<a href="{{ route('tracking-order') }}">Tracking your item</a>
			</p>
		</div>
	</section>

	<section class="help-cta">
		<div class="container clearfix">
			<p class="help-cta__eyebrow">Still need help?</p>
			<h2 class="help-cta__title">Get help with common<br>questions or reach out to our<br>support team.</h2>
			<a href="{{ route('contact') }}" class="help-cta__button">Contact Us</a>
		</div>
	</section>
</div>
@endsection
