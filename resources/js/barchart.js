import ApexCharts from "apexcharts";

export function renderingBarChart() {
    const hasilAkurasi = window.hasilAkurasi;
    const categories = hasilAkurasi.map((item) => item.produk);

    const series = [
        {
            name: "Produksi Aktual",
            data: hasilAkurasi.map((item) => item.produksi_aktual),
        },
        {
            name: "Prediksi MA",
            data: hasilAkurasi.map((item) => item.prediksi_ma),
        },
        {
            name: "Prediksi LR",
            data: hasilAkurasi.map((item) => item.prediksi_lr),
        },
        {
            name: "Prediksi ES",
            data: hasilAkurasi.map((item) => item.prediksi_Es),
        },
    ];

    const options = {
        chart: {
            type: "bar",
            height: 450,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "50%",
                endingShape: "rounded",
            },
        },
        dataLabels: {
            enabled: false,
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

    const chart = new ApexCharts(document.querySelector("#barChart"), options);
    chart.render();
}
