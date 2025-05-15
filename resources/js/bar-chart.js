import Chart from "chart.js/auto";

Livewire.hook("component.init", ({ component, cleanup }) => {
    console.log("component bar-chart.js");

    Alpine.data("barChart", () => ({
        chart: null,
        currentSeries: [],
        currentCategories: [],
        chartId: null,
        chartTitle: "",
        chartListener: "",
        initBarChart({ id, series, legend, title, listener }) {
            this.chartId = id;
            this.currentSeries = series;
            this.currentCategories = legend;
            this.chartTitle = title;
            this.chartListener = listener;
            console.log(
                `Initializing bar chart with ID: ${this.chartId}, title: ${this.chartTitle}`
            );

            this.renderChart();

            // Listen for Livewire updates
            if (window.Livewire) {
                Livewire.on(listener, ({ legend, series }) => {
                    this.currentSeries = series;
                    this.currentCategories = legend;
                    this.renderChart();
                });
            }
        },

        updateTitle(title) {
            this.chartTitle = title;
        },

        renderChart() {
            const canvas = document.getElementById(`bar-chart-${this.chartId}`);
            if (!canvas) {
                console.error(
                    `Canvas element not found: bar-chart-${this.chartId}`
                );
                return;
            }
            const ctx = canvas.getContext("2d");
            if (this.chart) {
                this.chart.destroy();
            }
            this.chart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: this.currentCategories,
                    datasets: this.currentSeries,
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: "top" },
                        title: { display: true, text: this.chartTitle },
                    },
                    scales: {
                        y: { beginAtZero: true },
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
