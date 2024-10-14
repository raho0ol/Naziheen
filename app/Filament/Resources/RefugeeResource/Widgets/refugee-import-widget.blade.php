<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="import">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-4">
                استيراد البيانات
            </x-filament::button>
        </form>
    </x-filament::card>
</x-filament::widget>
