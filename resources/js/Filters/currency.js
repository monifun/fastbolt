import Vue from "vue";

Vue.filter("currency", (value, currency = 'VND') => {
    return (new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: currency,
    })).format(value);
});
