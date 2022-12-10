<?php

namespace App\Services;

use App\Jobs\ChangePageStatusJob;
use App\Models\Page;

class PageService
{
    private $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function create($data)
    {
        $page = $this->page->create($data);
        $on = \Carbon\Carbon::now()->addDays(4);
        dispatch(new ChangePageStatusJob($page))->delay($on);
        return $page;
    }

    public function update($page, $data)
    {
        return tap($page)->update($data);
    }

}
