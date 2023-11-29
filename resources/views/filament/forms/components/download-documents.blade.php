<div style="display:table;margin-left:auto;margin-right:auto;">
    @php
        $proc = App\Models\DepartmentProcurement::where('id', $getId())->first();
    @endphp
    <h4 style="text-align: center; padding-bottom:10px;" class="text-lg font-medium text-gray-900 text-center;">
        Tender Documents</h4>
    @if($proc)
        @if($proc->tender_notice)
        <div style="display: inline-block;margin-right:5px;" class="flex flex-wrap items-center justify-start gap-4 filament-page-actions shrink-0">
            <a class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
                href="{{ asset('storage/'. $proc->tender_notice) }}"
                target="_blank">
                <span class="">
                    Download Tender Notice
                </span>
            </a>
        </div>
        @endif

        @if($proc->tender_document)
        <div style="display: inline-block;margin-right:5px;" class="flex flex-wrap items-center justify-start gap-4 filament-page-actions shrink-0">
            <a class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
                href="{{ asset('storage/'. $proc->tender_document) }}"
                target="_blank">
                <span class="">
                    Download Tender Document
                </span>
            </a>
        </div>
        @endif
    @else
        <p style="text-align:center;">No Tender Documents Uploaded Yet</p>
    @endif

</div>
