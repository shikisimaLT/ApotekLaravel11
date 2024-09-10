<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="py-3 w-full rounded-3xl text-white">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                        @csrf
                
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                
                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="icon" :value="__('Icon')" />
                            <x-text-input id="icon" class="block mt-1 w-full" type="file" name="icon" required autofocus autocomplete="icon" />
                            <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                        </div>
                
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Register A Category') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
