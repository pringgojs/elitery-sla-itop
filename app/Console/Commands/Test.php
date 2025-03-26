<?php

namespace App\Console\Commands;

use App\Constants\Constants;
use App\Services\CpanelService;
use App\Services\DatabaseService;
use App\Services\EncryptService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // self::createAccountCpanel();
        // self::encrypt();
        // self::getUserAccountDatabase();
        self::getPensiunDate();
    }

    public function getPensiunDate()
    {
        $retirementAge = 8;
        $dateOfBirth = '2024-06-19';
        if (! $dateOfBirth) {
            return null;
        }

        // Mengubah tanggal lahir menjadi objek Carbon
        $dob = Carbon::createFromFormat('Y-m-d', $dateOfBirth);

        // Menghitung tanggal ulang tahun ke-60
        $sixtiethBirthday = $dob->addYears($retirementAge);

        /* jika BPD maka kembalikan tanggal dari TMT */
        if ($retirementAge == Constants::STAFF_KADES_BPD_PENSIUN) {
            echo $sixtiethBirthday->toDateString();

            return;
        }

        // Mengambil tanggal 1 bulan setelah ulang tahun ke-60
        $retirementDate = $sixtiethBirthday->addMonth()->startOfMonth();

        // Mengembalikan tanggal pensiun dalam format Y-m-d
        echo $retirementDate->toDateString();
        // dd($pensiun);

    }

    public function getUserAccountDatabase()
    {
        $service = new DatabaseService;
        $users = $service->getUserAccounts();
    }

    public function encrypt()
    {
        $enc = EncryptService::encrypt('datanya');
        $dec = EncryptService::decrypt($enc);
    }

    public function createAccountCpanel()
    {
        $cpanel_service = new CpanelService;
        $username = 'ricky1';
        $domain = 'ricky1.ponorogo.go.id';
        $password = 'atasNAMAC!NT4';
        $email = 'ricky1@gmail.com';
        $response = $cpanel_service->createAccount($username, $domain, $email, $password);
        dd($response->body());

    }
}
