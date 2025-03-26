<div>
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Role Permission - {{ $role->name }}</h1>
            {{-- <p class="mt-2 text-sm text-gray-700">Daftar program dan kegiatan yang telah diimport ke sistem.</p> --}}
        </div>
    </div>
    <div class="bg-white shadow px-5 py-5">
        {{-- Care about people's approval and you will be their prisoner. --}}
        <div class="flex gap-x-6">
            <fieldset>
                @foreach ($groups as $item)
                    <legend class="text-sm font-semibold leading-6 text-gray-900">{{ ucwords($item->group) }}</legend>
                    <div class="mt-6 space-y-6 sm:flex sm:items-center sm:space-x-10 sm:space-y-0 mb-5">
                        @foreach (\Spatie\Permission\Models\Permission::whereGroup($item->group)->orderBy('name')->get() as $permission)
                            <div class="flex items-center">
                                <input id="role-{{ $item->id }}-permission-{{ $permission->id }}"
                                    @if ($role->hasPermissionTo($permission->id)) checked @endif )
                                    wire:change="update({{ $permission->id }})" name="group" type="checkbox"
                                    class="h-4 w-4 border-gray-300 text-green-600 focus:ring-green-600">
                                <label for="role-{{ $item->id }}-permission-{{ $permission->id }}"
                                    class="ml-3 block text-sm font-medium leading-6 text-gray-900">{{ \App\Services\PermissionService::getName($permission->name) }}</label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </fieldset>
        </div>
    </div>
</div>
