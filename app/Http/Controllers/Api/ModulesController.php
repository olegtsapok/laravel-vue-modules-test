<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\CrudRepositoryInterface;
use App\Repositories\CrudRepository;
use App\Services\Modules;
use App\Http\Requests\ModuleRequest;

 class ModulesController extends ApiController
{
    /**
     * Repository to operate with models
     *
     * @var CrudRepositoryInterface
     */
    protected CrudRepositoryInterface $repository;

    public function __construct(protected Modules $modules)
    {
        $this->repository = new CrudRepository('Module');
    }

    /**
     * Create new module
     *
     * @return JsonResponse
     */
    public function modules(ModuleRequest $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors(), 422);
        }

        $entity = $this->repository->store($validator->validated());

        return $this->sendResponse(['module_id' => $entity->id], 'Created successfully', 201);
    }

    /**
     * Download zipped module
     *
     * @param int $id
     * @return Response
     */
    public function download(int $id): StreamedResponse
    {
        $module = $this->repository->getById($id);
        $content = $this->modules->getZippedModule($module);

        return response()->streamDownload(function () use ($content) {
            echo $content;
        });
    }
}