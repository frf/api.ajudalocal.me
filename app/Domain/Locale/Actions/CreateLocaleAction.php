<?php

namespace Domain\Locale\Actions;

use Domain\Locale\Bags\LocaleBag;
use Domain\Locale\Models\Locale;
use Domain\Locale\Repositories\LocaleRepository;
use Illuminate\Support\Facades\Hash;

class CreateLocaleAction
{
    private LocaleRepository $localeRepository;

    public function __construct(
        LocaleRepository $localeRepository
    ) {
        $this->localeRepository = $localeRepository;
    }

    public function execute(LocaleBag $patientBag)
    {
        $data = $patientBag->attributes();
        $data['status'] = Locale::STATUS_REGISTRED;

        return $this->localeRepository->create($data);
    }

}
