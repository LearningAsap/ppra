@if(1)
    @if($getState() == 0)
        <div style="display: table;margin-left:auto; margin-right:auto;" class="px-4 py-3 filament-tables-icon-column filament-tables-icon-column-size-lg">
                <svg class="w-6 h-6 text-danger-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg></div>
        <p class="px-2 text-xs text-center font-semibold leading-tight text-danger-700 bg-danger-100 rounded-full">Rejected</p>
    @elseif ($getState() == 1)
        <div style="display: table;margin-left:auto; margin-right:auto;" class="px-4 py-3 filament-tables-icon-column filament-tables-icon-column-size-lg">
                <svg class="w-6 h-6 text-success-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg></div>
        <p class="px-2 text-xs text-center font-semibold leading-tight text-success-700 bg-success-100 rounded-full">Approved</p>
    @elseif ($getState() == 2)
        <div style="display: table;margin-left:auto; margin-right:auto;" class="px-4 py-3 filament-tables-icon-column filament-tables-icon-column-size-lg">
            <svg class="w-6 h-6 text-secondary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 16c-1.66 0-3-1.34-3-3h6c0 1.66-1.34 3-3 3z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 7h2v4h-2zm0 6h2v2h-2"></path>
            </svg>
        </div>
        <p class="px-2 text-xs text-center font-semibold leading-tight text-secondary-700 bg-secondary-100 rounded-full">In Objection</p>
    @else
        <div style="display: table;margin-left:auto; margin-right:auto;" class="px-4 py-3 filament-tables-icon-column filament-tables-icon-column-size-lg">
            <svg class="w-6 h-6 text-warning-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 16c-1.66 0-3-1.34-3-3h6c0 1.66-1.34 3-3 3z"></path>
                <circle cx="12" cy="12" r="8" stroke-linecap="round" stroke-linejoin="round"></circle>
            </svg>
        </div>
        <p class="px-2 text-xs text-center font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full">Waiting Action</p>
    @endif
@endif
