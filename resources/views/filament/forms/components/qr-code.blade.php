<div>
    <label class="filament-forms-field-wrapper-label inline-flex items-center space-x-3 rtl:space-x-reverse"
        for="data.department_procurement_id">
        <span class="text-sm font-medium leading-4 text-gray-700">
            QR Code
        </span>
    </label>
    <div class="p-3">
        {!! $getId() == 'data.qr_code' ? '' : QrCode::size(150)->generate($getId()) !!}
    </div>
</div>
