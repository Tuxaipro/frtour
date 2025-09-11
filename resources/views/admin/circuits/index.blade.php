@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Circuits</h1>
                    <a href="{{ route('admin.circuits.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Circuit
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Name</th>
                                <th class="py-2 px-4 border-b">Duration</th>
                                <th class="py-2 px-4 border-b">Price From</th>
                                <th class="py-2 px-4 border-b">Destination</th>
                                <th class="py-2 px-4 border-b w-20">Sort Order</th>
                                <th class="py-2 px-4 border-b">Status</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($circuits as $circuit)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $circuit->name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $circuit->duration_days }} days</td>
                                    <td class="py-2 px-4 border-b">€{{ $circuit->price_from }}</td>
                                    <td class="py-2 px-4 border-b">{{ $circuit->destination->name ?? 'N/A' }}</td>
                                    <td class="py-2 px-4 border-b text-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                            {{ $circuit->sort_order ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 border-b">
                                        @if($circuit->is_active)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Active</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b">
                                        <a href="{{ route('admin.circuits.show', $circuit) }}" class="text-green-500 hover:text-green-700 mr-3">View</a>
                                        <a href="{{ route('admin.circuits.edit', $circuit) }}" class="text-blue-500 hover:text-blue-700 mr-3">Edit</a>
                                        <form action="{{ route('admin.circuits.destroy', $circuit) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this circuit? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-2 px-4 border-b text-center">No circuits found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $circuits->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
