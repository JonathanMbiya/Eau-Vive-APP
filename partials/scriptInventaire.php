<?php
include("partials/addNewRowScript.php");
?>
<script>
	const btnAddNewRow = document.querySelector("[data-add-new-row]")
	const invoiceSelectProduct = Array.from(document.querySelectorAll("[data-invoice-product-select-list]"))


	function productAlreadyExist(productId) {
		const rows = Array.from(document.querySelectorAll("[data-row-invoice]"))
		for (const row of rows) {
			const rowProductId = row.querySelector("[data-product-id-zone]").value
			if (rowProductId === productId) {
				return true
			}
		}
		return false;
	}


	function makeQuickDropdown(dropEl) {
		if (dropEl instanceof HTMLElement) {
			const trigger = dropEl.querySelector("[data-dropdown-trigger]")
			const content = dropEl.querySelector("[data-dropdown-content]")
			const id = dropEl.getAttribute("data-row-id")
			const row = document.querySelector(`[data-row-invoice][data-invoice-row-id="${id}"]`)
			if (trigger instanceof HTMLElement && content instanceof HTMLElement) {
				trigger.addEventListener("click", e => {
					e.preventDefault()
					const isOpened = content.dataset.state === "open"
					content.setAttribute("data-state", isOpened ? "close" : "open")
					trigger.ariaExpanded = `${!isOpened}`
				})
				const inputPrice = row.querySelector("[data-input-price]")
				const alldropdLstProd = Array.from(document.querySelectorAll("[data-invoice-product-select-list]"))
				const items = Array.from(content.querySelectorAll("[data-product-item]"))
				const idZone = row.querySelector("[data-product-id-zone]")
				const inputQte = row.querySelector("[data-user-qte]")
				const total = row.querySelector("[data-user-total]")

				inputQte.addEventListener('input', function() {
					const price = parseInt(inputPrice.value)
					const min = parseInt(inputQte.min, 10);
					const max = parseInt(inputQte.max, 10);
					let value = parseInt(inputQte.value, 10);

					// Check if value is lower than min or higher than max
					if (value < min) {
						inputQte.value = min;
					} else if (value > max) {
						inputQte.value = max;
					}
					total.value = parseInt(inputQte.value) * price
				});
				for (const item of items) {
					item.addEventListener("click", () => {
						const productId = item.getAttribute("data-product-id")
						const rowIndex = id;
						if (!productAlreadyExist(productId)) {
							const price = item.getAttribute("data-price-value")
							content.setAttribute("data-state", "close")
							trigger.ariaExpanded = "false"
							inputPrice.value = `${price}`
							trigger.value = item.getAttribute("data-product-name")
							idZone.value = productId;
							inputQte.max = parseInt(item.getAttribute("data-product-qte"))
							inputQte.value = parseInt(item.getAttribute("data-product-qte"))
							total.value = parseInt(item.getAttribute("data-product-qte")) * parseInt(price)
						}

					})
				}
			}
		}
	}

	const makeDropdowns = () => {
		const dropdLstProd = Array.from(document.querySelectorAll("[data-invoice-product-select-list]"))
		for (const dropEl of dropdLstProd) {
			makeQuickDropdown(dropEl)
		}
	}
	btnAddNewRow.addEventListener("click", e => {
		e.preventDefault()
		addRow()
		makeDropdowns()
	})

	makeDropdowns()
</script>
