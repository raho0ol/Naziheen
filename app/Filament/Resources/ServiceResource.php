<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

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
            Forms\Components\Select::make('service_type')
                ->options([
                    'medical' => 'طبية',
                    'educational' => 'تعليمية',
                    'legal' => 'قانونية',
                    'psychological' => 'نفسية',
                    'other' => 'أخرى',
                ])
                ->required()
                ->label('نوع الخدمة'),
            Forms\Components\Textarea::make('description')
                ->required()
                ->label('وصف الخدمة'),
            Forms\Components\Select::make('provided_by')
                ->relationship('providedBy', 'name')
                ->required()
                ->label('مقدم الخدمة'),
            Forms\Components\DateTimePicker::make('provided_at')
                ->required()
                ->label('تاريخ ووقت تقديم الخدمة'),
            Forms\Components\Select::make('status')
                ->options([
                    'scheduled' => 'مجدولة',
                    'in_progress' => 'قيد التنفيذ',
                    'completed' => 'مكتملة',
                    'cancelled' => 'ملغاة',
                ])
                ->required()
                ->label('حالة الخدمة'),
            Forms\Components\Textarea::make('notes')
                ->label('ملاحظات'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('service_type')->label('نوع الخدمة'),
            Tables\Columns\TextColumn::make('providedBy.name')->label('مقدم الخدمة'),
            Tables\Columns\TextColumn::make('provided_at')->dateTime()->label('تاريخ ووقت تقديم الخدمة'),
            Tables\Columns\TextColumn::make('status')->label('حالة الخدمة'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('service_type')
                ->options([
                    'medical' => 'طبية',
                    'educational' => 'تعليمية',
                    'legal' => 'قانونية',
                    'psychological' => 'نفسية',
                    'other' => 'أخرى',
                ])
                ->label('نوع الخدمة'),
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'scheduled' => 'مجدولة',
                    'in_progress' => 'قيد التنفيذ',
                    'completed' => 'مكتملة',
                    'cancelled' => 'ملغاة',
                ])
                ->label('حالة الخدمة'),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
