import Vue from "vue";

Vue.filter("currency", (value, currency = 'VND') => {
    return (new Intl.NumberFormat('vi-VN', {
        currencyDisplay: 'narrowSymbol',
        style: 'currency',
        currency: currency,
    })).format(value);
});
