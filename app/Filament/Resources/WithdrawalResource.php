<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithdrawalResource\Pages;
use App\Models\Withdrawal;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class WithdrawalResource extends Resource
{
    protected static ?string $model = Withdrawal::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Payments';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('order_no'),
                TextInput::make('organizer'),
                Select::make('event_id')
                ->relationship('event', 'id')
                ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->title)
                ->searchable()
                ->preload()
                ->required(),
                Select::make('status_id')
                ->relationship('status', 'id')
                ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->name)
                ->searchable()
                ->preload()
                ->required(),
                TextInput::make('method')->required(),
                TextInput::make('details')->required(),
                TextInput::make('actual_amount')->required(),
                TextInput::make('ended_at')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_no')->searchable(),
                Tables\Columns\TextColumn::make('event.title')->searchable(),
                Tables\Columns\TextColumn::make('status.name')->sortable(),
                Tables\Columns\TextColumn::make('organizer')->searchable(),
                Tables\Columns\TextColumn::make('method'),
                Tables\Columns\TextColumn::make('details'),
                Tables\Columns\TextColumn::make('actual_amount'),
                Tables\Columns\TextColumn::make('ended_at')->searchable(),
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
            'index' => Pages\ListWithdrawals::route('/'),
            'create' => Pages\CreateWithdrawal::route('/create'),
            'edit' => Pages\EditWithdrawal::route('/{record}/edit'),
        ];
    }
}
