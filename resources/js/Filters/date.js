const formatDate = require('date-fns').format;

const DEFAULT_DATE_FORMAT = "HH:mm:ss dd-MM-yyyy";

export default function dateFilter(date, format, options) {
    return formatDate(new Date(date), format || DEFAULT_DATE_FORMAT, Object.assign({}, options));
}
