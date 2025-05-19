import Chart from "chart.js/auto";
import { TreemapController, TreemapElement } from "chartjs-chart-treemap";
Chart.register(TreemapController, TreemapElement);

Livewire.hook("component.init", ({ component, cleanup }) => {
    Alpine.data("treemapChart", () => ({
        chart: null,
        currentSeries: [],
        currentLabel: "",
        chartId: null,
        chartTitle: "",
        chartListener: "",
        initTreemapChart({ id, series, label, title, listener }) {
            this.chartId = id;
            this.currentSeries = series;
            this.currentLabel = label;
            this.chartTitle = title;
            this.chartListener = listener;

            this.renderChart();

            // Listen for Livewire updates
            if (window.Livewire) {
                Livewire.on(listener, ({ label, series }) => {
                    this.destroyChart();
                    this.currentSeries = series;
                    this.currentLabel = label;
                    this.renderChart();
                });
            }
        },

        updateTitle(title) {
            this.chartTitle = title;
        },

        renderChart() {
            const DATA = [
                {
                    what: "Apples",
                    value: 98,
                    color: "rgb(191, 77, 114)",
                },
                {
                    what: "Orange",
                    value: 75,
                    color: "rgb(228, 148, 55)",
                },
                {
                    what: "Lime",
                    value: 69,
                    color: "rgb(147, 119, 214)",
                },
                {
                    what: "Grapes",
                    value: 55,
                    color: "rgb(80, 134, 55)",
                },
                {
                    what: "Apricots",
                    value: 49,
                    color: "rgb(90, 97, 110)",
                },
                {
                    what: "Blackberries",
                    value: 35,
                    color: "rgb(34, 38, 82)",
                },
            ];
            const canvas = document.getElementById(
                `treemap-chart-${this.chartId}`
            );
            if (!canvas) {
                console.error(
                    `Canvas element not found: treemap-chart-${this.chartId}`
                );
                return;
            }
            const ctx = canvas.getContext("2d");
            if (this.chart) {
                this.chart.destroy();
            }
            this.chart = new Chart(ctx, {
                type: "treemap",
                data: {
                    datasets: [
                        {
                            label: this.currentLabel,
                            tree: this.currentSeries,
                            key: "value",
                            borderWidth: 0,
                            borderRadius: 6,
                            spacing: 1,
                            backgroundColor(ctx) {
                                if (ctx.type !== "data") {
                                    return "transparent";
                                }
                                return ctx.raw._data.color;
                            },
                            labels: {
                                align: "left",
                                display: true,
                                formatter(ctx) {
                                    if (ctx.type !== "data") {
                                        return;
                                    }
                                    return [
                                        ctx.raw._data.what,
                                        "Value is " + ctx.raw.v,
                                    ];
                                },
                                color: ["white", "whiteSmoke"],
                                font: [
                                    { size: 20, weight: "bold" },
                                    { size: 12 },
                                ],
                                position: "center",
                            },
                        },
                    ],
                },
                options: {
                    events: [],
                    plugins: {
                        title: {
                            display: false,
                            text: this.chartTitle,
                        },
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            enabled: false,
                        },
                    },
                },
            });
        },

        destroyChart() {
            if (this.chart) {
                this.chart.destroy();
                this.chart = null;
            }
        },
    }));
});
