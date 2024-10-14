<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoteResource\Pages;
use App\Filament\Resources\NoteResource\RelationManagers;
use App\Models\Note;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NoteResource extends Resource
{
    protected static ?string $model = Note::class;

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
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->required()
                ->label('المستخدم'),
            Forms\Components\Textarea::make('content')
                ->required()
                ->label('المحتوى'),
            Forms\Components\Select::make('category')
                ->options([
                    'general' => 'عام',
                    'health' => 'صحة',
                    'education' => 'تعليم',
                    'employment' => 'توظيف',
                    'legal' => 'قانوني',
                    'other' => 'أخرى',
                ])
                ->required()
                ->label('الفئة'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('user.name')->label('المستخدم'),
            Tables\Columns\TextColumn::make('content')->limit(50)->label('المحتوى'),
            Tables\Columns\TextColumn::make('category')->label('الفئة'),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->label('تاريخ الإنشاء'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('category')
                ->options([
                    'general' => 'عام',
                    'health' => 'صحة',
                    'education' => 'تعليم',
                    'employment' => 'توظيف',
                    'legal' => 'قانوني',
                    'other' => 'أخرى',
                ])
                ->label('الفئة'),
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
            'index' => Pages\ListNotes::route('/'),
            'create' => Pages\CreateNote::route('/create'),
            'edit' => Pages\EditNote::route('/{record}/edit'),
        ];
    }
}
