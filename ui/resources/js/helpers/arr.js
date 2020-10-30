export function arrRandom (arr) {
    return arr[Math.floor(Math.random() * arr.length)]
}

export function arrChunk (array, chunkSize) {
    return [].concat.apply([], array.map(function (elem, i) {
        return i % chunkSize ? [] : [array.slice(i, i + chunkSize)]
    }))
}

export function arrFirst (arr) {
    return arr.find(true)
}
