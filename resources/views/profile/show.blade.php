<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 leading-tight">
            {{ __('Profil Saya') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-8">
        <div class="bg-white rounded-xl shadow p-8">
            <div class="mb-8 text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 mb-2 rounded-full bg-green-100">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-green-800">{{ auth()->user()->name }}</h2>
                <div class="text-gray-500 text-sm">{{ auth()->user()->email }}</div>
            </div>
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                <div class="mb-8">
                    @livewire('profile.update-profile-information-form')
                </div>
                <x-section-border />
            @endif
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mb-8">
                    @livewire('profile.update-password-form')
                </div>
                <x-section-border />
            @endif
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mb-8">
                    @livewire('profile.two-factor-authentication-form')
                </div>
                <x-section-border />
            @endif
            <div class="mb-8">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>
            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />
                <div class="mb-8">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
