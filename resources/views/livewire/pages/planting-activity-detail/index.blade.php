<div>
    <div class="max-w-4xl px-4 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
        {{-- supaya bisa dirender oleh tailwind --}}

        {{-- jika from nya dari admin, maka tidak perlu tombol alert confirmasi --}}
        {{-- @if ($form->village_staff->dataStatus->key == 'draft' || $form->village_staff->dataStatus->key == 'revisi')
            @livewire('pages.profile.section.alert-confirmation', ['staff' => $staff])
        @endif --}}

        @livewire('pages.planting-activity-detail.section.header', ['form' => $plantingActivity])
        @livewire('pages.planting-activity-detail.section.tab', ['form' => $plantingActivity])
    </div>
</div>
