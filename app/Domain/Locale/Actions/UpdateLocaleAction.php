<?php

namespace Domain\Locale\Actions;

use Domain\Locale\Bags\LocaleBag;
use Domain\Locale\Repositories\LocaleRepository;

class UpdateLocaleAction
{
    /**
     * @var LocaleRepository
     */
    private LocaleRepository $localeRepository;

    public function __construct(LocaleRepository $localeRepository)
    {
        $this->localeRepository = $localeRepository;
    }

    public function execute(LocaleBag $patientBag, int $id)
    {
        $dataToUpdate = $patientBag->attributes();

        $this->localeRepository->update($dataToUpdate, $id);

        return $this->localeRepository->find($id);
    }
}
