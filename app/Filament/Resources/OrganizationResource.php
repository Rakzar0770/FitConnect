<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationResource\Pages;
use App\Filament\Resources\OrganizationResource\RelationManagers;
use App\Models\Organization;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Поле для названия организации
            Forms\Components\TextInput::make('name')
                ->label('Название организации')
                ->required()
                ->maxLength(255),

            // Блок для управления филиалами
            Forms\Components\Repeater::make('branches')
                ->label('Филиалы')
                ->relationship()
                ->schema([
                    Forms\Components\Grid::make(3) // Разделяем на 3 колонки
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->label('Адрес филиала')
                            ->required(),

                        Forms\Components\Repeater::make('trainers')
                            ->label('Тренеры')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Имя тренера')
                                    ->required(),
                            ])
                            ->columnSpan(1), // Занимает одну колонку

                        Forms\Components\Select::make('activities')
                            ->label('Активности')
                            ->multiple()
                            ->relationship('activities', 'name')
                            ->preload()
                            ->searchable()
                            ->columnSpan(1), // Занимает одну колонку
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Название')
                ->searchable(), // Включаем поиск по колонке
        ])
            ->filters([
                Tables\Filters\Filter::make('name')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('Поиск по названию'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data['name']) {
                            $query->where('name', 'like', '%' . $data['name'] . '%');
                        }
                    }),
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
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }
}
