<!-- Search and Filter Bar Component -->
<form method="GET" action="{{ $action }}" class="mb-6 bg-slate-50 p-4 rounded-lg border border-slate-200">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Search Input -->
        <div>
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="{{ $searchPlaceholder ?? 'Search...' }}" 
                   class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        
        <!-- Dynamic Filter Options -->
        @if(isset($filters))
            @foreach($filters as $filter)
                <div>
                    <select name="{{ $filter['name'] }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">{{ $filter['label'] ?? 'All' }}</option>
                        @foreach($filter['options'] ?? [] as $value => $label)
                            <option value="{{ $value }}" {{ request($filter['name']) == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        @endif
        
        <!-- Action Buttons -->
        <div class="flex items-center space-x-2">
            <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                Apply Filters
            </button>
            <a href="{{ $clearUrl }}" class="flex-1 bg-slate-200 hover:bg-slate-300 text-slate-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-center">
                Clear
            </a>
        </div>
    </div>
</form>

