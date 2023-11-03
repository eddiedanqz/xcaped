<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('order_no'),
                Select::make('user_id')
                ->relationship('user', 'id')
                ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->fullname)
                ->searchable()
                ->preload()
                ->required(),
                Select::make('event_id')
                ->relationship('event', 'id')
                ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->title)
                ->searchable()
                ->preload()
                ->required(),
                TextInput::make('user_email'),
                TextInput::make('full_name'),
                Select::make('status')->options([
                    'completed' => 'Completed',
                    'declined' => 'Declined',
                    'pending' => 'Pending',
                    'processing' => 'Processing',
                ])->required(),
                TextInput::make('quantity'),
                TextInput::make('grand_total'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_no'),
                Tables\Columns\TextColumn::make('full_name'),
                Tables\Columns\TextColumn::make('user_email'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('grand_total'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('isPaid'),
                Tables\Columns\TextColumn::make('payment_method'),

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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
