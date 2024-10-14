<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobOpportunityResource\Pages;
use App\Filament\Resources\JobOpportunityResource\RelationManagers;
use App\Models\JobOpportunity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobOpportunityResource extends Resource
{
    protected static ?string $model = JobOpportunity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('عنوان الوظيفة'),
                Forms\Components\TextInput::make('company')
                    ->required()
                    ->label('الشركة'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('وصف الوظيفة'),
                Forms\Components\Textarea::make('requirements')
                    ->required()
                    ->label('المتطلبات'),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->label('الموقع'),
                Forms\Components\TextInput::make('salary')
                    ->label('الراتب'),
                Forms\Components\DatePicker::make('application_deadline')
                    ->required()
                    ->label('الموعد النهائي للتقديم'),
                Forms\Components\Select::make('status')
                    ->options([
                        'open' => 'مفتوحة',
                        'closed' => 'مغلقة',
                        'filled' => 'تم شغلها',
                    ])
                    ->required()
                    ->label('الحالة'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('عنوان الوظيفة'),
                Tables\Columns\TextColumn::make('company')->label('الشركة'),
                Tables\Columns\TextColumn::make('location')->label('الموقع'),
                Tables\Columns\TextColumn::make('application_deadline')->date()->label('الموعد النهائي للتقديم'),
                Tables\Columns\TextColumn::make('status')->label('الحالة'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'open' => 'مفتوحة',
                        'closed' => 'مغلقة',
                        'filled' => 'تم شغلها',
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
         //   RelationManagers\RefugeesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobOpportunities::route('/'),
            'create' => Pages\CreateJobOpportunity::route('/create'),
            'edit' => Pages\EditJobOpportunity::route('/{record}/edit'),
        ];
    }
}
