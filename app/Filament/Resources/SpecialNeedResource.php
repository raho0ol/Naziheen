<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecialNeedResource\Pages;
use App\Filament\Resources\SpecialNeedResource\RelationManagers;
use App\Models\SpecialNeed;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpecialNeedResource extends Resource
{
    protected static ?string $model = SpecialNeed::class;

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
                Forms\Components\TextInput::make('need_type')
                    ->required()
                    ->label('نوع الاحتياج الخاص'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('الوصف'),
                Forms\Components\Select::make('severity')
                    ->options([
                        'mild' => 'خفيف',
                        'moderate' => 'متوسط',
                        'severe' => 'شديد',
                    ])
                    ->required()
                    ->label('الشدة'),
                Forms\Components\DatePicker::make('diagnosis_date')
                    ->label('تاريخ التشخيص'),
                Forms\Components\Textarea::make('treatment_plan')
                    ->label('خطة العلاج'),
                Forms\Components\TextInput::make('assistive_devices')
                    ->label('الأجهزة المساعدة'),
                Forms\Components\Textarea::make('notes')
                    ->label('ملاحظات'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
                Tables\Columns\TextColumn::make('need_type')->label('نوع الاحتياج الخاص'),
                Tables\Columns\TextColumn::make('severity')->label('الشدة'),
                Tables\Columns\TextColumn::make('diagnosis_date')->date()->label('تاريخ التشخيص'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('severity')
                    ->options([
                        'mild' => 'خفيف',
                        'moderate' => 'متوسط',
                        'severe' => 'شديد',
                    ])
                    ->label('الشدة'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSpecialNeeds::route('/'),
            'create' => Pages\CreateSpecialNeed::route('/create'),
            'edit' => Pages\EditSpecialNeed::route('/{record}/edit'),
        ];
    }
}
