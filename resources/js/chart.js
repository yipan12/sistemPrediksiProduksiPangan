import ApexCharts from "apexcharts";

export function renderingProductionChart() {
    const hasilAkurasi = window.hasilAkurasi;
    const categories = hasilAkurasi.map((item) => item.produk);

    const series = [
        {
            name: "produksi Aktual",
            data: hasilAkurasi.map((item) => item.produksi_aktual),
        },
        {
            name: "prediksi MA",
            data: hasilAkurasi.map((item) => item.prediksi_ma),
        },
        {
            name: "prediksi LR",
            data: hasilAkurasi.map((item) => item.prediksi_lr),
        },
        {
            name: "prediksi ES",
            data: hasilAkurasi.map((item) => item.prediksi_Es),
        },
    ];

    const options = {
        chart: {
            type: "line",
            height: 450,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "50%",
                endingShape: "rounded",
            },
        },
        xaxis: {
            categories: categories,
        },
        series: series,
        fill: {
            opacity: 1,
        },
        tooltip: {
            y: {
                formatter: (val) => val,
            },
        },
    };

    const chart = new ApexCharts(
        document.querySelector("#productionChart"),
        options
    );
    chart.render();
}
