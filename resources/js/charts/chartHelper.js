import ApexCharts from "apexcharts";

// Global variables untuk menyimpan instance chart
let lineChartInstance = null;
let barChartInstance = null;
let originalData = [];

function getChartData(data = null) {
    let hasilAkurasi;

    if (data) {
        hasilAkurasi = data;
    } else if (window.hasilAkurasi) {
        hasilAkurasi = window.hasilAkurasi;
        if (originalData.length === 0) {
            originalData = [...window.hasilAkurasi];
        }
    } else if (originalData.length > 0) {
        hasilAkurasi = originalData;
    } else {
        console.error("No data available");
        return { categories: [], series: [] };
    }

    const categories = hasilAkurasi.map((item) => item.produk);
    const dates = hasilAkurasi.map((item) => item.target_prediksi);
    const series = [
        {
            name: "Produksi Aktual",
            data: hasilAkurasi.map((item) => parseFloat(item.produksi_aktual)),
        },
        {
            name: "Prediksi MA",
            data: hasilAkurasi.map((item) => parseFloat(item.prediksi_ma)),
        },
        {
            name: "Prediksi LR",
            data: hasilAkurasi.map((item) => parseFloat(item.prediksi_lr)),
        },
        {
            name: "Prediksi ES",
            data: hasilAkurasi.map((item) => parseFloat(item.prediksi_Es)),
        },
    ];

    return { categories, series, dates };
}

function setLineChart(chart) {
    lineChartInstance = chart;
}

function setBarChart(chart) {
    barChartInstance = chart;
}

function getLineChart() {
    return lineChartInstance;
}

function getBarChart() {
    return barChartInstance;
}

function getOriginalData() {
    return originalData;
}

export {
    getChartData,
    setLineChart,
    setBarChart,
    getLineChart,
    getBarChart,
    getOriginalData,
};
