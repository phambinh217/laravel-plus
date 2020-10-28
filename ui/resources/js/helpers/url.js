import { ltrim, serialize } from './str'

const API_URL = ltrim(process.env.MIX_API_URL, '/')
const BASE_URL = ltrim(process.env.MIX_BASE_URL, '/')
const HOME_URL = ltrim(process.env.MIX_HOME_URL, '/')

function parseQuery (str) {
    str = str.replace(/&amp/ig, '&')
    let path = ltrim(str, '/')
    let query = {}

    let firstQuestionMarkIndex = str.indexOf('?')
    if (firstQuestionMarkIndex > -1) {
        path = ltrim(str.slice(0, firstQuestionMarkIndex), '/')
        let keyValuePairs = str.slice(firstQuestionMarkIndex + 1, str.length).split('&')
        for (let keyValuePair of keyValuePairs) {
            keyValuePair = keyValuePair.split('=')
            query[keyValuePair[0]] = keyValuePair[1]
        }
    }

    return {
        query: query,
        path: path,
    }
}

function url (baseUrl, append, params) {
    let { path, query } = parseQuery(append)
    params = {
        ...query,
        ...params,
    }

    let url = baseUrl + '/' + path
    let queryString = serialize(params)

    if (queryString.length) {
        url += '?' + queryString
    }


    return url
}

export function apiUrl (append, params) {
    return url(API_URL, append, params)
}

export function baseUrl (append, params) {
    return url(BASE_URL, append, params)
}

export function internalUrl (append, params) {
    return url('', append, params)
}

export function homeUrl (append, params) {
    return url(HOME_URL, append, params)
}

