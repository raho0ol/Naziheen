<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NeedResource\Pages;
use App\Filament\Resources\NeedResource\RelationManagers;
use App\Models\Need;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NeedResource extends Resource
{
    protected static ?string $model = Need::class;

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
            Forms\Components\Select::make('category')
                ->options([
                    'housing' => 'سكن',
                    'food' => 'طعام',
                    'clothing' => 'ملابس',
                    'medical' => 'رعاية طبية',
                    'education' => 'تعليم',
                    'employment' => 'توظيف',
                    'other' => 'أخرى',
                ])
                ->required()
                ->label('الفئة'),
            Forms\Components\Textarea::make('description')
                ->required()
                ->label('الوصف'),
            Forms\Components\Select::make('priority')
                ->options([
                    'low' => 'منخفضة',
                    'medium' => 'متوسطة',
                    'high' => 'عالية',
                    'urgent' => 'عاجلة',
                ])
                ->required()
                ->label('الأولوية'),
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'قيد الانتظار',
                    'in_progress' => 'قيد التنفيذ',
                    'fulfilled' => 'تم التلبية',
                    'cancelled' => 'ملغاة',
                ])
                ->required()
                ->label('الحالة'),
            Forms\Components\DatePicker::make('requested_date')
                ->required()
                ->label('تاريخ الطلب'),
            Forms\Components\DatePicker::make('fulfilled_date')
                ->label('تاريخ التلبية'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('category')->label('الفئة'),
            Tables\Columns\TextColumn::make('priority')->label('الأولوية'),
            Tables\Columns\TextColumn::make('status')->label('الحالة'),
            Tables\Columns\TextColumn::make('requested_date')->date()->label('تاريخ الطلب'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('category')
                ->options([
                    'housing' => 'سكن',
                    'food' => 'طعام',
                    'clothing' => 'ملابس',
                    'medical' => 'رعاية طبية',
                    'education' => 'تعليم',
                    'employment' => 'توظيف',
                    'other' => 'أخرى',
                ])
                ->label('الفئة'),
            Tables\Filters\SelectFilter::make('priority')
                ->options([
                    'low' => 'منخفضة',
                    'medium' => 'متوسطة',
                    'high' => 'عالية',
                    'urgent' => 'عاجلة',
                ])
                ->label('الأولوية'),
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'pending' => 'قيد الانتظار',
                    'in_progress' => 'قيد التنفيذ',
                    'fulfilled' => 'تم التلبية',
                    'cancelled' => 'ملغاة',
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
            'index' => Pages\ListNeeds::route('/'),
            'create' => Pages\CreateNeed::route('/create'),
            'edit' => Pages\EditNeed::route('/{record}/edit'),
        ];
    }
}
