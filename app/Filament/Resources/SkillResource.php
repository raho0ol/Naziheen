<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Filament\Resources\SkillResource\RelationManagers;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

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
                Forms\Components\TextInput::make('skill_name')
                    ->required()
                    ->label('اسم المهارة'),
                Forms\Components\Select::make('skill_level')
                    ->options([
                        'beginner' => 'مبتدئ',
                        'intermediate' => 'متوسط',
                        'advanced' => 'متقدم',
                        'expert' => 'خبير',
                    ])
                    ->required()
                    ->label('مستوى المهارة'),
                Forms\Components\TextInput::make('years_of_experience')
                    ->required()
                    ->numeric()
                    ->label('سنوات الخبرة'),
                Forms\Components\TextInput::make('certification')
                    ->label('الشهادة'),
                Forms\Components\DatePicker::make('last_used')
                    ->label('آخر استخدام'),
                Forms\Components\Textarea::make('notes')
                    ->label('ملاحظات'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
                Tables\Columns\TextColumn::make('skill_name')->label('اسم المهارة'),
                Tables\Columns\TextColumn::make('skill_level')->label('مستوى المهارة'),
                Tables\Columns\TextColumn::make('years_of_experience')->label('سنوات الخبرة'),
                Tables\Columns\TextColumn::make('certification')->label('الشهادة'),
                Tables\Columns\TextColumn::make('last_used')->date()->label('آخر استخدام'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('skill_level')
                    ->options([
                        'beginner' => 'مبتدئ',
                        'intermediate' => 'متوسط',
                        'advanced' => 'متقدم',
                        'expert' => 'خبير',
                    ])
                    ->label('مستوى المهارة'),
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
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
