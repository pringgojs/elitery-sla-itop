<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div x-data>

        {{-- @livewire('pages.semester-transaction.section.estimation-price') --}}
        @livewire('pages.semester-transaction.section.form')
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('stepper', {
                inActive: [1],

                updateInActive(v) {
                    let index = this.inActive.findIndex(item =>
                        item == v
                    );

                    if (index !== -1) {
                        this.inActive.splice(index, 1);
                        return;
                    }

                    this.inActive.push(v)
                },

                checkInActive(v) {
                    let index = this.inActive.findIndex(item =>
                        item == v
                    );

                    if (index !== -1) {
                        return true;
                    }

                    return false;
                }
            })
        })
    </script>
</div>
