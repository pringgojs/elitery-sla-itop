<div>
    <div x-data="{
        activeTab: @entangle('tabActive'),
        tabs: [
            { 'key': 'tab-identity', 'label': 'Data Kelompok' },
            { 'key': 'tab-seed', 'label': 'Bibit' },
            { 'key': 'tab-detail', 'label': 'Detail Kegiatan' },
            { 'key': 'tab-report', 'label': 'Laporan' }
        ]
    }" class="p-4 bg-white rounded-lg shadow-md w-full mt-10 mx-auto">

        <!-- Tab Buttons -->
        <div class="flex items-center border-b border-gray-200 pb-2">
            <template x-for="mtab in tabs" :key="mtab.key">
                <button @click="activeTab = mtab.key; $wire.setActive(mtab.key)"
                    :class="{ 'bg-gray-50 text-gray-900 relative': activeTab === mtab.key }"
                    class="relative px-4 py-2 mx-1 text-gray-600 rounded-lg hover:bg-gray-50 focus:outline-none">

                    <!-- Label text of the tab -->
                    <span x-text="mtab.label"></span>

                    <!-- Indicator bar for the active tab -->
                    <span x-show="activeTab === mtab.key"
                        class="absolute bottom-[-10px] left-0 right-0 mx-auto h-[2px] w-3/4 bg-gray-900 rounded">
                    </span>
                </button>
            </template>

            <button class="ml-auto p-2 focus:outline-none">

                {{-- @if (is_administrator() || is_sekdes()) --}}
                <a x-show="activeTab === 'tab-report'"
                    onclick="Livewire.dispatch('openModal', { component: 'modals.form-planting-activity-report', arguments: {plantingActivityId: '{{ $form->id }}'}  })">
                    <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
                {{-- @endif --}}

            </button>
        </div>

        <!-- Tab Content -->
        <div class="p-4 bg-white">
            @if ($tabActive == 'tab-identity')
                <livewire:pages.planting-activity-detail.section.identity-tab :$form />
            @endif

            @if ($tabActive == 'tab-seed')
                <livewire:pages.planting-activity-detail.section.seed-tab :$form />
            @endif

            @if ($tabActive == 'tab-detail')
                <livewire:pages.planting-activity-detail.section.detail-tab :$form />
            @endif

            @if ($tabActive == 'tab-report')
                <livewire:pages.planting-activity-detail.section.report-tab :$form />
            @endif
        </div>
    </div>
</div>
