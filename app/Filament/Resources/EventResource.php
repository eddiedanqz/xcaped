<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user_id')
                    ->required(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(191),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(191),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('type')
                    ->required()
                    ->maxLength(191),
                Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
                FileUpload::make('banner')->image()
                    ->maxSize(1024)
                    ->imageResizeMode('contain')
                   //->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('277')
                    ->imageResizeTargetHeight('139'),
                DatePicker::make('start_date')
                    ->required(),
                TextInput::make('start_time')
                    ->required(),
                DatePicker::make('end_date'),
                TextInput::make('end_time'),
                TextInput::make('venue')
                    ->required()
                    ->maxLength(191),
                TextInput::make('address')
                    ->maxLength(191),
                TextInput::make('address_latitude'),
                TextInput::make('address_longitude'),
                TextInput::make('author')
                    ->required()
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->searchable(),
                Tables\Columns\TextColumn::make('status.name')->sortable(),
                Tables\Columns\TextColumn::make('type')->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date(),
                Tables\Columns\TextColumn::make('start_time'),
                Tables\Columns\TextColumn::make('author'),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
