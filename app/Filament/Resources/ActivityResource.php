<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Filament\Resources\ActivityResource\RelationManagers;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Название активности')
                ->required(),
            Forms\Components\Textarea::make('description')
                ->label('Описание')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Описание')
                    ->searchable()
                    ->wrap(),
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

                // Фильтр для поиска по описанию
                Tables\Filters\Filter::make('description')
                    ->form([
                        Forms\Components\TextInput::make('description')
                            ->label('Поиск по описанию'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data['description']) {
                            $query->where('description', 'like', '%' . $data['description'] . '%');
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),  // Кнопка редактирования
                Tables\Actions\DeleteAction::make(), // Кнопка удаления
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
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
