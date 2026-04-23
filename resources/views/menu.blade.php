<x-app-layout>
    <x-slot name='header'>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menu') }}
        </h2>
    </x-slot>

   @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('menus.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add Menu Item</a>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2">Name


                                </th>                                
                                <th class="py-2">Price per kg</th>
                                <th class="py-2">Stock Quantity</th>
                                <th class="py-2">Description</th>
                                <th class="py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td class="border px-4 py-2">{{ $menu->name }}</td>
                                    <td class="border px-4 py-2">{{ $menu->price_per_kg }}</td>
                                    <td class="border px-4 py-2">{{ $menu->stock_quantity }}</td>
                                    <td class="border px-4 py-2">{{ $menu->description }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('menus.edit', $menu->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this menu item?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
