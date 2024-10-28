
<div class="content">
    <div class="links">
        <form action="{{route('payment.store')}}" method="POST">
            {{@csrf_field()}}
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_51OJwqlIQugzZQunOA8CjZJJEUPE8YLy7lTjkSIW85UZoplYMlhNKye2y8s4xdmd9QaqmEFuR87kI9JPpN7BLxWdg00UuuHPQyM"
                data-amount="1000" data-name="Oradah" data-description="Payment Form"
                data-image="/assets/images/logo-icon.png" data-locale="auto" data-currency="usd"></script>
        </form>
    </div>
</div>
</div>
<script src="https://prism.kyptronixllp.co.in/common_js/jquery.js"></script>
<script>
    $(document).ready(function() {
        $('.stripe-button-el').click();
    });
</script>

</body>

</html>