import ApexCharts from "apexcharts";
import { getChartData, setBarChart, getBarChart } from "./chartHelper.js";

export function renderingBarChart(data = null) {
    const { categories, series } = getChartData(data);

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
            y: {
                formatter: (val) => `${val} unit`,
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
