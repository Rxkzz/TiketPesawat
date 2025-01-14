<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeTransportasiResource\Pages;
   use App\Filament\Resources\TypeTransportasiResource\RelationManagers;
use App\Models\TypeTransportasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn; 
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;

class TypeTransportasiResource extends Resource
{
    protected static ?string $model = TypeTransportasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';
    protected static ?string $navigationGroup = 'Transportasi';  

    protected static ?string $label = 'Type Transportasi';
    protected static ?string $pluralLabel = 'Type Transportasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_type')
                ->label('Type')
                ->required()
                ->maxLength(50),
                RichEditor::make('keterangan')
                ->label('Keterangan')
                ->required()
                ->maxLength(255),
            ]);
    }
 
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_type_transportasi')
                ->label('ID Type Transportasi')
                ->searchable(),
                TextColumn::make('nama_type')
                ->label('Type')
                ->searchable(),
                TextColumn::make('keterangan')->label('Keterangan')->wrap(),
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
            'index' => Pages\ListTypeTransportasi::route('/'),
            'create' => Pages\CreateTypeTransportasi::route('/create'),
            'edit' => Pages\EditTypeTransportasi::route('/{record}/edit'),
        ];
    }
}
