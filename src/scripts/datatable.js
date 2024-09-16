import { DataTable } from "simple-datatables"

const makeDataTable = (selector) => {
	new DataTable(selector, {
		searchable: true,
		sortable: false
	})
}

const productTable = document.querySelector("[data-app-table]")
if (productTable instanceof HTMLElement) {
	makeDataTable(productTable)
}
