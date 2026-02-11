<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // List aktivitas biar gak jauh-jauh dari tema RPG/Mahasiswa kamu
        $activities = ['Makan', 'Rokok', 'Jajan', 'Paket Data', 'Bayar Hutang', 'Beasiswa', 'Transfer Ortu'];
        $tipe       = $this->faker->randomElement(['Pengeluaran', 'Pemasukan']);

        return [
            'id_account'     => 1, // Pastikan id_account 1 ini sudah ada di tabel users/accounts kamu
            'nama_transaksi' => $this->faker->randomElement($activities),
            'tipe'           => $tipe,
            'jumlah'         => $this->faker->numberBetween(10000, 500000),
            'tanggal'        => $this->faker->dateTimeBetween('-3 months', 'now'), // Data 3 bulan terakhir
            'keterangan'     => $this->faker->sentence(),
        ];
    }
}
