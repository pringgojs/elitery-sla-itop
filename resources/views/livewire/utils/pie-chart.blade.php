<div>
    <div class="font-bold">{{ $title }}</div>
    <div wire:ignore>
        <canvas id="pie-chart-{{ $id }}" class="w-full"></canvas>
    </div>
</div>
@script
    <script>
        let chart;
        let currentSeries = @json($series); // Menyimpan data awal
        let currentCategories = @json($legend); // Menyimpan kategori awal

        Livewire.hook('component.init', ({
            component,
            cleanup
        }) => {
            initBarChart();
            cleanup(() => {
                if (chart) {
                    chart.destroy(); // Hapus chart saat komponen dihapus
                }
            });
        });


        /* disini, legend dan series harus dikirim dari BAKEND. meskipun properti sudah diset reaktif, nyatanya ketika dipanggil di livewire on update data masih data old */
        Livewire.on('{{ $listener }}', ({
            legend,
            series
        }) => {
            if (chart) {
                chart.destroy(); // Hancurkan chart lama

                currentSeries = series;
                currentCategories = legend;
                initBarChart();
            }
        });

        function initBarChart() {
            if (chart) {
                chart.destroy()
            }

            const ctx = document.getElementById('pie-chart-{{ $id }}').getContext('2d');
            chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: currentCategories,
                    datasets: currentSeries
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw + ' batang';
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>
@endscript
