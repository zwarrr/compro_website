<x-layouts.guest>
	<div class="bg-white/90 dark:bg-gray-800/90 rounded-2xl shadow-2xl p-8 animate-fade-in">
		<div class="flex flex-col items-center mb-6">
			<img src="/images/logo.png" alt="Logo" class="h-16 mb-2">
			<h1 class="text-3xl font-extrabold text-primary mb-1 tracking-tight">Selamat Datang</h1>
			<p class="text-gray-500 dark:text-gray-300">Silakan login untuk melanjutkan ke dashboard admin</p>
		</div>
		<form method="POST" action="{{ route('login') }}" class="space-y-5">
			@csrf
			<div>
				<label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
				<input id="email" name="email" type="email" required autofocus class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary/60 focus:border-primary transition" />
			</div>
			<div>
				<label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
				<input id="password" name="password" type="password" required class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary/60 focus:border-primary transition" />
			</div>
			<div class="flex items-center justify-between">
				<label class="flex items-center">
					<input type="checkbox" name="remember" class="rounded text-primary focus:ring-primary border-gray-300 dark:border-gray-700">
					<span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Ingat saya</span>
				</label>
				<a href="#" class="text-sm text-primary hover:underline">Lupa password?</a>
			</div>
			<button type="submit" class="w-full py-3 rounded-lg bg-primary text-white font-bold text-lg shadow-lg hover:shadow-primary/40 hover:bg-primary/90 transition-all duration-200">Login</button>
		</form>
	</div>
	<style>
	@keyframes fade-in {
	  from { opacity: 0; transform: translateY(20px); }
	  to { opacity: 1; transform: translateY(0); }
	}
	.animate-fade-in {
	  animation: fade-in 0.5s cubic-bezier(.4,0,.2,1);
	}
	</style>
</x-layouts.guest>
