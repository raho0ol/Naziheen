<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('اسم المشروع'),
            Forms\Components\Textarea::make('description')
                ->required()
                ->label('وصف المشروع'),
            Forms\Components\DatePicker::make('start_date')
                ->required()
                ->label('تاريخ البدء'),
            Forms\Components\DatePicker::make('end_date')
                ->label('تاريخ الانتهاء'),
            Forms\Components\Select::make('status')
                ->options([
                    'planned' => 'مخطط',
                    'in_progress' => 'قيد التنفيذ',
                    'completed' => 'مكتمل',
                    'on_hold' => 'معلق',
                    'cancelled' => 'ملغى',
                ])
                ->required()
                ->label('الحالة'),
            Forms\Components\TextInput::make('budget')
                ->numeric()
                ->label('الميزانية'),
            Forms\Components\TextInput::make('manager')
                ->required()
                ->label('مدير المشروع'),
            Forms\Components\TextInput::make('location')
                ->required()
                ->label('الموقع'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->label('اسم المشروع'),
            Tables\Columns\TextColumn::make('start_date')->date()->label('تاريخ البدء'),
            Tables\Columns\TextColumn::make('end_date')->date()->label('تاريخ الانتهاء'),
            Tables\Columns\TextColumn::make('status')->label('الحالة'),
            Tables\Columns\TextColumn::make('manager')->label('مدير المشروع'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'planned' => 'مخطط',
                    'in_progress' => 'قيد التنفيذ',
                    'completed' => 'مكتمل',
                    'on_hold' => 'معلق',
                    'cancelled' => 'ملغى',
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
