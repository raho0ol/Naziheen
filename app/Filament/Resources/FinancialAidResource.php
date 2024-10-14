<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinancialAidResource\Pages;
use App\Filament\Resources\FinancialAidResource\RelationManagers;
use App\Models\FinancialAid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FinancialAidResource extends Resource
{
    protected static ?string $model = FinancialAid::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('refugee_id')
                ->relationship('refugee', 'full_name')
                ->required()
                ->searchable()
                ->label('النازح'),
            Forms\Components\TextInput::make('amount')
                ->required()
                ->numeric()
                ->label('المبلغ'),
            Forms\Components\TextInput::make('currency')
                ->required()
                ->label('العملة'),
            Forms\Components\TextInput::make('aid_type')
                ->required()
                ->label('نوع المساعدة'),
            Forms\Components\DatePicker::make('date_provided')
                ->required()
                ->label('تاريخ التقديم'),
            Forms\Components\TextInput::make('provider')
                ->required()
                ->label('الجهة المانحة'),
            Forms\Components\TextInput::make('purpose')
                ->required()
                ->label('الغرض'),
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'قيد الانتظار',
                    'approved' => 'موافق عليه',
                    'disbursed' => 'تم الصرف',
                    'completed' => 'مكتمل',
                    'cancelled' => 'ملغى',
                ])
                ->required()
                ->label('الحالة'),
            Forms\Components\Textarea::make('notes')
                ->label('ملاحظات'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('amount')->money('usd')->label('المبلغ'),
            Tables\Columns\TextColumn::make('currency')->label('العملة'),
            Tables\Columns\TextColumn::make('aid_type')->label('نوع المساعدة'),
            Tables\Columns\TextColumn::make('date_provided')->date()->label('تاريخ التقديم'),
            Tables\Columns\BadgeColumn::make('status')
                ->enum([
                    'pending' => 'قيد الانتظار',
                    'approved' => 'موافق عليه',
                    'disbursed' => 'تم الصرف',
                    'completed' => 'مكتمل',
                    'cancelled' => 'ملغى',
                ])
                ->colors([
                    'warning' => 'pending',
                    'success' => 'approved',
                    'primary' => 'disbursed',
                    'secondary' => 'completed',
                    'danger' => 'cancelled',
                ])
                ->label('الحالة'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'pending' => 'قيد الانتظار',
                    'approved' => 'موافق عليه',
                    'disbursed' => 'تم الصرف',
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFinancialAids::route('/'),
            'create' => Pages\CreateFinancialAid::route('/create'),
            'edit' => Pages\EditFinancialAid::route('/{record}/edit'),
        ];
    }
}
