<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationSkillResource\Pages;
use App\Filament\Resources\EducationSkillResource\RelationManagers;
use App\Models\EducationSkill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EducationSkillResource extends Resource
{
    protected static ?string $model = EducationSkill::class;

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
            Forms\Components\Select::make('education_level')
                ->options([
                    'primary' => 'ابتدائي',
                    'secondary' => 'ثانوي',
                    'bachelor' => 'بكالوريوس',
                    'master' => 'ماجستير',
                    'phd' => 'دكتوراه',
                    'other' => 'أخرى',
                ])
                ->required()
                ->label('المستوى التعليمي'),
            Forms\Components\TextInput::make('field_of_study')
                ->label('مجال الدراسة'),
            Forms\Components\TagsInput::make('skills')
                ->label('المهارات'),
            Forms\Components\TagsInput::make('languages')
                ->label('اللغات'),
            Forms\Components\TagsInput::make('certifications')
                ->label('الشهادات'),
            Forms\Components\Textarea::make('work_experience')
                ->label('الخبرة العملية'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('education_level')->label('المستوى التعليمي'),
            Tables\Columns\TextColumn::make('field_of_study')->label('مجال الدراسة'),
            Tables\Columns\TagsColumn::make('skills')->label('المهارات'),
            Tables\Columns\TagsColumn::make('languages')->label('اللغات'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('education_level')
                ->options([
                    'primary' => 'ابتدائي',
                    'secondary' => 'ثانوي',
                    'bachelor' => 'بكالوريوس',
                    'master' => 'ماجستير',
                    'phd' => 'دكتوراه',
                    'other' => 'أخرى',
                ])
                ->label('المستوى التعليمي'),
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
            'index' => Pages\ListEducationSkills::route('/'),
            'create' => Pages\CreateEducationSkill::route('/create'),
            'edit' => Pages\EditEducationSkill::route('/{record}/edit'),
        ];
    }
}
