<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MixtapeParticipationResource\Pages;
use App\Filament\Resources\MixtapeParticipationResource\RelationManagers;
use App\Models\MixtapeParticipation;
use App\Tables\Columns\AudioColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MixtapeParticipationResource extends Resource
{
    protected static ?string $model = MixtapeParticipation::class;
    protected static ?string $navigationLabel = 'Участия';
    protected static ?string $navigationGroup = 'Микстейпы';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mixtape_id')
                    ->relationship('mixtape', 'title')
                    ->required(),
                Forms\Components\Select::make('track_id')
                    ->relationship('track', 'title')
                    ->required(),
                Forms\Components\TextInput::make('mixtape_part_status_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name'),
                Forms\Components\TextInput::make('artist_name')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mixtape.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mixtape_part_status.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('track.title')
                    ->label('Название')
                    ->sortable(),
                Tables\Columns\TextColumn::make('artist_name')
                    ->label('Артист')
                    ->searchable(),
                AudioColumn::make('track')->getStateUsing(function(Model $record) {
                    return $record->track->getFirstMediaUrl('mp3');
                }),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->placeholder('Без пользователя')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->defaultSort('id', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
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
            RelationManagers\TrackRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMixtapeParticipations::route('/'),
            'create' => Pages\CreateMixtapeParticipation::route('/create'),
            'edit' => Pages\EditMixtapeParticipation::route('/{record}/edit'),
        ];
    }
}
