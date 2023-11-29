<x-filament::page>
    <div class="col-span-1" wire:key="zSoNor7RGi7GiLgtjoKR.data.user_name.Filament\Forms\Components\TextInput">
        <div class="filament-forms-field-wrapper">
            <div class="space-y-2">
                <div class="flex items-center justify-between space-x-2 rtl:space-x-reverse">
                    <label
                        class="inline-flex items-center space-x-3 filament-forms-field-wrapper-label rtl:space-x-reverse"
                        for="data.user_name">
                        <span class="text-sm font-medium leading-4 text-gray-700">
                            User name
                            <sup class="font-medium text-danger-700">*</sup>
                        </span>
                    </label>
                </div>
                <div class="flex items-center space-x-2 filament-forms-text-input-component rtl:space-x-reverse group">
                    <div class="flex-1">
                        <input x-data="{}" wire:model.defer="user_name" type="text" disabled
                            dusk="filament.forms.data.user_name" id="data.user_name" maxlength="255" required=""
                            class="block w-full transition duration-75 border-gray-300 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70"
                            x-bind:class="{
                                'border-gray-300': !('data.user_name' in $wire.__instance.serverMemo.errors),
                                'dark:border-gray-600': !('data.user_name' in $wire.__instance.serverMemo.errors) &
                                    amp; & amp;false,
                                'border-danger-600 ring-danger-600': ('data.user_name' in $wire.__instance.serverMemo
                                    .errors),
                                'dark:border-danger-400 dark:ring-danger-400': ('data.user_name' in $wire.__instance
                                    .serverMemo.errors) & amp; & amp;false,
                            }">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-1" wire:key="zSoNor7RGi7GiLgtjoKR.data.user_role.Filament\Forms\Components\Select">
        <div class="filament-forms-field-wrapper">
            <div class="space-y-2">
                <div class="flex items-center justify-between space-x-2 rtl:space-x-reverse">
                    <label
                        class="inline-flex items-center space-x-3 filament-forms-field-wrapper-label rtl:space-x-reverse"
                        for="data.user_role">
                        <span class="text-sm font-medium leading-4 text-gray-700">
                            User role
                            <sup class="font-medium text-danger-700">*</sup>
                        </span>
                    </label>
                </div>
                <div class="flex items-center space-x-1 filament-forms-select-component rtl:space-x-reverse group">
                    <div class="flex-1 min-w-0">
                        <select id="data.user_role" wire:model.defer="user_role" disabled
                            dusk="filament.forms.data.user_role" required=""
                            class="block w-full text-gray-900 transition duration-75 border-gray-300 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70">
                            <option value="">Select an option</option>

                            <option value="0">
                                Admin
                            </option>
                            <option value="1">
                                Institution
                            </option>
                            <option value="2">
                                Employee
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-1" wire:key="zSoNor7RGi7GiLgtjoKR.data.email.Filament\Forms\Components\TextInput">
        <div class="filament-forms-field-wrapper">
            <div class="space-y-2">
                <div class="flex items-center justify-between space-x-2 rtl:space-x-reverse">
                    <label
                        class="inline-flex items-center space-x-3 filament-forms-field-wrapper-label rtl:space-x-reverse"
                        for="data.email">
                        <span class="text-sm font-medium leading-4 text-gray-700">
                            Email
                            <sup class="font-medium text-danger-700">*</sup>
                        </span>
                    </label>
                </div>
                <div class="flex items-center space-x-2 filament-forms-text-input-component rtl:space-x-reverse group">
                    <div class="flex-1">
                        <input x-data="{}" wire:model.defer="email" type="email" disabled
                            dusk="filament.forms.data.email" id="data.email" maxlength="255" required=""
                            class="block w-full transition duration-75 border-gray-300 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70"
                            x-bind:class="{
                                'border-gray-300': !('data.email' in $wire.__instance.serverMemo.errors),
                                'dark:border-gray-600': !('data.email' in $wire.__instance.serverMemo.errors) & amp; &
                                amp;false,
                                'border-danger-600 ring-danger-600': ('data.email' in $wire.__instance.serverMemo
                                    .errors),
                                'dark:border-danger-400 dark:ring-danger-400': ('data.email' in $wire.__instance
                                    .serverMemo.errors) & amp; & amp;false,
                            }">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-1" wire:key="zSoNor7RGi7GiLgtjoKR.data.password.Filament\Forms\Components\TextInput">
        <div class="filament-forms-field-wrapper">
            <div class="space-y-2">
                <div class="flex items-center justify-between space-x-2 rtl:space-x-reverse">
                    <label
                        class="inline-flex items-center space-x-3 filament-forms-field-wrapper-label rtl:space-x-reverse"
                        for="data.password">
                        <span class="text-sm font-medium leading-4 text-gray-700">
                            Old Password
                            <sup class="font-medium text-danger-700">*</sup>
                        </span>
                    </label>
                </div>
                <div class="flex items-center space-x-2 filament-forms-text-input-component rtl:space-x-reverse group">
                    <div class="flex-1">
                        <input x-data="{}" wire:model.defer="old_password" type="password"
                            dusk="filament.forms.data.password" id="data.password" maxlength="255" minlength="8"
                            required=""
                            class="
                                {{ $errors->has('old_password')
                                    ? 'block w-full transition duration-75 rounded-lg shadow-sm border-danger-300 focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70'
                                    : 'block w-full transition duration-75 border-gray-300 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70' }}">
                    </div>
                </div>
                @if ($errors->has('old_password'))
                    <p data-validation-error=""
                        class="text-sm filament-forms-field-wrapper-error-message text-danger-600">
                        {{ $errors->first('old_password') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-span-1" wire:key="zSoNor7RGi7GiLgtjoKR.data.password.Filament\Forms\Components\TextInput">
        <div class="filament-forms-field-wrapper">
            <div class="space-y-2">
                <div class="flex items-center justify-between space-x-2 rtl:space-x-reverse">
                    <label
                        class="inline-flex items-center space-x-3 filament-forms-field-wrapper-label rtl:space-x-reverse"
                        for="data.password">
                        <span class="text-sm font-medium leading-4 text-gray-700">
                            Password
                            <sup class="font-medium text-danger-700">*</sup>
                        </span>
                    </label>
                </div>
                <div class="flex items-center space-x-2 filament-forms-text-input-component rtl:space-x-reverse group">
                    <div class="flex-1">
                        <input x-data="{}" wire:model.defer="password" type="password"
                            dusk="filament.forms.data.password" id="data.password" maxlength="255" minlength="8"
                            required=""
                            class="
                            {{ $errors->has('password')
                                ? 'block w-full transition duration-75 rounded-lg shadow-sm border-danger-300 focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70'
                                : 'block w-full transition duration-75 border-gray-300 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70' }}">
                    </div>
                </div>
                @if ($errors->has('password'))
                    <p data-validation-error=""
                        class="text-sm filament-forms-field-wrapper-error-message text-danger-600">
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-span-1" wire:key="zSoNor7RGi7GiLgtjoKR.data.confirm_password.Filament\Forms\Components\TextInput">
        <div class="filament-forms-field-wrapper">
            <div class="space-y-2">
                <div class="flex items-center justify-between space-x-2 rtl:space-x-reverse">
                    <label
                        class="inline-flex items-center space-x-3 filament-forms-field-wrapper-label rtl:space-x-reverse"
                        for="data.confirm_password">
                        <span class="text-sm font-medium leading-4 text-gray-700">
                            Confirm password
                            <sup class="font-medium text-danger-700">*</sup>
                        </span>
                    </label>
                </div>
                <div class="flex items-center space-x-2 filament-forms-text-input-component rtl:space-x-reverse group">
                    <div class="flex-1">
                        <input x-data="{}" wire:model.defer="confirm_password" type="password"
                            dusk="filament.forms.data.confirm_password" id="data.confirm_password" required=""
                            class="
                            {{ $errors->has('confirm_password')
                                ? 'block w-full transition duration-75 rounded-lg shadow-sm border-danger-300 focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70'
                                : 'block w-full transition duration-75 border-gray-300 rounded-lg shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500 disabled:opacity-70' }}">
                    </div>
                </div>
                @if ($errors->has('confirm_password'))
                    <p data-validation-error=""
                        class="text-sm filament-forms-field-wrapper-error-message text-danger-600">
                        {{ $errors->first('confirm_password') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
    <div class="flex flex-wrap items-center justify-start gap-4 filament-page-actions filament-form-actions">
        <button x-mousetrap.global.mod-s="" type="submit" wire:loading.attr="disabled"
            wire:loading.class.delay="opacity-70 cursor-wait" wire:click="save" x-data="{
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
            class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
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
                    <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="currentColor"></path>
                </svg>
                <span x-show="isUploadingFile" style="display: none;">
                    Uploading file...
                </span>
                <span x-show="! isUploadingFile" class="">
                    Save Changes
                </span>
            </span>
        </button>
        <a class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-gray-800 bg-white border-gray-300 hover:bg-gray-50 focus:ring-primary-600 focus:text-primary-600 focus:bg-primary-50 focus:border-primary-600 filament-page-button-action"
            href="{{ url('/admin') }}" dusk="filament.admin.action.cancel">
            <span class="">
                Cancel
            </span>
        </a>
    </div>
</x-filament::page>
