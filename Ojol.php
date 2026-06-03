<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Ojek Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">

        <h1>Sistem Ojek Online</h1>

        <form method="post">

            <div class="form-group">
                <p>Nama Pelanggan</p>
                <input type="text" name="nama" id="nama" placeholder="Masukkan nama pelanggan">
            </div>

            <div class="form-group">
                <p>No HP</p>
                <input type="number" name="noHp" id="noHp" placeholder="Masukkan nomor HP">
            </div>

            <div class="form-group">
                <p>Jarak Tempuh (KM)</p>
                <input type="number" name="jarak" id="jarak" placeholder="Masukkan jarak tempuh">
            </div>

            <div class="form-group">
                <p>Jenis Layanan</p>
                <div class="select-container">
                    <select name="jenis" id="jenis">
                        <option value="">Pilih Layanan</option>
                        <option value="Prioritas">GoRide Prioritas</option>
                        <option value="Reguler">GoRide Reguler</option>
                        <option value="Car">GoCar</option>
                        <option value="Car XL">GoCar XL</option>
                        <option value="Food">GoFood</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <p>Jenis Pembayaran</p>
                <div class="select-container">
                    <select name="pembayaran" id="pembayaran">
                        <option value="">Pilih Pembayaran</option>
                        <option value="Cash">Cash</option>
                        <option value="E-Wallet">E-Wallet</option>
                        <option value="Transfer">Transfer Bank</option>
                    </select>
                </div>
            </div> 

            <div class="form-group">
                <p>Kode Voucer</p>
                <input type="text" name="voucer" id="voucer" placeholder="Masukkan kode voucer">
            </div>

            <button type="submit" name="hitung">
                Hitung Biaya
            </button>

        </form>
        
        <div id="strukCard" class="struk" style="display:none;">
            <h2>Struk Pembayaran</h2>
            <div id="isiStruk"></div>
        </div>

    </div>
    <script src="script.js"></script>

</body>
</html>

