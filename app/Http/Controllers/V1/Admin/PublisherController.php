<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use App\Traits\V1\ApiResponse;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $publishers = Publisher::all();
        return ApiResponse::success('ok', ['publishers' => $publishers]);
    }

    public function getPublisher($publisher_id)
    {
        $publisher = Publisher::findOrFail($publisher_id);
        return ApiResponse::success('ok', ['publisher' => $publisher], 200);
    }

    public function addPublisher(Request $request)
    {
        $validated = $request->validate([
            'publisher_name' => ['required', 'string', 'unique:publishers'],
            'origin_country' => ['required', 'string']
        ]);

        $publisher = Publisher::create($validated);
        return ApiResponse::success('Publisher added successfully.', ['publisher' => $publisher], 201);
    }

    public function updatePublisher(Request $request, $publisher_id)
    {
        $validated = $request->validate([
            'publisher_name' => ['sometimes', 'string'],
            'origin_country' => ['sometimes', 'string']
        ]);

        $publisher = Publisher::findOrFail($publisher_id);
        $publisher->update($validated);

        return ApiResponse::success('publisher update successfully.', ['update_publisher' => $publisher], 200);
    }

    public function deletePublisher($publisher_id)
    {
        $publisher = Publisher::findOrFail($publisher_id);
        $publisher->delete();
        return ApiResponse::success('publisher deleted successfully');
    }
}
