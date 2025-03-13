<x-guest-layout>
    <div class="text-white mb-4">
        Confirm your password to continue.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <x-input-label for="password" value="Password" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />

        <x-primary-button class="mt-4">Confirm Password</x-primary-button>
    </form>
</x-guest-layout>
