import ApexCharts from "apexcharts";
import { getChartData, setBarChart, getBarChart } from "./chartHelper.js";

export function renderingBarChart(data = null) {
    const { categories, series, dates, hasilTerbaik } = getChartData(data);

    const options = {
        chart: {
            type: "bar",
            height: 450,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "55%",
                endingShape: "rounded",
            },
        },
        xaxis: {
            categories: categories,
        },
        series: series,
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"],
        },
        fill: {
            opacity: 1,
        },
        legend: {
            position: "bottom",
        },
        tooltip: {
            shared: true,
            intersect: false,
            custom: ({ series, dataPointIndex, w }) => {
                const category = w.globals.labels[dataPointIndex];
                const date = new Date(dates[dataPointIndex] || "");
                const dateStr = isNaN(date)
                    ? "Tanggal tidak tersedia"
                    : date.toLocaleDateString("id-ID", {
                          weekday: "long",
                          day: "2-digit",
                          month: "long",
                          year: "numeric",
                      });

                const hasilTerbaikItem =
                    hasilTerbaik[dataPointIndex] || "Tidak tersedia";

                let content = `<div style="padding:10px;font-family:sans-serif;">
            <small >📅 ${dateStr}</small><hr style="margin:6px 0"/>`;
                series.forEach((s, i) => {
                    content += `${w.globals.seriesNames[i]}: <b>${s[dataPointIndex]} Kg</b><br/>`;
                });

                content += `<hr style="margin: 6px"/>
                <span style="color:#28a745;font-weight:bold;">🏆 Hasil Terbaik: ${hasilTerbaikItem}</span>`;

                return content + "</div>";
            },
        },
    };

    const existingChart = getBarChart();
    if (existingChart) {
        existingChart.destroy();
    }

    const chart = new ApexCharts(document.querySelector("#barChart"), options);
    chart.render();

    setBarChart(chart);
}
