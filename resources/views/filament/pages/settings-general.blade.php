<x-filament::page>
    <form method="get" wire:submit="save">
        {{ $this->form }}
        <div></div>
        <button type="submit" class="bg-primary-500 hover:bg-primary-600 mt-4 rounded px-4 py-2">Save</button>
    </form>

</x-filament::page>
