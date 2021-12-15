<?php

namespace App\Domain\Locale\Actions;

use Domain\Locale\Models\Locale;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\QueueableAction\QueueableAction;

class UpdateAddressLatLongQueueAction
{
    use QueueableAction;

    public function execute($data)
    {
        try {
            if (!isset($data['latitude'])
                && !isset($data['longitude'])
                && !isset($data['id'])) {
                return false;
            }

            DB::table('locales')
                ->where('id', $data['id'])
                ->update([
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'status' => Locale::STATUS_PUBLISHED,
                    'data' => $data['data'],
                ]);

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
