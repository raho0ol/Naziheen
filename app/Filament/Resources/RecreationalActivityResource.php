<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecreationalActivityResource\Pages;
use App\Filament\Resources\RecreationalActivityResource\RelationManagers;
use App\Models\RecreationalActivity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecreationalActivityResource extends Resource
{
    protected static ?string $model = RecreationalActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('اسم النشاط'),
            Forms\Components\Textarea::make('description')
                ->required()
                ->label('وصف النشاط'),
            Forms\Components\Select::make('activity_type')
                ->options([
                    'cultural' => 'ثقافي',
                    'sports' => 'رياضي',
                    'art' => 'فني',
                    'music' => 'موسيقي',
                    'educational' => 'تعليمي',
                    'other' => 'أخرى',
                ])
                ->required()
                ->label('نوع النشاط'),
            Forms\Components\DateTimePicker::make('start_date')
                ->required()
                ->label('تاريخ ووقت البدء'),
            Forms\Components\DateTimePicker::make('end_date')
                ->required()
                ->label('تاريخ ووقت الانتهاء'),
            Forms\Components\TextInput::make('location')
                ->required()
                ->label('الموقع'),
            Forms\Components\TextInput::make('capacity')
                ->required()
                ->numeric()
                ->label('السعة'),
            Forms\Components\TextInput::make('organizer')
                ->required()
                ->label('المنظم'),
            Forms\Components\Select::make('status')
                ->options([
                    'planned' => 'مخطط',
                    'ongoing' => 'جاري',
                    'completed' => 'مكتمل',
                    'cancelled' => 'ملغى',
                ])
                ->required()
                ->label('الحالة'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->label('اسم النشاط'),
            Tables\Columns\TextColumn::make('activity_type')->label('نوع النشاط'),
            Tables\Columns\TextColumn::make('start_date')->dateTime()->label('تاريخ ووقت البدء'),
            Tables\Columns\TextColumn::make('location')->label('الموقع'),
            Tables\Columns\TextColumn::make('status')->label('الحالة'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('activity_type')
                ->options([
                    'cultural' => 'ثقافي',
                    'sports' => 'رياضي',
                    'art' => 'فني',
                    'music' => 'موسيقي',
                    'educational' => 'تعليمي',
                    'other' => 'أخرى',
                ])
                ->label('نوع النشاط'),
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'planned' => 'مخطط',
                    'ongoing' => 'جاري',
                    'completed' => 'مكتمل',
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
           // RelationManagers\RefugeesRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecreationalActivities::route('/'),
            'create' => Pages\CreateRecreationalActivity::route('/create'),
            'edit' => Pages\EditRecreationalActivity::route('/{record}/edit'),
        ];
    }
}
