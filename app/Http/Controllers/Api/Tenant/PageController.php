<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\PageRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;
use App\Services\PageService;

class PageController extends Controller
{

    private $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'pages' => PageResource::collection(Page::get())
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $page = $this->pageService->create($request->validated());
        return response([
            'message' => 'created successfuly',
            'page' => new PageResource($page)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return response([
            'page' => new PageResource($page)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $page = $this->pageService->update($page, $request->validated());

        return response([
            'page' => new PageResource($page)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return response([
            'message' => 'deleted successfuly',

        ]);
    }
}
