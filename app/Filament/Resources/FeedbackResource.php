<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

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
            Forms\Components\Select::make('type')
                ->options([
                    'complaint' => 'شكوى',
                    'suggestion' => 'اقتراح',
                ])
                ->required()
                ->label('النوع'),
            Forms\Components\TextInput::make('subject')
                ->required()
                ->label('الموضوع'),
            Forms\Components\Textarea::make('description')
                ->required()
                ->label('الوصف'),
            Forms\Components\Select::make('status')
                ->options([
                    'open' => 'مفتوح',
                    'in_progress' => 'قيد المعالجة',
                    'resolved' => 'تم الحل',
                    'closed' => 'مغلق',
                ])
                ->required()
                ->label('الحالة'),
            Forms\Components\Select::make('assigned_to')
                ->relationship('assignedTo', 'name')
                ->label('تم تعيينه إلى'),
            Forms\Components\Textarea::make('resolution')
                ->label('الحل'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('type')->label('النوع'),
            Tables\Columns\TextColumn::make('subject')->label('الموضوع'),
            Tables\Columns\TextColumn::make('status')->label('الحالة'),
            Tables\Columns\TextColumn::make('assignedTo.name')->label('تم تعيينه إلى'),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->label('تاريخ الإنشاء'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('type')
                ->options([
                    'complaint' => 'شكوى',
                    'suggestion' => 'اقتراح',
                ])
                ->label('النوع'),
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'open' => 'مفتوح',
                    'in_progress' => 'قيد المعالجة',
                    'resolved' => 'تم الحل',
                    'closed' => 'مغلق',
                ])
                ->label('الحالة'),
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
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
