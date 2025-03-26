<div>
    {{-- The whole world belongs to you. --}}
    <div class="font-bold ">{{ $transaction->code }}</div>
    <div class="shadow bg-white rounded border p-5">
        @include('pdf.daily-transaction', ['transaction' => $transaction])
    </div>
</div>
