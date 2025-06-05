import ApexCharts from "apexcharts";
import { getChartData, setLineChart, getLineChart } from "./chartHelper.js";

export function renderingProductionChart(data = null) {
    const { categories, series, dates } = getChartData(data);

    const options = {
        chart: {
            type: "line",
            height: 450,
        },
        xaxis: {
            categories: categories,
        },
        series: series,
        stroke: {
            curve: "straight",
            width: 3,
        },
        dataLabels: {
            enabled: false,
        },
        grid: {
            row: {
                colors: ["#f3f3f3", "transparent"],
                opacity: 0.5,
            },
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

                let content = `<div style="padding:10px;font-family:sans-serif;">
            <small >📅 ${dateStr}</small><hr style="margin:6px 0"/>`;
                series.forEach((s, i) => {
                    content += `${w.globals.seriesNames[i]}: <b>${s[dataPointIndex]} Kg</b><br/>`;
                });

                return content + "</div>";
            },
        },
    };

    const existingChart = getLineChart();
    if (existingChart) {
        existingChart.destroy();
    }

    const chart = new ApexCharts(
        document.querySelector("#productionChart"),
        options
    );
    chart.render();

    setLineChart(chart);
}