<?php
        class User{
                public $nama;
                public $noHp;
                public const STATUS = "Member";

            public function __construct($nama, $noHp){
                $this->nama = $nama;
                $this->noHp = $noHp;
            }

            public function getNama($nama = ""){
                if ($nama !== "") {
                    $this->nama = $nama;
                }
                return $this->nama;
            }
        
            public function getNoHp($noHp = ""){
                if ($noHp >= 10) {
                    $this->noHp = $noHp;
                }
                return $this->noHp;
            }

            public function getStatus(){
                return self::STATUS;
            }
        }

        class Pelanggan extends User{

            public function outputdata(){
                return "nama Pelanggan : " . $this->getNama() . "<br>" . 
                        "No HP : " . $this->getNoHp() . "<br>" .
                        "Status : " . $this->getStatus() . "<br>" ;
            }
        }

        class layanan{

            public $jenisLayanan;
            public $jarakTempuh;

            public function __construct(){
                $this->jenisLayanan = isset($_POST['jenis']) ? $_POST['jenis'] : '';
                $this->jarakTempuh = isset($_POST['jarak']) ? $_POST['jarak'] : 0;
            }

            public function tarifKM(){
                if($this->jenisLayanan == "Prioritas"){
                    return number_format(3000, 0, ',', '.');
                } else if ($this->jenisLayanan == "Reguler"){
                return number_format(2500, 0, ',', '.');
                } else if ($this->jenisLayanan == "Car"){
                    return number_format( 4500, 0, ',', '.');
                } else if ($this->jenisLayanan == "Car XL"){
                    return number_format(6000, 0, ',', '.');
                } else if ($this->jenisLayanan == "Food"){
                return number_format(2000, 0, ',', '.');
                }else{
                    return number_format(0, 0, ',', '.');
                }
            }
                
            public function getTarif(){
                if($this->jenisLayanan == "Prioritas"){
                    return $this->jarakTempuh * 3000;
                } else if ($this->jenisLayanan == "Reguler"){
                return $this->jarakTempuh * 2500;
                } else if ($this->jenisLayanan == "Car"){
                    return $this->jarakTempuh * 4500;
                } else if ($this->jenisLayanan == "Car XL"){
                    return $this->jarakTempuh * 6000;
                } else if ($this->jenisLayanan == "Food"){
                return $this->jarakTempuh * 2000;
                } else {
                    return 0;
                }
            }

            public function getJenisLayanan(){
                    if($this->jenisLayanan == "Prioritas"){
                        return "GoRide Prioritas";
                    } else if($this->jenisLayanan == "Reguler"){
                        return "GoRide Reguler";
                    } else if($this->jenisLayanan == "Car"){
                        return "GoCar";
                    } else if($this->jenisLayanan == "Car XL"){
                        return "GoCar XL";
                    } else if($this->jenisLayanan == "Food"){
                        return "GoFood";
                    } else {
                        return "Layanan tidak valid"; 
                    }
            }

        }

        class Voucer{
            public $kodeVoucer;
            public $diskonPersen;
            public function __construct(){
                $this->kodeVoucer = isset($_POST['voucer']) ? $_POST['voucer'] : '';
                $this->diskonPersen = 0;
            }

            public function getKodeVoucer(){
                return $this->kodeVoucer;
            }

            public function hitungDiskon($subtotal){
                if($this->kodeVoucer == "HEMAT10"){
                    $this->diskonPersen = 0.10;
                } else if($this->kodeVoucer == "HEMAT20"){
                    $this->diskonPersen = 0.20;
                } else if($this->kodeVoucer == "HEMAT30"){
                    $this->diskonPersen = 0.30;
                } else {
                    $this->diskonPersen = 0;
                }

                return $subtotal * $this->diskonPersen;
            }
        }

        class Pembayaran{
            public $pelanggan;
            public $layanan;
            public $pembayaran;
            public $voucer;
            public $jarakTempuh;

            public function getMetode(){
                return $this->pembayaran = isset($_POST['pembayaran']) ? $_POST['pembayaran'] : '';
            }

                public function hitungSubtotal(){
                $layanan = new layanan();
                return $layanan->getTarif();
            }

            
        }

        class EWallet extends Pembayaran{
            public function hitungDiskon(){
                if($this->hitungSubtotal() > 50000){
                return $this->hitungSubtotal() * 0.05;
                }else{
                    return 0;
                }
            }

            public function hitungBiayaAdmin(){
            return 1000;
            }

            public function hitungTotal(){
                return $this->hitungSubtotal() - $this->hitungDiskon() + $this->hitungBiayaAdmin();
            }
        }

        class Transfer extends Pembayaran{

            public function hitungDiskon(){
                if($this->hitungSubtotal() > 50000){
                return $this->hitungSubtotal() * 0.05;
                }else{
                    return 0;
                }
            }

            public function hitungBiayaAdmin(){
            return 2500;
            }

            public function hitungTotal(){
                return $this->hitungSubtotal() - $this->hitungDiskon() + $this->hitungBiayaAdmin();
            }
        }

        class Cash extends Pembayaran{
            public function hitungTotal(){
                return $this->hitungSubtotal();
            }

        }

        class validasi{
            private static $totalTransaksi;
            public $nama;
            public $noHp;
            public $jarakTempuh;

            public static function getTotalTransaksi(){
                return self::$totalTransaksi !== 0;
            }

            public function validasiInput(){
                $this->nama = $_POST['nama'] !==  "";
                $this->jarakTempuh = $_POST['jarak'] !== 0;
                $this->noHp = $_POST['noHp'] !==  "";
            }

        }

        if (isset($_POST['hitung'])) {
                $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
                $noHp = isset($_POST['noHp']) ? $_POST['noHp'] : '';
                $jarakTempuh = isset($_POST['jarak']) ? $_POST['jarak'] : 0;

                    if($nama == "" || $noHp == "" || $jarakTempuh == 0){
                        echo "Semua data harus diisi.";
                    } else {
                        $pelanggan = new Pelanggan($nama, $noHp);
                        $layanan = new layanan();
                        $voucer = new Voucer();
                        $ewallet = new EWallet();
                        $transfer = new Transfer();
                        $cash = new Cash();
                        $layanan->jarakTempuh = $jarakTempuh;
                        $pembayaranAktif = isset($_POST['pembayaran']) ? $_POST['pembayaran'] : '';
                        if ($pembayaranAktif == "E-Wallet") {
                            $objekBayar = $ewallet;
                        } else if ($pembayaranAktif == "Transfer") {
                            $objekBayar = $transfer;
                        } else {
                            $objekBayar = $cash;
                        }

                        $subtotal = $layanan->getTarif();
                        $diskonVoucer = $voucer->hitungDiskon($subtotal);
                        $diskonMetode = $objekBayar->hitungDiskon();
                        $totalDiskon = $diskonVoucer + $diskonMetode;
                        $totalAkhir = $objekBayar->hitungTotal() - $diskonVoucer;

                        ?>
                        
                    <script>
                        const strukData = {
                            nama: <?=
                                    json_encode($pelanggan->getNama()) 
                                ?>,
                            noHp: <?= 
                                  json_encode($pelanggan->getNoHp()) 
                                ?>,
                            status: <?= 
                                    json_encode($pelanggan->getStatus()) 
                                ?>,
                            layanan: <?= 
                                        json_encode($layanan->getJenisLayanan()) 
                                ?>,
                            pembayaran: <?= 
                                        json_encode($objekBayar->getMetode()) 
                                ?>,
                            jarak: <?= 
                                        json_encode($jarakTempuh) 
                                ?>,
                            tarif: <?= 
                                        json_encode($layanan->tarifKM()) 
                                ?>,
                            subtotal: <?= 
                                        json_encode(number_format($subtotal, 0, ',', '.')) 
                                ?>,
                            diskon: <?= 
                                        json_encode(number_format($totalDiskon, 0, ',', '.')) 
                                ?>,
                            admin: <?= 
                                        json_encode(number_format($objekBayar->hitungBiayaAdmin(), 0, ',', '.')) 
                                ?>,
                            total: <?= 
                                        json_encode(number_format($totalAkhir, 0, ',', '.')) 
                                ?>
                        };
                        </script>
                        <?php
                                }
            }
?>
   