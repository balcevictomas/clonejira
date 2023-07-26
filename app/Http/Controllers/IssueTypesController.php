<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateIssueTypesRequest;
use App\Models\IssueTypes;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IssueTypesController extends Controller
{
    public function show(): View
    {
        $issueTypes = IssueTypes::all();

        return view('issue.index', compact('issueTypes'));
    }

    public function createForm(): View
    {
        return view('issue.create');
    }

    public function create(CreateIssueTypesRequest $request): RedirectResponse
    {
        $data = $request->validated();
        IssueTypes::create($data);

        return redirect()->route('issue.index')->with('success', 'Task created successfully!');
    }
}
