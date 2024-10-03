<?php

namespace App\Filament\Dashboard\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Models\Contributor;
use App\Models\ContributorRole;
use App\Models\MediaLibraryItem;
use App\Models\ContributorMetaField;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Dashboard\Resources\PerformerResource\Pages;
use App\Filament\Dashboard\Resources\PerformerResource\RelationManagers;

class PerformerResource extends Resource
{
    protected static ?string $model = Contributor::class;

    // Slug
    protected static ?string $slug = 'performers';

    // Navigration Group
    public static function getNavigationGroup(): ?string
    {
        return '';
    }

    // Navigration
    protected static ?int $navigationSort = 40;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getModelLabel(): string
    {
        return __('Performers');
    }

    // Form
    private static function setMetaValue(callable $set, $metaField, $metaValue)
    {
        if ($metaValue !== null) {
            $set('meta[' . $metaField->id . ']', $metaValue);
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                \RalphJSmit\Filament\MediaLibrary\Forms\Components\MediaPicker::make('media_library_item_id')
                                    ->label(''),
                            ])
                            ->columnSpan([
                                'default' => 3,
                                'md' => 1,
                            ]),

                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Display Name')
                                    ->required()
                                    ->columnSpan('full'),

                                Forms\Components\Select::make('role_id')
                                    ->label('Role')
                                    ->relationship('role', 'name')
                                    ->options(function () {
                                        return ContributorRole::where('type', 'performer')->pluck('name', 'id');
                                    })
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $set('meta', []);
                                    })
                                    ->columnSpan('full'),

                                Forms\Components\Group::make()
                                    ->schema(function (callable $get) {
                                        $contributorId = $get('id');

                                        $roleId = $get('role_id');
                                        if (!$roleId) {
                                            return [];
                                        }

                                        $metaFields = ContributorMetaField::where('contributor_role_id', $roleId)
                                            ->with(['metas' => function ($query) use ($contributorId) {
                                                if ($contributorId) {
                                                    $query->where('contributor_id', $contributorId);
                                                }
                                            }])
                                            ->orderBy('sort_order')
                                            ->get();

                                        return $metaFields->map(function ($metaField) {
                                            $metaValue = optional($metaField->metas->first())->value;

                                            return match ($metaField->type) {
                                                'string' => Forms\Components\TextInput::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue)),
                                                'text' => Forms\Components\MarkdownEditor::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue)),
                                                'email' => Forms\Components\TextInput::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue))
                                                    ->email()
                                                    ->suffixIcon('heroicon-m-envelope'),
                                                'url' => Forms\Components\TextInput::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue))
                                                    ->url()
                                                    ->suffixIcon('heroicon-m-globe-alt'),
                                                'tel' => Forms\Components\TextInput::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue))
                                                    ->tel()
                                                    ->suffixIcon('heroicon-m-phone'),

                                                'integer' => Forms\Components\TextInput::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->integer()
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue)),
                                                'numeric' => Forms\Components\TextInput::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue))
                                                    ->numeric(),

                                                'date-time' => Forms\Components\DateTimePicker::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue))
                                                    ->suffixIcon('heroicon-m-calendar'),
                                                'date' => Forms\Components\DatePicker::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue))
                                                    ->suffixIcon('heroicon-m-calendar'),
                                                'time' => Forms\Components\TimePicker::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue))
                                                    ->suffixIcon('heroicon-m-clock'),

                                                'boolean' => Forms\Components\Toggle::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue)),

                                                'dropdown' => Forms\Components\Select::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->options(array_column($metaField->options, 'value', 'key'))
                                                    ->afterStateHydrated(fn(callable $set) => self::setMetaValue($set, $metaField, $metaValue)),
                                            };
                                        })->toArray();
                                    })
                                    ->columnSpan('full'),
                            ])->columnSpan([
                                'default' => 3,
                                'md' => 2,
                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('media_library_item_id')
                    ->label('Image')
                    ->getStateUsing(function (Contributor $record) {
                        $mediaLibraryItem = MediaLibraryItem::find($record->media_library_item_id);
                        return $mediaLibraryItem ? $mediaLibraryItem->getItem()->getUrl() : null;
                    })
                    ->label('Image')
                    ->square()
                    ->size(50),

                Tables\Columns\TextColumn::make('name')
                    ->label('Display Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('role.name')
                    ->label('Role')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role.name')
                    ->relationship('role', 'name', fn(Builder $query) => $query->where('type', 'performer'))
                    ->multiple()
                    ->preload()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Grid::make(3)
                    ->schema([
                        Infolists\Components\Section::make()
                            ->schema([
                                Infolists\Components\ImageEntry::make('media_library_item_id')
                                    ->label('')
                                    ->getStateUsing(function (Contributor $record) {
                                        $mediaLibraryItem = MediaLibraryItem::find($record->media_library_item_id);
                                        return $mediaLibraryItem ? $mediaLibraryItem->getItem()->getUrl() : null;
                                    })
                                    ->height('auto')
                                    ->size('100%'),
                            ])
                            ->columnSpan([
                                'default' => 3,
                                'md' => 1,
                            ]),

                        Infolists\Components\Section::make()
                            ->schema([
                                Infolists\Components\TextEntry::make('name')
                                    ->label('Display Name')
                                    ->columnSpan('full'),

                                Infolists\Components\TextEntry::make('role.name')
                                    ->label('Role')
                                    ->columnSpan('full'),

                                Infolists\Components\Group::make()
                                    ->schema(function (Contributor $record) {
                                        $contributorId = $record->id;

                                        $roleId = $record->role_id;
                                        if (!$roleId) {
                                            return [];
                                        }

                                        $metaFields = ContributorMetaField::where('contributor_role_id', $roleId)
                                            ->with(['metas' => function ($query) use ($contributorId) {
                                                if ($contributorId) {
                                                    $query->where('contributor_id', $contributorId);
                                                }
                                            }])
                                            ->orderBy('sort_order')
                                            ->get();

                                        return $metaFields->map(function ($metaField) {
                                            $metaValue = optional($metaField->metas->first())->value;

                                            if ($metaValue === null && $metaField->type !== 'boolean') {
                                                return null;
                                            }

                                            return match ($metaField->type) {
                                                'string', 'text', 'integer', 'numeric' => Infolists\Components\TextEntry::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->default($metaValue),

                                                'email' => Infolists\Components\TextEntry::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->default($metaValue)
                                                    ->url(fn() => 'mailto:' . $metaValue)
                                                    ->openUrlInNewTab(),

                                                'url' => Infolists\Components\TextEntry::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->default($metaValue)
                                                    ->url(fn() => $metaValue)
                                                    ->openUrlInNewTab(),

                                                'tel' => Infolists\Components\TextEntry::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->default($metaValue)
                                                    ->url(fn() => 'tel:' . preg_replace('/[\s()-]+/', '', $metaValue))
                                                    ->openUrlInNewTab(),

                                                'date-time' => Infolists\Components\TextEntry::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->default($metaValue ? \Carbon\Carbon::parse($metaValue)->format('d.m.Y H:i') : null),

                                                'date' => Infolists\Components\TextEntry::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->default($metaValue ? \Carbon\Carbon::parse($metaValue)->format('d.m.Y') : null),

                                                'time' => Infolists\Components\TextEntry::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->default($metaValue ? \Carbon\Carbon::parse($metaValue)->format('H:i') : null),

                                                'boolean' => Infolists\Components\IconEntry::make('is_featured')
                                                    ->label($metaField->name)
                                                    ->default($metaValue ? true : false)
                                                    ->boolean(),

                                                'dropdown' => Infolists\Components\TextEntry::make('meta[' . $metaField->id . ']')
                                                    ->label($metaField->name)
                                                    ->default(array_column($metaField->options, 'value', 'key')[$metaValue]),
                                            };
                                        })
                                            ->filter()
                                            ->values()
                                            ->toArray();
                                    })
                                    ->columnSpan('full'),
                            ])
                            ->columnSpan([
                                'default' => 3,
                                'md' => 2,
                            ]),

                    ]),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\MediaLibraryItemRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPerformers::route('/'),
            'create' => Pages\CreatePerformer::route('/create'),
            'view' => Pages\ViewPerformer::route('/{record}'),
            'edit' => Pages\EditPerformer::route('/{record}/edit'),
        ];
    }
}
