<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsuarioResource\Pages;
use App\Models\Usuario;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Viagem;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;

class UsuarioResource extends Resource
{
    protected static ?string $model = Usuario::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Section::make('Informações do Usuário')
                ->columns(2)
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(60),
                TextInput::make('email')
                    ->label(__('E-mail'))
                ->required()
                ->maxLength(100),
                TextInput::make('document')->label(__('CPF'))
                ->required()
                ->maxLength(20),
                TextInput::make('password')
                    ->label(__('Senha'))
                ->password()
                ->required()
                ->maxLength(20),
                TextInput::make('phone')
                    ->label(__('Whatsapp'))
                ->required()
                ->maxLength(20),

                TextInput::make('phone_confirmation')
                    ->label(__('Confirmar Whatsapp')),
                TextInput::make('phone_secondary')
                ->label(__('Telefone Secundario'))
                ->maxLength(20),

                Forms\Components\TextInput::make('viagens_id')
                    ->label(__('Viagem'))
                    ->placeholder('Digite o nome de uma nova viagem ou escolha uma existente.')
                    ->datalist(
                        Viagem::all()->pluck('titulo')->toArray()
                    )
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $viagem = Viagem::firstOrCreate(
                            ['titulo' => $state],
                            ['local' => 'Local indefinido']
                        );
                        $set('viagens_id', $viagem->id);
                    }),
                Forms\Components\Hidden::make('viagens_id')
                    ->required(),


            ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()
                ->label('Nome'),
                Tables\Columns\TextColumn::make('email')->sortable()
                ->label('Email'),
                Tables\Columns\TextColumn::make('viagem.titulo')
                ->label(__('Viagem'))
                    ->sortable()
                    ->searchable(),


            ])
            ->filters([
                Tables\Filters\SelectFilter::make('viagens_id')
                    ->label('Viagem')
                    ->options(Viagem::all()->pluck('titulo', 'id')->toArray())
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                ])

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
            'index' => Pages\ListUsuarios::route('/'),
            'create' => Pages\CreateUsuario::route('/create'),
            'edit' => Pages\EditUsuario::route('/{record}/edit'),
        ];
    }
}
