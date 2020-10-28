import moment from 'moment'

export function dateFormat (date, format = 'DD/MM/YYYY') {
  return moment(date).format(format)
}
