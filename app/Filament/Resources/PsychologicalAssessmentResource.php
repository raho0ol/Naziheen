<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PsychologicalAssessmentResource\Pages;
use App\Filament\Resources\PsychologicalAssessmentResource\RelationManagers;
use App\Models\PsychologicalAssessment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class PsychologicalAssessmentResource extends Resource
{
    protected static ?string $model = PsychologicalAssessment::class;

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
            Forms\Components\DatePicker::make('assessment_date')
                ->required()
                ->label('تاريخ التقييم'),
            Forms\Components\TextInput::make('assessor_name')
                ->required()
                ->label('اسم المقيم'),
            Forms\Components\Select::make('mental_state')
                ->options([
                    'stable' => 'مستقرة',
                    'moderate' => 'متوسطة',
                    'severe' => 'شديدة',
                ])
                ->required()
                ->label('الحالة النفسية'),
            Forms\Components\Slider::make('stress_level')
                ->min(0)->max(10)
                ->label('مستوى التوتر'),
            Forms\Components\Slider::make('anxiety_level')
                ->min(0)->max(10)
                ->label('مستوى القلق'),
            Forms\Components\Slider::make('depression_level')
                ->min(0)->max(10)
                ->label('مستوى الاكتئاب'),
            Forms\Components\Toggle::make('ptsd_symptoms')
                ->label('أعراض اضطراب ما بعد الصدمة'),
            Forms\Components\Toggle::make('suicidal_thoughts')
                ->label('أفكار انتحارية'),
            Forms\Components\Select::make('sleep_quality')
                ->options([
                    'good' => 'جيدة',
                    'fair' => 'متوسطة',
                    'poor' => 'سيئة',
                ])
                ->label('جودة النوم'),
            Forms\Components\Select::make('appetite')
                ->options([
                    'normal' => 'طبيعية',
                    'increased' => 'زائدة',
                    'decreased' => 'منخفضة',
                ])
                ->label('الشهية'),
            Forms\Components\Select::make('social_interactions')
                ->options([
                    'normal' => 'طبيعية',
                    'withdrawn' => 'منسحب',
                    'aggressive' => 'عدواني',
                ])
                ->label('التفاعلات الاجتماعية'),
            Forms\Components\Textarea::make('coping_mechanisms')
                ->label('آليات التكيف'),
            Forms\Components\Textarea::make('recommendations')
                ->required()
                ->label('التوصيات'),
            Forms\Components\DatePicker::make('follow_up_date')
                ->label('تاريخ المتابعة'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('assessment_date')->date()->label('تاريخ التقييم'),
            Tables\Columns\TextColumn::make('mental_state')->label('الحالة النفسية'),
            Tables\Columns\TextColumn::make('stress_level')->label('مستوى التوتر'),
            Tables\Columns\TextColumn::make('anxiety_level')->label('مستوى القلق'),
            Tables\Columns\TextColumn::make('depression_level')->label('مستوى الاكتئاب'),
            Tables\Columns\BooleanColumn::make('ptsd_symptoms')->label('أعراض اضطراب ما بعد الصدمة'),
            Tables\Columns\TextColumn::make('follow_up_date')->date()->label('تاريخ المتابعة'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('mental_state')
                ->options([
                    'stable' => 'مستقرة',
                    'moderate' => 'متوسطة',
                    'severe' => 'شديدة',
                ])
                ->label('الحالة النفسية'),
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
            'index' => Pages\ListPsychologicalAssessments::route('/'),
            'create' => Pages\CreatePsychologicalAssessment::route('/create'),
            'edit' => Pages\EditPsychologicalAssessment::route('/{record}/edit'),
        ];
    }
}
