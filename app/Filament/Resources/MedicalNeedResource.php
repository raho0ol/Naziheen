<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalNeedResource\Pages;
use App\Filament\Resources\MedicalNeedResource\RelationManagers;
use App\Models\MedicalNeed;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MedicalNeedResource extends Resource
{
    protected static ?string $model = MedicalNeed::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('refugee_id')
                ->relationship('refugee', 'full_name')
                ->required()
                ->searchable()
                ->label('النازح'),
            Forms\Components\TextInput::make('medical_condition')
                ->required()
                ->label('الحالة الطبية'),
            Forms\Components\TextInput::make('medication_name')
                ->required()
                ->label('اسم الدواء'),
            Forms\Components\TextInput::make('dosage')
                ->required()
                ->label('الجرعة'),
            Forms\Components\TextInput::make('frequency')
                ->required()
                ->label('التكرار'),
            Forms\Components\DatePicker::make('start_date')
                ->required()
                ->label('تاريخ البدء'),
            Forms\Components\DatePicker::make('end_date')
                ->label('تاريخ الانتهاء'),
            Forms\Components\TextInput::make('prescribing_doctor')
                ->required()
                ->label('الطبيب الواصف'),
            Forms\Components\Textarea::make('notes')
                ->label('ملاحظات'),
            Forms\Components\Select::make('status')
                ->options([
                    'active' => 'نشط',
                    'completed' => 'مكتمل',
                    'discontinued' => 'متوقف',
                ])
                ->required()
                ->label('الحالة'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('medical_condition')->label('الحالة الطبية'),
            Tables\Columns\TextColumn::make('medication_name')->label('اسم الدواء'),
            Tables\Columns\TextColumn::make('start_date')->date()->label('تاريخ البدء'),
            Tables\Columns\TextColumn::make('end_date')->date()->label('تاريخ الانتهاء'),
            Tables\Columns\BadgeColumn::make('status')
                ->enum([
                    'active' => 'نشط',
                    'completed' => 'مكتمل',
                    'discontinued' => 'متوقف',
                ])
                ->colors([
                    'success' => 'active',
                    'primary' => 'completed',
                    'danger' => 'discontinued',
                ])
                ->label('الحالة'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'active' => 'نشط',
                    'completed' => 'مكتمل',
                    'discontinued' => 'متوقف',
                ])
                ->label('الحالة'),
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
            'index' => Pages\ListMedicalNeeds::route('/'),
            'create' => Pages\CreateMedicalNeed::route('/create'),
            'edit' => Pages\EditMedicalNeed::route('/{record}/edit'),
        ];
    }
}
