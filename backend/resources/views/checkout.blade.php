<button id="pay-button">Bayar</button>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"

<script>
document.getElementById('pay-button').onclick = function(){
    snap.pay('{{ $snapToken }}');
};
</script>