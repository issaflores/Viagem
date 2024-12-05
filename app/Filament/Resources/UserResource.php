<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Cadastro')
                    ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')->label(__('Name'))
                    ->required()
                    ->maxLength(60),
                    Forms\Components\TextInput::make('email')->label(__('E-mail'))
                    ->required()
                    ->maxLength(100),
                    Forms\Components\TextInput::make('phone')->label(__('Whatsapps')),
                    Forms\Components\TextInput::make('document')->label(__('CPF/CNPJ'))
                    ->required(),
                    Forms\Components\TextInput::make('password')->label(__('Senha'))
                    ->required()
                    ->password()

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('Name')),
                Tables\Columns\TextColumn::make('email')->label(__('E-mail')),
                Tables\Columns\TextColumn::make('phone')->label(__('Whatsapps')),

            ])
            ->filters([
                TernaryFilter::make('email_verified_at')
                    ->label('Email verification')
                    ->placeholder('All users')
                    ->trueLabel('Verified users')
                    ->falseLabel('Not verified users')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('email_verified_at'),
                        false: fn (Builder $query) => $query->whereNull('email_verified_at'),
                        blank: fn (Builder $query) => $query, // In this example, we do not want to filter the query when it is blank.
                    )
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
