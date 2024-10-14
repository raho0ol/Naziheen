<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingCourseResource\Pages;
use App\Filament\Resources\TrainingCourseResource\RelationManagers;
use App\Models\TrainingCourse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingCourseResource extends Resource
{
    protected static ?string $model = TrainingCourse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('course_name')
                    ->required()
                    ->label('اسم الدورة'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('وصف الدورة'),
                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->label('تاريخ البدء'),
                Forms\Components\DatePicker::make('end_date')
                    ->required()
                    ->label('تاريخ الانتهاء'),
                Forms\Components\TextInput::make('instructor')
                    ->required()
                    ->label('المدرب'),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->label('الموقع'),
                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->label('السعة'),
                Forms\Components\Select::make('status')
                    ->options([
                        'upcoming' => 'قادمة',
                        'ongoing' => 'جارية',
                        'completed' => 'مكتملة',
                        'cancelled' => 'ملغاة',
                    ])
                    ->required()
                    ->label('الحالة'),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course_name')->label('اسم الدورة'),
                Tables\Columns\TextColumn::make('start_date')->date()->label('تاريخ البدء'),
                Tables\Columns\TextColumn::make('end_date')->date()->label('تاريخ الانتهاء'),
                Tables\Columns\TextColumn::make('instructor')->label('المدرب'),
                Tables\Columns\TextColumn::make('status')->label('الحالة'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'upcoming' => 'قادمة',
                        'ongoing' => 'جارية',
                        'completed' => 'مكتملة',
                        'cancelled' => 'ملغاة',
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
          //  RelationManagers\RefugeesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainingCourses::route('/'),
            'create' => Pages\CreateTrainingCourse::route('/create'),
            'edit' => Pages\EditTrainingCourse::route('/{record}/edit'),
        ];
    }
}
