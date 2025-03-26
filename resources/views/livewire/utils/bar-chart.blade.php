<div>
    <div class="font-bold">{{ $title }}</div>
    <div wire:ignore>
        <canvas id="bar-chart-{{ $id }}"></canvas>
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
                    console.log('component init');
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
                console.log('on listener');

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

            const ctx = document.getElementById('bar-chart-{{ $id }}').getContext('2d');
            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: currentCategories,
                    datasets: currentSeries
                },
                options: {
                    responsive: true, // Chart akan responsif
                    // maintainAspectRatio: false, // Menonaktifkan rasio default
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@endscript
