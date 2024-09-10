<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Category') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}" class="font-bold py-3 px-5 rounded-full text-white  bg-indigo-500">Add Category</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @forelse ($categories as $category)
                    <div class="item-card flex flex-row justify-between items-center">
                        <img src="{{ Storage::url($category->icon) }}" alt="" class="w-[50px] h-[50px]">
                        <h3 class="text-xl font-bold text-indigo-900">
                            {{ $category->name }}
                        </h3>
                        <div class="flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.categories.edit', $category )}}" class="font-vold py-3 px-5 rounded-full text-white  bg-indigo-500">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy' , $category) }}">
                                @csrf
                                @method('DELETE')
                                <button class="font-bold py-3 px-5 rounded-full text-white  bg-red-500">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>
                        Belum Ada Category
                    </p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
