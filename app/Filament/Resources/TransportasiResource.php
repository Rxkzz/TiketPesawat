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
                   ->numeric()
                   ->maxLength(10),
                   TextInput::make('jumlah_kursi')
                   ->label('Jumlah Kursi')
                   ->required()
                   ->maxLength(50),
                   Textarea::make('keterangan')
                   ->label('Keterangan')
                   ->required()
                    ->maxLength(255),
                   Forms\Components\Select::make('id_type_transportasi')
                       ->label('Tipe Transportasi')
                       ->required()
                    ->relationship('typeTransportasi', 'nama_Type'),
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