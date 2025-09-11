<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-2">Welcome, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-600">You're logged in to the OnePage CMS.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-blue-50 rounded-lg p-6">
                            <div class="text-blue-800 text-xl font-bold mb-2">Quick Links</div>
                            <ul class="space-y-2">
                                <li><a href="{{ route('home') }}" class="text-blue-600 hover:underline">View Website</a></li>
                                @if(Auth::user()->is_admin)
                                <li><a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Admin Dashboard</a></li>
                                @endif
                                <li><a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">Edit Profile</a></li>
                            </ul>
                        </div>

                        <div class="bg-green-50 rounded-lg p-6">
                            <div class="text-green-800 text-xl font-bold mb-2">Your Account</div>
                            <p class="text-gray-700"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p class="text-gray-700"><strong>Member since:</strong> {{ Auth::user()->created_at->format('F j, Y') }}</p>
                        </div>

                        <div class="bg-yellow-50 rounded-lg p-6">
                            <div class="text-yellow-800 text-xl font-bold mb-2">Need Help?</div>
                            <p class="text-gray-700">Visit our documentation or contact support for assistance with using the CMS.</p>
                        </div>
                    </div>

                    <div class="border-t pt-6">
                        <h3 class="text-xl font-bold mb-4">Recent Activity</h3>
                        <p class="text-gray-600">No recent activity to display.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>