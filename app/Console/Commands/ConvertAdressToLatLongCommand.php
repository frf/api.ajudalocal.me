<?php

namespace App\Console\Commands;

use App\Domain\Locale\Actions\UpdateAddressLatLongQueueAction;
use Domain\Locale\Repositories\LocaleRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ConvertAdressToLatLongCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "convert_address";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Watch rabbitmq";


    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle(
        LocaleRepository $localeRepository,
        UpdateAddressLatLongQueueAction $updateAddressLatLongQueueAction
    ) {
        $locale = $localeRepository->oneProcessMap();

        if (!$locale) {
            $this->error('Nao existe local');
            return;
        }

        $urlGoogleMaps = 'https://maps.googleapis.com/maps/api/geocode/json?address=' .
            $locale->address
            .'&key=' . env('GOOGLE_MAPS_API_KEY');

        $response = Http::get($urlGoogleMaps);

        if (!$response->successful()) {
            $this->error('Erro response google');
            return;
        }

        $json = $response->json();

        if (!isset($json['results'][0]['geometry'])) {
            $this->error('Erro pegar dados google');
            $this->error($json['error_message']);
            $this->error($json['status']);
            return;
        }

        $locations = $json['results'][0]['geometry']['location'];

        if (!isset($locations['lat']) && !isset($locations['lng'])) {
            $this->error('Erro pegar dados google lat long');
            $this->error($json['error_message']);
            $this->error($json['status']);
            return;
        }

        $data = [
            'id' => $locale->id,
            'latitude' => $locations['lat'],
            'longitude' => $locations['lng'],
            'data' => $json
        ];

        $updateAddressLatLongQueueAction->onQueue('process_address')
            ->execute($data);
    }
}
