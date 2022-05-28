<?php

namespace App\Http\Controllers;

use App\Services\Bnet\MetadataService;
use Illuminate\Support\Facades\Log;

class MetadataController extends Controller
{
    protected $metadataService;


    public function __construct(MetadataService $metadataService)
    {
        $this->metadataService = $metadataService;
    }

    public function find_by_type($type)
    {
        Log::info('Making request findOne');
        return $this->metadataService->findByType($type);
    }

    public function find_all()
    {
        return $this->metadataService->findAll();
    }
}
