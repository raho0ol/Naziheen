<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HealthAssessmentResource\Pages;
use App\Filament\Resources\HealthAssessmentResource\RelationManagers;
use App\Models\HealthAssessment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HealthAssessmentResource extends Resource
{
    protected static ?string $model = HealthAssessment::class;

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
            Forms\Components\DatePicker::make('assessment_date')
                ->required()
                ->label('تاريخ التقييم'),
            Forms\Components\Select::make('general_health')
                ->options([
                    'excellent' => 'ممتاز',
                    'good' => 'جيد',
                    'fair' => 'متوسط',
                    'poor' => 'سيء',
                ])
                ->required()
                ->label('الحالة الصحية العامة'),
            Forms\Components\TagsInput::make('chronic_conditions')
                ->label('الأمراض المزمنة'),
            Forms\Components\TagsInput::make('medications')
                ->label('الأدوية'),
            Forms\Components\TagsInput::make('allergies')
                ->label('الحساسية'),
            Forms\Components\Textarea::make('notes')
                ->label('ملاحظات إضافية'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('assessment_date')->date()->label('تاريخ التقييم'),
            Tables\Columns\TextColumn::make('general_health')->label('الحالة الصحية العامة'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('general_health')
                ->options([
                    'excellent' => 'ممتاز',
                    'good' => 'جيد',
                    'fair' => 'متوسط',
                    'poor' => 'سيء',
                ])
                ->label('الحالة الصحية العامة'),
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
            'index' => Pages\ListHealthAssessments::route('/'),
            'create' => Pages\CreateHealthAssessment::route('/create'),
            'edit' => Pages\EditHealthAssessment::route('/{record}/edit'),
        ];
    }
}
