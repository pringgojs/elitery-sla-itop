<?php

namespace App\Rules;

use App\Models\Village;
use App\Models\VillageStaff;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueStaffPositionInVillage implements ValidationRule
{
    protected $village_id;

    protected $staff_position_id;

    protected $ignore_id;

    public function __construct($village_id, $staff_position_id, $ignore_id = null)
    {
        $this->village_id = $village_id;
        $this->staff_position_id = $staff_position_id;
        $this->ignore_id = $ignore_id;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $is_kasi = option_is_match('kasi', $this->staff_position_id);
        $is_kaur = option_is_match('kaur', $this->staff_position_id);
        /* cek jumlah kasi dan kaur didesa tersebut. */
        $positions = [
            key_option('kasi'),
            key_option('kaur'),
        ];

        if (in_array($this->staff_position_id, $positions)) {
            $village = Village::find($this->village_id);
            $village_type_detail = $village->type->villageTypeDetail;

            /* hitung total kasi dan kaur */
            $total_kasi = self::countVillageStaff('kasi');
            $total_kaur = self::countVillageStaff('kaur');

            /* cek apakah desa swakarya, jika iya kasi/kaur bisa 2/3. Tetapi tidak boleh keduanya sama-sama 3 atau sama-sama 2*/
            /* berarti cek jumlah maksimal kasi dan kaur adalah 5. */
            if ($village_type_detail->is_swakarya) {
                /* validasi maksimal jumlah kasi/kaur adalah 3 */
                if ($is_kasi) {
                    if ($total_kasi == 3) {
                        info('1');
                        $fail('Untuk jabatan ini di desa ini sudah melebihi maksimal.');

                        return;
                    }

                }

                if ($is_kaur) {
                    if ($total_kaur == 3) {
                        $fail('Untuk jabatan ini di desa ini sudah melebihi maksimal.');

                        return;
                    }
                }

                /* maksimal jumlah kasi dan kaur adalah 5 */
                if (($total_kasi + $total_kaur) >= 5) {
                    $fail('Untuk jabatan ini di desa ini sudah melebihi maksimal.');

                    return;
                }

            } else {
                /* desa biasa sesuai jumlah maksimal */
                if ($is_kasi && $total_kasi == $village_type_detail->max_kasi) {
                    $fail('Untuk jabatan ini di desa ini sudah melebihi maksimal.');

                    return;
                }

                if ($is_kaur && $total_kaur == $village_type_detail->max_kaur) {
                    $fail('Untuk jabatan ini di desa ini sudah melebihi maksimal.');

                    return;
                }

                return;
            }

            return;
        }

        /* jika jabatan selain sekretaris dan kepala, maka bebaskan */
        $positions = [
            key_option('sekretaris_desa'),
            key_option('kepala_desa'),
        ];

        if (! in_array($this->staff_position_id, $positions)) {
            return;
        }

        /* jika jabatan sekdes, kepala. pastikan hanya ada 1 */
        $query = VillageStaff::active()
            ->where('village_id', $this->village_id)
            ->where('position_type_id', $this->staff_position_id);

        if ($this->ignore_id) {
            $query->where('id', '!=', $this->ignore_id);
        }

        if ($query->exists()) {
            $fail('Untuk jabatan ini di desa ini sudah terisi.');
        }
    }

    public function countVillageStaff($key = null)
    {
        $position_type = key_option($key);

        $ignore_id = $this->ignore_id;
        $query = VillageStaff::active()
            ->where('village_id', $this->village_id)
            ->where('position_type_id', $position_type)
            ->where(function ($q) use ($ignore_id) {
                if ($ignore_id) {
                    $q->where('id', '!=', $ignore_id);
                }
            })->get()
            ->count();

        return $query;
    }
}
