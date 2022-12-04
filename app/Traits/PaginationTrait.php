<?php

namespace App\Traits;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

trait PaginationTrait
{
  public function paginate($items, $perPage = 5, $page = null)
  {
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $total = count($items->data);
    $currentpage = $page;
    $offset = ($currentpage * $perPage) - $perPage;
    $itemstoshow = array_slice($items->data, $offset, $perPage);
    return new LengthAwarePaginator($itemstoshow, $total, $perPage);
  }
}
