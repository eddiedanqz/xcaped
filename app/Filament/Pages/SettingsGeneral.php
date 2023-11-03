<?php

namespace App\Filament\Pages;

use App\Filament\Resources\CategoryResource\Pages;
use App\Settings\GeneralSettings;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;

class SettingsGeneral extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $view = 'filament.pages.settings-general';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'General';

    protected static ?int $navigationSort = 20;

    public GeneralSettings $settings;

    public $commission;

    public function mount(): void
    {
        $this->form->fill([
            'commission' => app(GeneralSettings::class)->commission,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('commission')
            ->numeric()
            ->required(),
        ];
    }

    public function save()
    {
        $settings = new GeneralSettings;
        $settings->commission = $this->commission;

        $settings->save();

        return redirect()->back();
    }

    public static function getPages(): array
    {
        return [
            // ...
            'general' => Pages\SettingsGeneral::route('/general'),
        ];
    }
}
