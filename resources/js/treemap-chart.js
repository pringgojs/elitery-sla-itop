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
                            backgroundColor: this.generateTreemapColor(
                                this.currentSeries
                            ),

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
                                    { size: 16, weight: "200px" },
                                    { size: 10 },
                                ],
                                position: "center",
                            },
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: false,
                            text: this.chartTitle,
                        },
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            enabled: true,
                            callbacks: {
                                title() {
                                    return "";
                                },
                                label(ctx) {
                                    const data = ctx.raw._data;
                                    const value = ctx.raw.v;
                                    return `${data.what}: ${value}`;
                                },
                            },
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
        generateTreemapColor(series) {
            const values = series.map((item) => item.value);
            const min = Math.min(...values);
            const max = Math.max(...values);
            const range = max - min || 1; // Hindari pembagian nol

            return (ctx) => {
                if (ctx.type !== "data") return "transparent";

                const value = ctx.raw.v;
                // Normalisasi nilai antara 0 dan 1, kemudian skala alpha dari 0.3 sampai 1
                const alpha = 0.3 + 0.7 * ((value - min) / range);
                return `rgba(0, 153, 76, ${alpha.toFixed(2)})`; // hijau dengan gradasi
            };
        },
    }));
});
