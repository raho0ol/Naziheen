<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->label('عنوان الحدث'),
            Forms\Components\Textarea::make('description')
                ->required()
                ->label('وصف الحدث'),
            Forms\Components\Select::make('event_type')
                ->options([
                    'workshop' => 'ورشة عمل',
                    'training' => 'تدريب',
                    'social' => 'فعالية اجتماعية',
                    'other' => 'أخرى',
                ])
                ->required()
                ->label('نوع الحدث'),
            Forms\Components\DateTimePicker::make('start_date')
                ->required()
                ->label('تاريخ ووقت البدء'),
            Forms\Components\DateTimePicker::make('end_date')
                ->required()
                ->label('تاريخ ووقت الانتهاء'),
            Forms\Components\TextInput::make('location')
                ->required()
                ->label('الموقع'),
            Forms\Components\TextInput::make('max_participants')
                ->numeric()
                ->label('الحد الأقصى للمشاركين'),
            Forms\Components\MultiSelect::make('refugees')
                ->relationship('refugees', 'full_name')
                ->label('النازحون المشاركون'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('title')->label('عنوان الحدث'),
            Tables\Columns\TextColumn::make('event_type')->label('نوع الحدث'),
            Tables\Columns\TextColumn::make('start_date')->dateTime()->label('تاريخ البدء'),
            Tables\Columns\TextColumn::make('location')->label('الموقع'),
            Tables\Columns\TextColumn::make('refugees_count')->counts('refugees')->label('عدد المشاركين'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('event_type')
                ->options([
                    'workshop' => 'ورشة عمل',
                    'training' => 'تدريب',
                    'social' => 'فعالية اجتماعية',
                    'other' => 'أخرى',
                ])
                ->label('نوع الحدث'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
