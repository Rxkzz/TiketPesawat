<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassResource\Pages;
use App\Models\ClassModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Toggle;

class ClassResource extends Resource
{
    protected static ?string $model = ClassModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Transportasi';
    protected static ?string $label = 'Kelas';
    protected static ?string $pluralLabel = 'Kelas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_class')
                    ->label('Nama Kelas')
                    ->required()
                    ->maxLength(255),
                TextInput::make('harga_tambahan')
                    ->label('Harga Tambahan')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Select::make('fasilitas')
                    ->label('Fasilitas')
                    ->multiple()
                    ->relationship('fasilitas', 'nama_fasilitas')
                    ->preload()
                    ->searchable(),
                RichEditor::make('deskripsi')
                    ->label('Keterangan')
                    ->columnSpanFull(),
                TextInput::make('bagasi')
                    ->required()
                    ->numeric()
                    ->suffix('kg')
                    ->label('Berat Bagasi'),
                Toggle::make('hiburan')
                    ->required()
                    ->label('Hiburan')
                    ->helperText('Apakah kelas ini menyediakan hiburan?')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_class')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nama_class')
                    ->label('Nama Kelas')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('harga_tambahan')
                    ->label('Harga Tambahan')
                    ->money('idr')
                    ->sortable(),
                TextColumn::make('fasilitas.nama_fasilitas')
                    ->label('Fasilitas')
                    ->listWithLineBreaks()
                    ->limitList(3),
                TextColumn::make('bagasi')
                    ->label('Berat Bagasi')
                    ->suffix(' kg')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('hiburan')
                    ->label('Hiburan')
                    ->boolean()
                    ->sortable(),
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
            'index' => Pages\ListClasses::route('/'),
            'create' => Pages\CreateClass::route('/create'),
            'edit' => Pages\EditClass::route('/{record}/edit'),
        ];
    }
} 