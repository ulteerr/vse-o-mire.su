<?php

namespace app\lib\common;

class Pagination
{
	private $totalItems;
	private $itemsPerPage;
	private $currentPage;

	public function __construct($totalItems, $itemsPerPage)
	{
		$this->totalItems = $totalItems;
		$this->itemsPerPage = $itemsPerPage;
		$this->currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
	}

	public function calculateIndexes()
	{
		$startIndex = ($this->currentPage - 1) * $this->itemsPerPage;
		$endIndex = min($startIndex + $this->itemsPerPage - 1, $this->totalItems - 1);

		return [$startIndex, $endIndex];
	}

	public function generateLinks()
	{
		$totalPages = ceil($this->totalItems / $this->itemsPerPage);
		$links = [];

		if ($this->currentPage > 1) {
			$links[] = "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=" . ($this->currentPage - 1) . "\">Предыдущая</a></li>";
		}

		for ($i = 1; $i <= $totalPages; $i++) {
			if ($i === $this->currentPage) {

				$links[] = "<li class=\"page-item\"><a class=\"page-link active\" href=\"?page=" . $i . "\">$i</a></li>";
			} else {
				$links[] = "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=" . $i . "\">$i</a></li>";
			}
		}

		if ($this->currentPage < $totalPages) {
			$links[] = "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=" . ($this->currentPage + 1) . "\">Следующая</a></li>";
		}

		return "<ul class=\"pagination justify-content-center\">" . implode(" ", $links) . "</ul>";
	}
}
