import { renderingProductionChart } from "./chart.js";
import { renderingBarChart } from "./barchart.js";
import { getOriginalData } from "./chartHelper.js";

export function setupProductFilter() {
    if (!window.hasilAkurasi) {
        console.error(
            "window.hasilAkurasi not found. Make sure data is passed from blade template."
        );
        return;
    }

    console.log("Filter ready - using onchange in HTML");
}

export function filterByProduct(productName) {
    let filteredData = window.hasilAkurasi;

    if (productName && productName !== "") {
        filteredData = window.hasilAkurasi.filter(
            (item) => item.produk === productName
        );
    }

    renderingProductionChart(filteredData);
    renderingBarChart(filteredData);
}

export function initCharts() {
    if (!window.hasilAkurasi) {
        console.error(
            "window.hasilAkurasi not available. Check blade template."
        );
        return;
    }

    console.log("Initializing charts with data:", window.hasilAkurasi);

    setupProductFilter();

    renderingProductionChart();
    renderingBarChart();

    window.filterByProduct = filterByProduct;
}

export { renderingProductionChart, renderingBarChart };
