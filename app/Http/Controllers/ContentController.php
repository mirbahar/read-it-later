<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentRequest;
use App\Models\Content;
use App\Services\Contracts\ContentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContentController extends Controller
{
    /**
     * @var ContentServiceInterface
     */
    private $contentService;

    public function __construct(ContentServiceInterface $contentService)
    {
        $this->contentService = $contentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContentRequest $request
     * @return Response
     */
    public function store(ContentRequest $request)
    {
        return $this->contentService->createContent([
            'pocket_id' => $request->pocket_id,
            'url' => $request->url,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Content $content
     * @return Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Content $content
     * @return Response
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Content $content
     * @return Response
     */
    public function update(Request $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Content $content
     * @return Response
     */
    public function destroy(Content $content)
    {
        //
    }
}
