<style>
    .stripe-button-el{
        display: none !important;
    }
</style>
<div class="content">
    <div class="links">
        <form action="{{route('payment.store')}}" method="POST">
            <input type="hidden" name="invoice_id" value="{{$invoice->invoice_id}}">
            <input type="hidden" name="lead_id" value="{{$invoice->customer_id}}">
            <input type="hidden" name="amount" value="{{$price}}">
            {{@csrf_field()}}
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_51QEqulP2s7nmQth6gJeNEUHO1U19iGJEdHgruWGG3C7oKci5urTcPNq9UDig8VJodj936oj6ChxoWxUm5LXf53iI00W5ohl6ly"
                data-amount="{{$price*100}}"  data-name="Oradah" data-description="Payment Form"
                data-image="/assets/images/logo-icon.png" data-locale="auto" data-currency="usd"></script>
        </form>
    </div>
</div>

</div>
   <script src="{{url('project-js/jquery.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.stripe-button-el').click();
    });
    
</script>

</body>

</html>