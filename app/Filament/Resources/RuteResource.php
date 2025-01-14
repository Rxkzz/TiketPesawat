<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RuteResource\Pages;
use App\Filament\Resources\RuteResource\RelationManagers;
use App\Models\Rute;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class RuteResource extends Resource
{
    protected static ?string $model = Rute::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';
    protected static ?string $navigationGroup = 'Transportasi';     
       protected static ?string $label = 'Rute';
       protected static ?string $pluralLabel = 'Rute';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                    TextInput::make('tujuan')
                    ->label('Tujuan')
                    ->required() 
                    ->maxLength(255),
                    TextInput::make('rute_awal')
                    ->label('rute_awal')
                    ->required() 
                    ->maxLength(255),            
                    TextInput::make('rute_akhir')
                    ->label('rute_akhir')
                    ->required() 
                    ->maxLength(255),           
                    TextInput::make('harga')->label('harga')
                    ->required() 
                    ->numeric()
                    ->maxLength(255), 
                    Forms\Components\Select::make('id_transportasi')
                       ->label('kode')
                       ->required() 
                    ->relationship('Transportasi', 'kode'),            
            ]);
      }
  
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id_rute')
                ->label('ID')
                ->searchable(),
                TextColumn::make('tujuan')
                ->label('Nama Tipe')
                ->searchable(),
                TextColumn::make('rute_awal')
                ->label('rute_awal')
                ->searchable(),             
                TextColumn::make('rute_akhir')
                ->label('rute_akhir')
                ->searchable(),             
                TextColumn::make('harga')->label('harga'),   
                TextColumn::make('Transportasi.kode')->label('kode'),   
            ])
            ->filters([
                //
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
            'index' => Pages\ListRutes::route('/'),
            'create' => Pages\CreateRute::route('/create'),
            'edit' => Pages\EditRute::route('/{record}/edit'),
        ];
    }
}
