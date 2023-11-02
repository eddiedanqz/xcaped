<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventStatusResource\Pages;
use App\Models\EventStatus;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class EventStatusResource extends Resource
{
    protected static ?string $model = EventStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->afterStateUpdated(function ($set, $state, $context) {
                    if ($context === 'edit') {
                        return;
                    }
                    $set('slug', Str::slug($state));
                })
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('slug')
                ->maxLength(255)
                ->rules(['alpha_dash'])
                ->unique(ignoreRecord: true)
                ->required()
                ->maxLength(191),
                Forms\Components\TextInput::make('color')
                    ->maxLength(191),
                Forms\Components\TextInput::make('bg_color')
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('color'),
                Tables\Columns\TextColumn::make('bg_color'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListEventStatuses::route('/'),
            'create' => Pages\CreateEventStatus::route('/create'),
            'edit' => Pages\EditEventStatus::route('/{record}/edit'),
        ];
    }
}
