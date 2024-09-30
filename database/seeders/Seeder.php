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

        $cabangOptions = ['Bone', 'Makasar', 'Gowa'];

        $dojo = [
            ['id' => '1', 'nama' => 'Dojo Manggali', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '2', 'nama' => 'Dojo SDIT Muhlisin', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '3', 'nama' => 'Dojo SMPN 1 Sungguminasa', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '4', 'nama' => 'Dojo SMPN 2 Barombong', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '5', 'nama' => 'Dojo SMAN 9 Gowa', 'lokasi' => 'Indonesia', 'cabang' => 'Gowa'],
            ['id' => '6', 'nama' => 'Dojo SMAN 1 Gowa', 'lokasi' => 'Indonesia', 'cabang' => 'Gowa'],
            ['id' => '7', 'nama' => 'Dojo SMAN 22 Gowa', 'lokasi' => 'Indonesia', 'cabang' => 'Gowa'],
            ['id' => '8', 'nama' => 'Dojo SMKN 4 Gowa', 'lokasi' => 'Indonesia', 'cabang' => 'Gowa'],
            ['id' => '9', 'nama' => 'Dojo BBPMP Sulsel', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '10', 'nama' => 'Dojo Ittihad Makassar', 'lokasi' => 'Indonesia', 'cabang' => 'Makasar'],
            ['id' => '11', 'nama' => 'Dojo SD Rama Toddopuli Raya Makassar', 'lokasi' => 'Indonesia', 'cabang' => 'Makasar'],
            ['id' => '12', 'nama' => 'Dojo SD Frater Bakti Luhur', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '13', 'nama' => 'DOJO MIN 8', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '14', 'nama' => 'DOJO TK ASHOLICHIN', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '15', 'nama' => 'DOJO EPICENTRUM', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '16', 'nama' => 'DOJO SD 70 LAMURU', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '17', 'nama' => 'DOJO SPAPAT', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '18', 'nama' => 'DOJO UNRA', 'lokasi' => 'Indonesia', 'cabang' => 'Indonesia'],
            ['id' => '19', 'nama' => 'DOJO PRESTASI BKC', 'lokasi' => 'Indonesia', 'cabang' => 'Bone'],
            ['id' => '20', 'nama' => 'Dojo Pelita Asri', 'lokasi' => 'Indonesia', 'cabang' => 'Makasar'],
        ];

        foreach ($dojo as &$d) {
            if ($d['cabang'] === 'Indonesia') {
                $d['cabang'] = $cabangOptions[array_rand($cabangOptions)];
            }
        }
        unset($d);

        $this->table('dojos')->insert($dojo)->saveData();

        $anggota = [
            [
                'nid' => '1',
                'id_dojo' => $dojo[0]['id'],
                'nama' => 'anggota',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'indoensia',
                'tahun_gabung' => '2024',
                'status' => 'Atlet',
                'tingkat_sabuk' => 'putih',
                'nomor' => '123',
                'foto' => '123',
                'tanggal_lahir' => date('Y-m-d H:i:s'),
                'tempat_lahir' => 'indonesia',
            ]
        ];

        $this->table('anggotas')->insert($anggota)->saveData();

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

        $pengurus = [
            [
                'nama' => 'Prof. Dr. Ir. Hj. Andi Majdah M Zain. M,Si.',
                'jabatan' => 'Ketua Dewan Pembina',
            ],
            [
                'nama' => 'Ir. H. Ahmad Huzaen, MM.',
                'jabatan' => 'Anggota Dewan Pembina',
            ],
            [
                'nama' => 'Kang Zaenal',
                'jabatan' => 'Ketua umum',
            ],
            [
                'nama' => 'Ferry Laodri (plt)',
                'jabatan' => 'Serketaris umum',
            ],
            [
                'nama' => 'Hanizah Febrianti Tato',
                'jabatan' => 'Bendahara umum',
            ],
            [
                'nama' => 'Didin Komaruddin',
                'jabatan' => 'Ketua staf pelatih',
            ],
            [
                'nama' => 'Dian Seniwati',
                'jabatan' => 'Ketua majelis sabuk hitam',
            ],
            // Seksi
            [
                'nama' => 'Dirwansyah',
                'jabatan' => 'Bidang Prestasi',
            ],
            [
                'nama' => 'Dian Seniwati',
                'jabatan' => 'Perwasitan',
            ],
            [
                'nama' => 'Nazaruddin',
                'jabatan' => 'Usaha dan dana',
            ],
            [
                'nama' => 'Reza',
                'jabatan' => 'Humas',
            ]
        ];

        $this->table('pengurus')->insert($pengurus)->saveData();
    }
}
