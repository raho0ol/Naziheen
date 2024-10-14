<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

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
            Forms\Components\Select::make('document_type')
                ->options([
                    'passport' => 'جواز سفر',
                    'id_card' => 'بطاقة هوية',
                    'birth_certificate' => 'شهادة ميلاد',
                    'marriage_certificate' => 'عقد زواج',
                    'education_certificate' => 'شهادة تعليمية',
                    'other' => 'أخرى',
                ])
                ->required()
                ->label('نوع الوثيقة'),
            Forms\Components\TextInput::make('document_number')
                ->required()
                ->label('رقم الوثيقة'),
            Forms\Components\DatePicker::make('issue_date')
                ->required()
                ->label('تاريخ الإصدار'),
            Forms\Components\DatePicker::make('expiry_date')
                ->label('تاريخ الانتهاء'),
            Forms\Components\TextInput::make('issuing_authority')
                ->required()
                ->label('جهة الإصدار'),
            Forms\Components\FileUpload::make('file_path')
                ->directory('documents')
                ->label('ملف الوثيقة'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('document_type')->label('نوع الوثيقة'),
            Tables\Columns\TextColumn::make('document_number')->label('رقم الوثيقة'),
            Tables\Columns\TextColumn::make('issue_date')->date()->label('تاريخ الإصدار'),
            Tables\Columns\TextColumn::make('expiry_date')->date()->label('تاريخ الانتهاء'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('document_type')
                ->options([
                    'passport' => 'جواز سفر',
                    'id_card' => 'بطاقة هوية',
                    'birth_certificate' => 'شهادة ميلاد',
                    'marriage_certificate' => 'عقد زواج',
                    'education_certificate' => 'شهادة تعليمية',
                    'other' => 'أخرى',
                ])
                ->label('نوع الوثيقة'),
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
