<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AidResource\Pages;
use App\Filament\Resources\AidResource\RelationManagers;
use App\Models\Aid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AidResource extends Resource
{
    protected static ?string $model = Aid::class;

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
            Forms\Components\Select::make('type')
                ->options([
                    'food' => 'طعام',
                    'clothing' => 'ملابس',
                    'medical' => 'مساعدة طبية',
                    'financial' => 'مساعدة مالية',
                    'other' => 'أخرى',
                ])
                ->required()
                ->label('نوع المساعدة'),
            Forms\Components\Textarea::make('description')
                ->required()
                ->label('وصف المساعدة'),
            Forms\Components\TextInput::make('amount')
                ->numeric()
                ->label('القيمة (إن وجدت)'),
            Forms\Components\DatePicker::make('date_provided')
                ->required()
                ->label('تاريخ تقديم المساعدة'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('type')->label('نوع المساعدة'),
            Tables\Columns\TextColumn::make('amount')->label('القيمة'),
            Tables\Columns\TextColumn::make('date_provided')->date()->label('تاريخ التقديم'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('type')
                ->options([
                    'food' => 'طعام',
                    'clothing' => 'ملابس',
                    'medical' => 'مساعدة طبية',
                    'financial' => 'مساعدة مالية',
                    'other' => 'أخرى',
                ])
                ->label('نوع المساعدة'),
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
            'index' => Pages\ListAids::route('/'),
            'create' => Pages\CreateAid::route('/create'),
            'edit' => Pages\EditAid::route('/{record}/edit'),
        ];
    }
}
