<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransportasiResource\Pages;
use App\Models\Transportasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

class TransportasiResource extends Resource
{
    protected static ?string $model = Transportasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Transportasi';  
    protected static ?string $label = 'Transportasi';
    protected static ?string $pluralLabel = 'Transportasi';
      
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode')
                ->label('Kode')
                ->required()
                ->maxLength(10),
                TextInput::make('jumlah_kursi')
                    ->label('Jumlah Kursi')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(1000)
                    ->step(1),
                    
                Textarea::make('keterangan')
                ->label('Keterangan')
                ->required()
                 ->maxLength(255),
                Forms\Components\Select::make('id_type_transportasi')
                    ->label('Tipe Transportasi')
                    ->required()
                 ->relationship('typeTransportasi', 'nama_Type'),
                 FileUpload::make('image')
                 ->label('Gambar Maskapai')
                 ->image()
                 ->directory('maskapai-images')
                 ->preserveFilenames()
                 ->maxSize(5120)
                 ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                 ->disk('public')
                 ->downloadable()
                 ->openable()
                 ->previewable()
                 ->imageEditor()
                 ->imageResizeMode('cover')
                 ->imageCropAspectRatio('16:9')
                 ->imageResizeTargetWidth('1920')
                 ->imageResizeTargetHeight('1080'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_transportasi')
                 ->label('ID Transportasi')
                 ->searchable(),
                 TextColumn::make('typeTransportasi.nama_type') 
                 ->label('Type Transportasi')
                 ->searchable(),
             TextColumn::make('kode')
                 ->label('Kode')
                 ->searchable(),
             TextColumn::make('jumlah_kursi')
                 ->label('Jumlah Kursi'),
             TextColumn::make('keterangan')
                 ->label('Keterangan')
                 ->wrap(),
             ImageColumn::make('image')
                 ->label('Gambar')
                 ->width(100)
                 ->disk('public'),
             
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransportasis::route('/'),
            'create' => Pages\CreateTransportasi::route('/create'),
            'edit' => Pages\EditTransportasi::route('/{record}/edit'),
        ];
    }
}