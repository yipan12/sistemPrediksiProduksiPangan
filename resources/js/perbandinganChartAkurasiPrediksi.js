import ApexCharts from "apexcharts";

const akurasiRataRata = window.akurasiRataRata || [];
const labels = akurasiRataRata.map((item) => item.metode);
const series = akurasiRataRata.map((item) => item.akurasi);

const options = {
    chart: {
        type: "bar",
        height: 300,
        width: "100%",
    },
    series: [
        {
            name: "akurasi",
            data: series,
        },
    ],
    xaxis: {
        categories: labels,
        labels: {
            show: false,
        },
    },
    dataLabels: {
        enabled: true,
    },
};

const chartElement = document.querySelector("#perbandinganAkurasiChart");

if (chartElement) {
    const chart = new ApexCharts(chartElement, options);
    chart.render();
}
