<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrackResource\Pages;
use App\Models\Track;
use App\Tables\Columns\AudioColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrackResource extends Resource
{
    protected static ?string $model = Track::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $title = 'Custom Page Title';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make()->schema([
                    Forms\Components\Tabs\Tab::make('Общее')->schema([
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\Select::make('track_type_id')
                                ->disabled()
                                ->relationship('track_type', 'title'),
                            Forms\Components\Select::make('user_id')
                                ->relationship('user', 'name'),
                            Forms\Components\Select::make('genre_id')
                                ->relationship('genre', 'title'),
                            Forms\Components\TextInput::make('language')
                                ->maxLength(255),
                            Forms\Components\TextInput::make('feats'),
                            Forms\Components\TextInput::make('isrc')
                                ->maxLength(255),
                            Forms\Components\TextInput::make('composer')
                                ->maxLength(255),
                            Forms\Components\Toggle::make('flg_adult'),
                            Forms\Components\TextInput::make('text_author')
                                ->maxLength(255),
                        ])->columns(3),
                        Forms\Components\Textarea::make('text')

                    ])
                ])->columnSpanFull()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('artist_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                AudioColumn::make('mp3')
                    ->getStateUsing(function (Model $record) {
                        return $record->getFirstMediaUrl('mp3');
                    }),
                Tables\Columns\TextColumn::make('track_type.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('beat.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('genre.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('language')
                    ->searchable(),
                Tables\Columns\TextColumn::make('isrc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('composer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('text')
                    ->searchable(),
                Tables\Columns\IconColumn::make('flg_adult')
                    ->boolean(),
                Tables\Columns\TextColumn::make('text_author')
                    ->searchable(),
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('id', 'desc')
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
            'index' => Pages\ListTracks::route('/'),
            'create' => Pages\CreateTrack::route('/create'),
            'edit' => Pages\EditTrack::route('/{record}/edit'),
        ];
    }
}
