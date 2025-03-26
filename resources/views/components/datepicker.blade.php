<div>

    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
    <div x-data="initDatepicker('{{ $id }}')">
        <div class="relative" id="{{ $id }}"></div>
    </div>

    <script>
        function initDatepicker(id) {
            return {
                init() {
                    this.initializeDatepicker(id);
                },
                initializeDatepicker(id) {
                    const datepickerEl = document.getElementById(id);
                    const datepicker = new Datepicker(datepickerEl, {
                        inline: true, // Menjadikan datepicker inline
                    });

                    // Event listener untuk menangkap nilai tanggal yang dipilih
                    datepickerEl.addEventListener('changeDate', (event) => {
                        const selectedDate = event.detail.date; // Tangkap objek tanggal
                        const formattedDate = this.formatDate(selectedDate); // Format tanggal
                        this.$dispatch('{{ $callback }}', formattedDate);
                    });
                },
                // Fungsi untuk memformat tanggal menjadi yyyy-mm-dd
                formatDate(date) {
                    const year = date.getFullYear();
                    const month = String(date.getMonth() + 1).padStart(2, '0'); // Tambahkan 1 karena bulan dimulai dari 0
                    const day = String(date.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }
            }
        }
    </script>
</div>
@assets
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endassets
