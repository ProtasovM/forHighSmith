<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    protected int $perPage = 100;
    protected array $validationRules = [
        'dealer_name' => 'required|string|max:255',
        'dealer_contact_name' => 'required|string|max:255',
        'credit_amount' => 'required|numeric|between:0,99999999.99',
        'credit_term' => 'required|integer',
        'loan_interest_rate' => 'required|numeric|between:0,99999999.99999999',
        'loan_motivation' => 'required|string|max:65535',
        'status' => 'required|integer|max:255',
        'bank_id' => 'required|exists:banks,id',
    ];

    public function get(Request $request): JsonResponse
    {
        if ((int) $request->id > 0) {
            return $this->getOne($request);
        } else {
            return $this->getPaginatable($request);
        }
    }

    protected function getOne(Request $request): JsonResponse
    {
        $application = Application::find((int) $request->id);

        if (!$application) {
            return response()->json(status: 204);
        }

        if ($request->user()->cannot('get', $application)) {
            return response()->json(status: 403);
        }

        return response()->json($application);
    }

    protected function getPaginatable(Request $request): JsonResponse
    {
        if ($request->user()->cannot('get', Application::class)) {
            return response()->json(status: 403);
        }

        $paginator  = Application::query()->with('bank')->orderBy('id')
            ->paginate($this->perPage, page: $request->page);

        if ($paginator->total() == 0) {
            return response()->json(status: 204);
        }

        return response()->json([
            'items' => $paginator->items(),
            'current_page' => $paginator->currentPage(),
            'total' => $paginator->total(),
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        if ($request->user()->cannot(__FUNCTION__, Application::class)) {
            return response()->json(status: 403);
        }

        $this->validate($request, $this->validationRules);

        $application = Application::create(
            $request->only(array_keys($this->validationRules))
        );

        return response()->json($application, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $application = Application::find($id);

        if (!$application) {
            return response()->json(status: 204);
        }

        if ($request->user()->cannot(__FUNCTION__, $application)) {
            return response()->json(status: 403);
        }

        $this->validate(
            $request,
            array_intersect_key($this->validationRules, $request->all())
        );

        $application->update(
            $request->only(array_keys($this->validationRules))
        );

        return response()->json($application);
    }

    public function delete(Request $request, int $id): JsonResponse
    {
        $application = Application::find($id);

        if (!$application) {
            return response()->json([], 204);
        }

        if ($request->user()->cannot(__FUNCTION__, $application)) {
            return response()->json(status: 403);
        }

        $application->delete();

        return response()->json();
    }
}
