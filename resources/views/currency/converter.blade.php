@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="rate">Amount (USD)</label>
                    <input type="number" class="form-control" name="amount" id="amount">
                </div>
                <div class="form-group">
                    <label for="currency">Currency</label>
                    <select name="currency" id="currency">
                        @foreach($currenciesWithRates as $currency=>$rate)
                            <option value="{{ $currency }}">{{ $currency }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="convert"></div>
            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#currency').change(function () {
                let amount = $('#amount').val();
                let currency = $('#currency').val();
                let currenciesWithRates = {!! json_encode($currenciesWithRates) !!};

                $("#convert").text(currenciesWithRates[currency] * amount);

            })

            $("#amount").keyup(function () {
                let amount = $('#amount').val();
                let currency = $('#currency').val();
                let currenciesWithRates = {!! json_encode($currenciesWithRates) !!};

                $("#convert").text(currenciesWithRates[currency] * amount);
            });
        })
    </script>
@endsection
