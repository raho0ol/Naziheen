<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VocationalTrainingResource\Pages;
use App\Filament\Resources\VocationalTrainingResource\RelationManagers;
use App\Models\VocationalTraining;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VocationalTrainingResource extends Resource
{
    protected static ?string $model = VocationalTraining::class;

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
            Forms\Components\TextInput::make('program_name')
                ->required()
                ->label('اسم البرنامج'),
            Forms\Components\Select::make('program_type')
                ->options([
                    'vocational' => 'تدريب مهني',
                    'educational' => 'تعليمي',
                    'language' => 'لغة',
                    'other' => 'أخرى',
                ])
                ->required()
                ->label('نوع البرنامج'),
            Forms\Components\DatePicker::make('start_date')
                ->required()
                ->label('تاريخ البدء'),
            Forms\Components\DatePicker::make('end_date')
                ->label('تاريخ الانتهاء'),
            Forms\Components\TextInput::make('institution')
                ->required()
                ->label('المؤسسة'),
            Forms\Components\TagsInput::make('skills_acquired')
                ->label('المهارات المكتسبة'),
            Forms\Components\TextInput::make('certification')
                ->label('الشهادة'),
            Forms\Components\Select::make('status')
                ->options([
                    'planned' => 'مخطط',
                    'ongoing' => 'جاري',
                    'completed' => 'مكتمل',
                    'dropped' => 'متوقف',
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
            Tables\Columns\TextColumn::make('program_name')->label('اسم البرنامج'),
            Tables\Columns\TextColumn::make('program_type')->label('نوع البرنامج'),
            Tables\Columns\TextColumn::make('start_date')->date()->label('تاريخ البدء'),
            Tables\Columns\TextColumn::make('end_date')->date()->label('تاريخ الانتهاء'),
            Tables\Columns\BadgeColumn::make('status')
                ->enum([
                    'planned' => 'مخطط',
                    'ongoing' => 'جاري',
                    'completed' => 'مكتمل',
                    'dropped' => 'متوقف',
                ])
                ->colors([
                    'secondary' => 'planned',
                    'primary' => 'ongoing',
                    'success' => 'completed',
                    'danger' => 'dropped',
                ])
                ->label('الحالة'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('program_type')
                ->options([
                    'vocational' => 'تدريب مهني',
                    'educational' => 'تعليمي',
                    'language' => 'لغة',
                    'other' => 'أخرى',
                ])
                ->label('نوع البرنامج'),
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'planned' => 'مخطط',
                    'ongoing' => 'جاري',
                    'completed' => 'مكتمل',
                    'dropped' => 'متوقف',
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
            'index' => Pages\ListVocationalTrainings::route('/'),
            'create' => Pages\CreateVocationalTraining::route('/create'),
            'edit' => Pages\EditVocationalTraining::route('/{record}/edit'),
        ];
    }
}
