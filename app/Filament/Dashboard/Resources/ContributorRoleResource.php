<?php

namespace App\Filament\Dashboard\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ContributorRole;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Dashboard\Resources\ContributorRoleResource\Pages;
use App\Filament\Dashboard\Resources\ContributorRoleResource\RelationManagers;

class ContributorRoleResource extends Resource
{
    protected static ?string $model = ContributorRole::class;

    // Slug
    protected static ?string $slug = 'roles-and-attributes';

    // Navigration Group
    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }

    // Navigration
    protected static ?int $navigationSort = 80;

    protected static ?string $navigationIcon = '';

    public static function getModelLabel(): string
    {
        return __('Roles and Attributes');
    }

    // Form
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options([
                        'performer' => 'Performer',
                        'production' => 'Production',
                    ])
                    ->label('Type')
                    ->required()
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('name')
                    ->label('Role')
                    ->required()
                    ->columnSpan('full'),

                Forms\Components\Repeater::make('metaFields')
                    ->label('Fields')
                    ->relationship('metaFields')
                    ->orderColumn('sort_order')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Field Name')
                            ->required()
                            ->columnSpan(1),

                        Forms\Components\Select::make('type')
                            ->label('Field Type')
                            ->options([
                                'string' => __('String'),
                                'text' => __('Text'),
                                'email' => __('Email'),
                                'url' => __('URL'),
                                'tel' => __('Tel'),
                                'integer' => __('Integer'),
                                'numeric' => __('Numeric'),
                                'date-time' => __('Date-Time'),
                                'date' => __('Date'),
                                'time' => __('Time'),
                                'boolean' => __('Boolean'),
                                'dropdown' => __('Dropdown'),
                            ])
                            ->required()
                            ->columnSpan(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state !== 'dropdown') {
                                    $set('options', []);
                                }
                            }),

                        Forms\Components\Repeater::make('options')
                            ->label('Dropdown Options')
                            ->schema([
                                Forms\Components\TextInput::make('value')
                                    ->label('Option Value')
                                    ->required()
                                    ->columnSpan(1),
                            ])
                            ->columns(1)
                            ->columnSpan(2)
                            ->visible(fn($get) => $get('type') === 'dropdown')
                            ->minItems(1)
                            ->maxItems(20),
                    ])
                    ->columns(2)
                    ->addActionLabel('Add Meta Field')
                    ->minItems(0)
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Role')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->formatStateUsing(function ($state) {
                        return $state === 'performer' ? 'Performer' : 'Production';
                    })
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContributorRoles::route('/'),
            'create' => Pages\CreateContributorRole::route('/create'),
            'edit' => Pages\EditContributorRole::route('/{record}/edit'),
        ];
    }
}
