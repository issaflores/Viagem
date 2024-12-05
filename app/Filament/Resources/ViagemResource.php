<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ViagemResource\Pages;
use App\Models\Viagem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\RichEditor;


class ViagemResource extends Resource
{
    protected static ?string $model = Viagem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detalhes')
                ->schema([
                    Forms\Components\TextInput::make('titulo')
                        ->label(__('Titulo'))
                    ->required()
                    ->maxLength(100),
                    Forms\Components\TextInput::make('local')
                        ->label(__('Local'))
                    ->required()
                    ->maxLength(60),
                    RichEditor::make('description')
                        ->label(__('Descrição'))
                        ->maxLength(500)
                        ->required()
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'codeBlock',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ])
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titulo')
                ->label(__('Titulo'))
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('local')
                ->label(__('Local'))
                ->searchable()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListViagems::route('/'),
            'create' => Pages\CreateViagem::route('/create'),
            'edit' => Pages\EditViagem::route('/{record}/edit'),
        ];
    }
}
