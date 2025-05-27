import ApexCharts from "apexcharts";
import { getChartData, setLineChart, getLineChart } from "./chartHelper.js";

export function renderingProductionChart(data = null) {
    const { categories, series } = getChartData(data);

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
            y: {
                formatter: (val) => `${val} `,
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
