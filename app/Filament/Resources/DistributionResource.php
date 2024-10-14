<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistributionResource\Pages;
use App\Filament\Resources\DistributionResource\RelationManagers;
use App\Models\Distribution;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DistributionResource extends Resource
{
    protected static ?string $model = Distribution::class;

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
            Forms\Components\Select::make('resource_id')
                ->relationship('resource', 'name')
                ->searchable()
                ->required()
                ->label('المورد'),
            Forms\Components\TextInput::make('quantity')
                ->required()
                ->numeric()
                ->label('الكمية'),
            Forms\Components\DatePicker::make('distribution_date')
                ->required()
                ->label('تاريخ التوزيع'),
            Forms\Components\Select::make('distributed_by')
                ->relationship('distributedBy', 'name')
                ->required()
                ->label('تم التوزيع بواسطة'),
            Forms\Components\Textarea::make('notes')
                ->label('ملاحظات'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('refugee.full_name')->label('النازح'),
            Tables\Columns\TextColumn::make('resource.name')->label('المورد'),
            Tables\Columns\TextColumn::make('quantity')->label('الكمية'),
            Tables\Columns\TextColumn::make('distribution_date')->date()->label('تاريخ التوزيع'),
            Tables\Columns\TextColumn::make('distributedBy.name')->label('تم التوزيع بواسطة'),
        ])
        ->filters([
            Tables\Filters\Filter::make('distribution_date')
                ->form([
                    Forms\Components\DatePicker::make('from')->label('من'),
                    Forms\Components\DatePicker::make('until')->label('إلى'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('distribution_date', '>=', $date),
                        )
                        ->when(
                            $data['until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('distribution_date', '<=', $date),
                        );
                })
                ->label('تاريخ التوزيع'),
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
            'index' => Pages\ListDistributions::route('/'),
            'create' => Pages\CreateDistribution::route('/create'),
            'edit' => Pages\EditDistribution::route('/{record}/edit'),
        ];
    }
}
