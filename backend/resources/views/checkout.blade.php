<button id="pay-button">Bayar</button>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.clientKey') }}"></script>

<script>
document.getElementById('pay-button').onclick = function(){
    snap.pay('{{ $snapToken }}');
};
</script>