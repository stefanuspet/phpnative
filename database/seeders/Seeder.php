<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

use function Symfony\Component\Clock\now;

class Seeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $user = [
            [
                'credential_id' => '123',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            // [
            //     'credential_id' => '1',
            //     'password' => password_hash('123', PASSWORD_DEFAULT),
            //     'role' => 'anggota',
            //     'created_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'credential_id' => '2',
            //     'password' => password_hash('123', PASSWORD_DEFAULT),
            //     'role' => 'majelis',
            //     'created_at' => date('Y-m-d H:i:s'),
            // ]
        ];

        $this->table('users')->insert($user)->saveData();

        $dojo = [
            [
                'id' => '1',
                'nama' => 'Dojo A',
                'lokasi' => 'Indonesia',
                'cabang' => 'Indonesia',
            ]
        ];

        $this->table('dojos')->insert($dojo)->saveData();

        // $anggota = [
        //     [
        //         'nid' => '1',
        //         'id_dojo' => $dojo[0]['id'],
        //         'nama' => 'anggota',
        //         'jenis_kelamin' => 'Laki-laki',
        //         'alamat' => 'indoensia',
        //         'tahun_gabung' => '2024',
        //         'status' => 'atlet',
        //         'tingkat_sabuk' => 'putih',
        //         'nomor' => '123',
        //         'foto' => '123',
        //         'tanggal_lahir' => date('Y-m-d H:i:s'),
        //         'tempat_lahir' => 'indonesia',
        //     ]
        // ];

        // $this->table('anggotas')->insert($anggota)->saveData();

        // $majelis = [
        //     [
        //         'nit' => '2',
        //         'nama' => 'majelis',
        //         'tahun_gabung' => '2024',
        //         'jenis_kelamin' => 'Laki-laki',
        //         'alamat' => 'indoensia',
        //         'jabatan' => 'majelis',
        //         'tingkat_sabuk' => 'Hitam',
        //         'spesialis' => 'majelis Spesialis',
        //         'foto' => '123',
        //         'tanggal_lahir' => date('Y-m-d H:i:s'),
        //         'tempat_lahir' => 'indonesia',
        //     ]
        // ];

        // $this->table('majelis')->insert($majelis)->saveData();

        // $dojo_majelis = [
        //     [
        //         'id_dojo' => $dojo[0]['id'],
        //         'id_majelis' => $majelis[0]['nit'],
        //     ]
        // ];

        // $this->table('dojo_majelis')->insert($dojo_majelis)->saveData();
    }
}
