<?php

namespace App\Api\Controllers;

use App\Api\Requests\CreateLocaleRequest;
use App\Api\Requests\UpdateLocaleRequest;
use App\Api\Resources\FileResource;
use App\Api\Resources\LocaleResource;
use App\Exceptions\ResourceNotFoundException;
use Domain\Locale\Actions\CreateLocaleAction;
use Domain\Locale\Actions\UpdateLocaleAction;
use Domain\Locale\Bags\LocaleBag;
use Domain\Locale\Repositories\LocaleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LocaleController extends Controller
{
    private LocaleRepository $localeRepository;
    /**
     * @var CreateLocaleAction
     */
    private CreateLocaleAction $createLocaleAction;
    /**
     * @var UpdateLocaleAction
     */
    private UpdateLocaleAction $updateLocaleAction;

    public function __construct(
        LocaleRepository $localeRepository,
        CreateLocaleAction $createLocaleAction,
        UpdateLocaleAction $updateLocaleAction
    ) {
        $this->localeRepository = $localeRepository;
        $this->createLocaleAction = $createLocaleAction;
        $this->updateLocaleAction = $updateLocaleAction;
    }

    public function index()
    {
        $requestString = json_encode(request()->toArray());
        $cacheKey = 'locales:index:'.md5($requestString);

        return Cache::remember($cacheKey, 8, function () {
            return LocaleResource::collection($this->localeRepository->all());
        });
    }

    public function create(CreateLocaleRequest $request)
    {
        $bag = LocaleBag::fromRequest($request->validated());
        return LocaleResource::make($this->createLocaleAction->execute($bag));
    }

    public function show($id)
    {
        $user = $this->localeRepository->find($id);

        $this->authorize('ownResource', $user);

        if (!$user) {
            throw new ResourceNotFoundException();
        }

        return LocaleResource::make($user);
    }

    public function update(UpdateLocaleRequest $request, $id)
    {
        if (!$locale = $this->localeRepository->find($id)) {
            throw new ResourceNotFoundException();
        }

        $this->authorize('ownResource', $locale);

        $bag = LocaleBag::fromRequest($request);
        return LocaleResource::make($this->updateLocaleAction->execute($bag, $id));
    }
}
