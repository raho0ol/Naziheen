<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResourceResource\Pages;
use App\Filament\Resources\ResourceResource\RelationManagers;
use App\Models\Resource as ResourceModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResourceResource extends Resource
{
    protected static ?string $model = ResourceModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('اسم المورد'),
            Forms\Components\Select::make('category')
                ->options([
                    'food' => 'طعام',
                    'clothing' => 'ملابس',
                    'medicine' => 'أدوية',
                    'hygiene' => 'مستلزمات نظافة',
                    'other' => 'أخرى',
                ])
                ->required()
                ->label('الفئة'),
            Forms\Components\TextInput::make('quantity')
                ->required()
                ->numeric()
                ->label('الكمية'),
            Forms\Components\TextInput::make('unit')
                ->required()
                ->label('الوحدة'),
            Forms\Components\DatePicker::make('expiry_date')
                ->label('تاريخ انتهاء الصلاحية'),
            Forms\Components\TextInput::make('location')
                ->required()
                ->label('الموقع'),
            Forms\Components\Textarea::make('notes')
                ->label('ملاحظات'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->label('اسم المورد'),
            Tables\Columns\TextColumn::make('category')->label('الفئة'),
            Tables\Columns\TextColumn::make('quantity')->label('الكمية'),
            Tables\Columns\TextColumn::make('unit')->label('الوحدة'),
            Tables\Columns\TextColumn::make('expiry_date')->date()->label('تاريخ انتهاء الصلاحية'),
            Tables\Columns\TextColumn::make('location')->label('الموقع'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('category')
                ->options([
                    'food' => 'طعام',
                    'clothing' => 'ملابس',
                    'medicine' => 'أدوية',
                    'hygiene' => 'مستلزمات نظافة',
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
            'index' => Pages\ListResources::route('/'),
            'create' => Pages\CreateResource::route('/create'),
            'edit' => Pages\EditResource::route('/{record}/edit'),
        ];
    }
}
