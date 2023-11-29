{{ \Filament\Facades\Filament::renderHook('footer.before') }}

<div class="filament-footer flex items-center justify-center">
    {{ \Filament\Facades\Filament::renderHook('footer.start') }}

    @if (config('filament.layout.footer.should_show_logo'))
        Powered By&nbsp;
        <a
            href="http://www.gbit.gov.pk"
            target="_blank"
            rel="noopener noreferrer"
            class="text-gray-500 hover:text-primary-500 transition"
        >
            Information Technology Department, Gilgit Baltistan
        </a>
    @endif

    {{ \Filament\Facades\Filament::renderHook('footer.end') }}
</div>

{{ \Filament\Facades\Filament::renderHook('footer.after') }}
