<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovementResource\Pages;
use App\Filament\Resources\MovementResource\RelationManagers;
use App\Models\Movement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MovementResource extends Resource
{
    protected static ?string $model = Movement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('refugee_id')
                ->relationship('refugee', 'full_name')
                ->searchable()
                ->required()
                ->label('النازح'),
            Forms\Components\TextInput::make('from_location')
                ->required()
                ->label('من'),
            Forms\Components\TextInput::make('to_location')
                ->required()
                ->label('إلى'),
            Forms\Components\DatePicker::make('departure_date')
                ->required()
                ->label('تاريخ المغادرة'),
            Forms\Components\DatePicker::make('arrival_date')
                ->label('تاريخ الوصول'),
            Forms\Components\TextInput::make('reason')
                ->required()
                ->label('السبب'),
            Forms\Components\TextInput::make('transportation_method')
                ->required()
                ->label('وسيلة النقل'),
            Forms\Components\Select::make('status')
                ->options([
                    'planned' => 'مخطط',
                    'in_progress' => 'قيد التنفيذ',
                    'completed' => 'مكتمل',
                    'cancelled' => 'ملغى',
                ])
                ->required()
                ->label('الحالة'),
            Forms\Components\Textarea::make('notes')
                ->label('ملاحظات'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('from_location')->label('من'),
            Tables\Columns\TextColumn::make('to_location')->label('إلى'),
            Tables\Columns\TextColumn::make('departure_date')->date()->label('تاريخ المغادرة'),
            Tables\Columns\TextColumn::make('arrival_date')->date()->label('تاريخ الوصول'),
            Tables\Columns\TextColumn::make('status')->label('الحالة'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'planned' => 'مخطط',
                    'in_progress' => 'قيد التنفيذ',
                    'completed' => 'مكتمل',
                    'cancelled' => 'ملغى',
                ])
                ->label('الحالة'),
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
            'index' => Pages\ListMovements::route('/'),
            'create' => Pages\CreateMovement::route('/create'),
            'edit' => Pages\EditMovement::route('/{record}/edit'),
        ];
    }
}
