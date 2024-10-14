<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FamilyRelationResource\Pages;
use App\Filament\Resources\FamilyRelationResource\RelationManagers;
use App\Models\FamilyRelation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamilyRelationResource extends Resource
{
    protected static ?string $model = FamilyRelation::class;

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
            Forms\Components\Select::make('related_refugee_id')
                ->relationship('relatedRefugee', 'full_name')
                ->searchable()
                ->required()
                ->label('النازح ذو الصلة'),
            Forms\Components\Select::make('relation_type')
                ->options([
                    'parent' => 'والد/والدة',
                    'child' => 'ابن/ابنة',
                    'sibling' => 'أخ/أخت',
                    'spouse' => 'زوج/زوجة',
                    'grandparent' => 'جد/جدة',
                    'grandchild' => 'حفيد/حفيدة',
                    'other' => 'أخرى',
                ])
                ->required()
                ->label('نوع العلاقة'),
            Forms\Components\Textarea::make('notes')
                ->label('ملاحظات'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('relatedRefugee.full_name')->label('النازح ذو الصلة'),
            Tables\Columns\TextColumn::make('relation_type')->label('نوع العلاقة'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('relation_type')
                ->options([
                    'parent' => 'والد/والدة',
                    'child' => 'ابن/ابنة',
                    'sibling' => 'أخ/أخت',
                    'spouse' => 'زوج/زوجة',
                    'grandparent' => 'جد/جدة',
                    'grandchild' => 'حفيد/حفيدة',
                    'other' => 'أخرى',
                ])
                ->label('نوع العلاقة'),
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
            'index' => Pages\ListFamilyRelations::route('/'),
            'create' => Pages\CreateFamilyRelation::route('/create'),
            'edit' => Pages\EditFamilyRelation::route('/{record}/edit'),
        ];
    }
}
