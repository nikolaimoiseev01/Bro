<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MixtapeResource\Pages;
use App\Filament\Resources\MixtapeResource\RelationManagers;
use App\Models\Mixtape;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Njxqlus\Filament\Components\Forms\RelationManager;

class MixtapeResource extends Resource
{
    protected static ?string $model = Mixtape::class;

    protected static ?string $navigationLabel = 'Микстейпы';
    protected static ?string $navigationGroup = 'Микстейпы';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make()->schema([
                    Forms\Components\Tabs\Tab::make('Общее')->schema([
                        Forms\Components\Grid::make()->schema([
                            SpatieMediaLibraryFileUpload::make('cover')
                                ->collection('cover')
                                ->columnSpan(1),
                            Forms\Components\Grid::make()->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->label('Название'),
                                Forms\Components\TextInput::make('price')
                                    ->required()
                                    ->label('Цена')
                                    ->numeric()
                                    ->prefix('₽'),
                                Forms\Components\Select::make('mixtape_status_id')
                                    ->relationship('mixtape_status', 'title')
                                    ->label('Статус'),
                            ])->columns(3)->columnSpan(2)
                        ])->columns(3),
                    ]),
                    Forms\Components\Tabs\Tab::make('Стриминги')->schema([
                        Repeater::make('streamings')
                            ->label('')
                            ->schema([
                                Select::make('service')
                                    ->options([
                                        'yandex' => 'Yandex',
                                        'spotify' => 'Spotify',
                                        'vk' => 'VK',
                                    ])
                                    ->required(),
                                TextInput::make('link')->required(),
                            ])
                            ->grid(2)
                            ->columns(2)
                    ]),
                    Forms\Components\Tabs\Tab::make('Участия')->schema([
                        RelationManager::make()->manager(RelationManagers\MixtapeParticipationRelationManager::class)->lazy(false)->label('')
                    ])
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    SpatieMediaLibraryImageColumn::make('cover')
                        ->collection('cover')
                        ->extraImgAttributes(['class' => 'w-full rounded max-w-xs'])
                        ->extraAttributes(['class' => 'max-w-xs'])
                        ->height('auto'),
                    Tables\Columns\TextColumn::make('title')
                        ->weight(FontWeight::SemiBold)
                        ->limit(50)
                        ->searchable()
                        ->size(Tables\Columns\TextColumn\TextColumnSize::Large),
                    Tables\Columns\TextColumn::make('price')
                        ->limit(50)
                        ->searchable()
                        ->html()
                ]),
            ])
            ->filters([
                //
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 5,
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
//            RelationManagers\MixtapeParticipationRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMixtapes::route('/'),
            'create' => Pages\CreateMixtape::route('/create'),
            'edit' => Pages\EditMixtape::route('/{record}/edit'),
        ];
    }
}
