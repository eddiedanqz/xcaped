<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('event_id')
                    ->relationship('event', 'id')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->title)
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('capacity')
                    ->required(),
                Forms\Components\DatePicker::make('available_from'),
                Forms\Components\DatePicker::make('available_to'),
                Forms\Components\TextInput::make('price')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('capacity'),
                Tables\Columns\TextColumn::make('available_from')
                    ->date(),
                Tables\Columns\TextColumn::make('available_to')
                    ->date(),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
