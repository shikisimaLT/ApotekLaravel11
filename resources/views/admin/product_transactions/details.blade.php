<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{  __('Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">
                <div class="item-card flex gap-y-3 flex-col md:flex-row justify-between md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <div>
                            <p class="text-base text-slate-500">
                                Total Transaksi
                            </p>
                            <h3 class="text-xl font-bold text-indigo-900">
                                RP. {{ $productTransaction->total_amount }}
                            </h3>
                        </div>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <div>
                            <p class="text-base text-slate-500">
                                Date
                            </p>
                            <h3 class="text-xl font-bold text-indigo-900">
                                {{ $productTransaction->created_at }}
                            </h3>
                        </div>
                    </div>
                    @if($productTransaction->isPaid)
                    <span class="py-1 w-fit px-3 rounded-full bg-green-500">
                        <p class="text-white font-bold text-sm">
                            Success
                        </p>
                    </span>
                    @else
                    <span class="py-1 w-fit px-3 rounded-full bg-orange-500">
                        <p class="text-white font-bold text-sm">
                            Pending
                        </p>
                    </span>
                    @endif
                </div>
                <hr class="my-3">
                <h3 class="text-xl font-bold text-indigo-900">
                   List Of Items
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-x-10">
                    <div class="flex flex-col gap-y-5 col-span-2">

                        @forelse ($productTransaction->transactionDetails as $detail)
                            <div class="item-card flex flex-row justify-between items-center">
                                <div class="flex flex-row items-center gap-x-3">
                                    <img src="{{ Storage::url($detail->product->photo)}}" alt="" class="w-[50px] h-[50px]">
                                    <div>
                                        <h3 class="text-xl font-bold text-indigo-900">
                                            {{ $detail->product->name }}
                                        </h3>
                                        <p class="text-base text-slate-500">
                                            RP. {{ $detail->product->price }}
                                        </p>
                                    </div>
                                </div>
                                <p class="text-base text-slate-500">
                                    {{ $detail->product->category->name }}
                                </p>    
                            </div>
                        @empty
                            
                        @endforelse
                        <h3 class="text-xl font-bold text-indigo-900">
                            Detail Of Delivery
                        </h3>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Address
                            </p>  
                            <h3 class="text-xl font-bold text-indigo-900">
                                {{ $productTransaction->address }}
                            </h3>  
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                City
                            </p>  
                            <h3 class="text-xl font-bold text-indigo-900">
                                {{ $productTransaction->city }}
                            </h3>  
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Post Code
                            </p>  
                            <h3 class="text-xl font-bold text-indigo-900">
                                {{ $productTransaction->post_code }}
                            </h3>  
                        </div>
                        <div class="item-card flex flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Phone Number
                            </p>  
                            <h3 class="text-xl font-bold text-indigo-900">
                                {{ $productTransaction->phone_number }}
                            </h3>  
                        </div>
                        <div class="item-card flex flex-col items-start">
                            <p class="text-base text-slate-500">
                                Note
                            </p>  
                            <h3 class="text-lg  text-indigo-900">
                                {{ $productTransaction->notes }}
                            </h3>  
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-5 col-span-2 md:items-end">
                        <h3 class="text-xl font-bold text-indigo-900">
                            Proof Of Payment 
                        </h3>
                        <img src="{{ Storage::url($productTransaction->proof) }}" alt="{{ Storage::url($productTransaction->proof) }}" class="w-[300px] bg-red-200 h-[400px]">
                    </div>
                </div>
                <hr class="my-3">
                @role('owner')
                @if($productTransaction->isPaid)
                    <a href="" class="w-fit font-bold py-3 px-5 rounded-full text-white  bg-indigo-700">Contact Customer</a>
                @else
                    <form method="POST" action="{{ route('productTransaction.update' , $productTransaction) }}">
                        @csrf
                        @method('PUT')
                        <button class="font-bold py-3 px-5 rounded-full text-white  bg-indigo-700">Approve Order</button>
                    </form>
                @endif
                @endrole
                @role('buyer')
                <a href="" class="w-fit font-bold py-3 px-5 rounded-full text-white  bg-indigo-700">Contact Admins</a>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
