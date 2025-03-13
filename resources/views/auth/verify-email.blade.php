<x-guest-layout>
    <div class="text-sm text-gray-600 dark:text-gray-400">
        {{ __('Please verify your email before continuing. Didn\'t get an email? Resend below.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="text-green-500 mt-2">{{ __('A new verification link has been sent!') }}</div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
        @csrf
        <x-primary-button>{{ __('Resend Verification Email') }}</x-primary-button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-2">
        @csrf
        <button type="submit" class="text-red-500">{{ __('Logout') }}</button>
    </form>
</x-guest-layout>
