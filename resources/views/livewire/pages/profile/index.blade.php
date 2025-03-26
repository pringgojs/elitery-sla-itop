<div>
    <div class="max-w-4xl px-4 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
        {{-- supaya bisa dirender oleh tailwind --}}
        <div class="bg-red-200 text-red-500"></div>
        <div class="bg-blue-200 text-blue-500"></div>
        <div class="bg-yellow-200 text-yellow-500"></div>
        <div class="bg-green-200 text-green-500"></div>
        @if ($form->village_staff->dataStatus->key == 'draft' || $form->village_staff->dataStatus->key == 'revisi')
            @livewire('pages.profile.section.alert-confirmation', ['staff' => $staff])
        @endif

        @livewire('pages.profile.section.header', ['staff' => $staff, 'form' => $form])
        @livewire('pages.profile.section.form', ['form' => $form, 'staff' => $staff])
    </div>
    {{-- @filepondScripts --}}
</div>
