<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-input-label for="email" value="Email" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$request->email" required />

        <x-input-label for="password" value="Password" class="mt-4" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />

        <x-input-label for="password_confirmation" value="Confirm Password" class="mt-4" />
        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />

        <x-primary-button class="mt-4">Reset Password</x-primary-button>
    </form>
</x-guest-layout>
