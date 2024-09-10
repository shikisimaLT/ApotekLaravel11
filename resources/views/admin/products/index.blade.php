<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Products') }}
            </h2>
            <a href="{{ route('admin.products.create') }}" class="font-bold py-3 px-5 rounded-full text-white  bg-indigo-500">Add Products</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @forelse ($products as $product)
                    <div class="item-card flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($product->photo) }}" alt="" class="w-[50px] h-[50px]">
                            <div>
                                <h3 class="text-xl font-bold text-indigo-900">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-base text-slate-500">
                                    RP. {{ $product->price }}
                                </p>
                            </div>
                        </div>
                        <p class="text-base text-slate-500">
                            {{ $product->category->name }}
                        </p>
                        <div class="flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.products.edit', $product )}}" class="font-vold py-3 px-5 rounded-full text-white  bg-indigo-500">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy' , $product) }}">
                                @csrf
                                @method('DELETE')
                                <button class="font-bold py-3 px-5 rounded-full text-white  bg-red-500">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                <p>
                    Belum Ada Product!
                </p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
