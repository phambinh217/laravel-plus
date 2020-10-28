export function strSlug (str) {
  return str.toString().toLowerCase()
  .replace(/\s+/g, '-')
  .replace(/\-\-+/g, '-')
  .replace(/^-+/, '')
  .replace(/-+$/, '')
  .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
  .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
  .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
  .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
  .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
  .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
  .replace(/đ/gi, 'd')
  .replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\|_/gi, '')
  .replace(/[^\w\-]+/g, '')
}

export function strRandom (length) {
 let result = ''
 let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
 let charactersLength = characters.length
 for (let i = 0; i < length; i++) {
  result += characters.charAt(Math.floor(Math.random() * charactersLength))
}

return result
}

export function ucFirst (string) {
  return string[0].toUpperCase() + string.slice(1).toLowerCase()
}

export function uuid (salt) {
  let now = new Date()
  return String(salt) + now.getDate() + strRandom(5)
}

export function ltrim (str, character) {
  str = str.trim()
  while (str[0] == character) {
    str = str.substring(1)
  }

  return str
}

export function serialize (obj, prefix) {
  let str = [], p
  for (p in obj) {
    if (obj.hasOwnProperty(p)) {
      let k = prefix ? prefix + '[' + p + ']' : p,
      v = obj[p]
      str.push(
        (v !== null && typeof v === 'object') ?
        serialize(v, k) :
        encodeURIComponent(k) + '=' + encodeURIComponent(v)
        )
    }
  }
  return str.join('&')
}

export function camelCase (text) {
  text = text.replace(/[-_\s.]+(.)?/g, (_, c) => c ? c.toUpperCase() : '')
  return text.substr(0, 1).toLowerCase() + text.substr(1)
}
