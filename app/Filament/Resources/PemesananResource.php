<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemesananResource\Pages;
use App\Models\Pemesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

class PemesananResource extends Resource
{
    protected static ?string $model = Pemesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Pemesanan';
    protected static ?string $label = 'Pemesanan';
    protected static ?string $pluralLabel = 'Pemesanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_pemesanan')->required(),
                DatePicker::make('tanggal_pemesanan')->required(),
                TextInput::make('tempat_pemesanan')->required(),
                TextInput::make('id_pelanggan')->required(),
                TextInput::make('kode_kursi')->required(),
                TextInput::make('id_rute')->required(),
                TextInput::make('tujuan')->required(),
                DatePicker::make('tanggal_berangkat')->required(),
                TextInput::make('jam_cekin')->required(),
                TextInput::make('jam_berangkat')->required(),
                TextInput::make('total_bayar')->required()->numeric(),
                TextInput::make('id_petugas')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_pemesanan')->label('ID Pemesanan')->sortable()->searchable(),
                TextColumn::make('kode_pemesanan')->label('Kode Pemesanan')->sortable()->searchable(),
                TextColumn::make('tanggal_pemesanan')->label('Tanggal Pemesanan')->sortable(),
                TextColumn::make('tempat_pemesanan')->label('Tempat Pemesanan')->sortable(),
                TextColumn::make('total_bayar')->label('Total Bayar')->sortable(),
                TextColumn::make('status_pembayaran')->label('Status')->sortable(),
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

    public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPemesanan::route('/'),
            'create' => Pages\CreatePemesanan::route('/create'),
            'edit' => Pages\EditPemesanan::route('/{record}/edit'),
        ];
    }
} 