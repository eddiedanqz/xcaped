<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendeeResource\Pages;
use App\Models\Attendee;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AttendeeResource extends Resource
{
    protected static ?string $model = Attendee::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static bool $shouldSkipAuthorization = true;

    protected static ?string $navigationGroup = 'Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('fullname')
                    ->required()
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendees::route('/'),
            'create' => Pages\CreateAttendee::route('/create'),
            'edit' => Pages\EditAttendee::route('/{record}/edit'),
        ];
    }
}
