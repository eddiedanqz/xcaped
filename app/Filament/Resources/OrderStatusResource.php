<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderStatusResource\Pages;
use App\Models\OrderStatus;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class OrderStatusResource extends Resource
{
    protected static ?string $model = OrderStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Events';

    //protected static ?string $navigationLabel = 'Statuses';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->afterStateUpdated(function ($set, $state, $context) {
                        if ($context === 'edit') {
                            return;
                        }
                        $set('slug', Str::slug($state));
                    })
                    ->required()
                    ->maxLength(191),
                TextInput::make('slug')
                    ->maxLength(255)
                    ->rules(['alpha_dash'])
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(191),
                TextInput::make('color')
                    ->maxLength(191),
                TextInput::make('bg_color')
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
            'index' => Pages\ListOrderStatuses::route('/'),
            'create' => Pages\CreateOrderStatus::route('/create'),
            'edit' => Pages\EditOrderStatus::route('/{record}/edit'),
        ];
    }
}
