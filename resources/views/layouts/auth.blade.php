<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'PelletCasa')</title>
	<link rel="stylesheet" href="{{ asset('css/pages.css') }}?ver=1">
</head>
<body class="auth-layout">
	<div class="auth-page">
		<a href="{{ route('home') }}" class="auth-logo" aria-label="PelletCasa">
			<img src="{{ asset('images/logo.svg') }}" alt="PelletCasa">
		</a>
		@yield('content')
	</div>
</body>
</html>
