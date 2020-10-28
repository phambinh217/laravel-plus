export function clone (object) {
    return JSON.parse(JSON.stringify(object))
}

export function optional (value, defaultValue) {
    try {
        return value ? value :  defaultValue
    } catch (error) {
        return defaultValue
    }
}

