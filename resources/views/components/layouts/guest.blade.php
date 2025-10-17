<!DOCTYPE html>
<html lang="en" class="bg-gray-50 min-h-screen">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $title ?? 'Login' }}</title>
	@vite(["resources/css/app.css", "resources/js/app.js"])
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
	<div class="w-full max-w-md mx-auto p-6">
		{{ $slot }}
	</div>
</body>
</html>
