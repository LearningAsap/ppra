<x-filament::page>

    <form wire:submit.prevent="saveemployeeProfileForm">
        {{ $this->employeeProfileForm }}


        <div style="display:table;width:100%;">
            <button style="float:right;" x-mousetrap.global.mod-s="" type="submit" wire:loading.attr="disabled"
                wire:loading.class.delay="opacity-70 cursor-wait" x-data="{
                    form: null,
                    isUploadingFile: false,
                }"
                x-bind:class="{ 'opacity-70 cursor-wait': isUploadingFile }" x-bind:disabled="isUploadingFile"
                x-init="form = $el.closest('form')
                form?.addEventListener('file-upload-started', () => {
                    isUploadingFile = true
                })
                form?.addEventListener('file-upload-finished', () => {
                    isUploadingFile = false
                })"
                class="mt-4 filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
                dusk="filament.admin.action.create">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 mr-1 -ml-2 animate-spin filament-button-icon rtl:ml-1 rtl:-mr-2"
                    wire:loading.delay="wire:loading.delay" wire:target="create">
                    <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                        fill="currentColor"></path>
                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                </svg>
                <span class="flex items-center gap-1">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-1 -ml-2 animate-spin filament-button-icon rtl:ml-1 rtl:-mr-2"
                        x-show="isUploadingFile" style="display: none;">
                        <path opacity="0.2" fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                            fill="currentColor"></path>
                        <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor">
                        </path>
                    </svg>
                    <span x-show="isUploadingFile" style="display: none;">
                        Uploading file...
                    </span>
                    <span x-show="! isUploadingFile" class="">
                        Download PDF
                    </span>
                </span>
            </button>
        </div>

        {{-- <button type="submit">
            Submit
        </button> --}}
    </form>

    <script>
        /* function handleSelectChange(select, selectId) {
            console.log('Selected Value:', select.value);

            var selectElement = document.querySelector(`select#${selectId}`);
            var selectedOptions = Array.from(selectElement.selectedOptions);
            console.log('Selected Options:', selectedOptions);

            var allOption = selectElement.querySelector(`option[value="all"]`);
            var clearOption = selectElement.querySelector(`option[value="clear"]`);

            console.log('All Option:', allOption);
            console.log('Clear Option:', clearOption);

            if (allOption && allOption.selected) {
                console.log('All option selected');
                for (var i = 0; i < selectElement.options.length; i++) {
                    var option = selectElement.options[i];
                    if (option !== allOption && option !== clearOption) {
                        option.selected = true;
                    }
                }
            } else if (clearOption && clearOption.selected) {
                console.log('Clear option selected');
                allOption.selected = false;
                clearOption.selected = false;
            } else {
                console.log('Individual option selected');
            }
        } */

        /* function handleSelectChange(select, selectId) {
            console.log('Selected Value:', select.value);

            var selectElement = document.querySelector(`select#${selectId}`);
            var selectedOptions = Array.from(selectElement.selectedOptions);
            console.log('Selected Options:', selectedOptions);

            var allOption = selectElement.querySelector(`option[value="all"]`);
            var clearOption = selectElement.querySelector(`option[value="clear"]`);

            console.log('All Option:', allOption);
            console.log('Clear Option:', clearOption);

            if (allOption && allOption.selected) {
                console.log('All option selected');
                for (var i = 0; i < selectElement.options.length; i++) {
                    selectElement.options[i].selected = true;
                }
            } else if (clearOption && clearOption.selected) {
                console.log('Clear option selected');
                selectElement.selectedIndex = -1;
            } else {
                console.log('Individual option selected');
            }
        } */
    </script>

</x-filament::page>
