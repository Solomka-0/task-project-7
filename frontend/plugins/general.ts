const runtimeConfig = useRuntimeConfig

const getPageName = (hierarchy: string) => {
    const parts = hierarchy.split("/");
    return `${parts.join("-")}-${parts.slice(-1)}`
}


const i = (prefix) => {
    return (key: string) => {
        const fullKey = `${prefix}.${key}`
        const value = useI18n().t(fullKey)
        return value !== fullKey ? value : `[ ${key} ]`
    }
}

const toDateSymfony = (str: string) => {
    const date = new Date(str)
    return `${date.getFullYear()}-${(date.getMonth() + 1 < 10 ? '0' : '') + (date.getUTCMonth() + 1)}-${(date.getDate() < 10 ? '0' : '') + date.getDate()}`
        +`T${date.toLocaleTimeString() ?? '00:00:00'}+00:00`
}

const fromDateSymfony = (str: string) => {
    const date = new Date(str)
    console.log(date)
    return `${date.getFullYear()}-${(date.getMonth() + 1 < 10 ? '0' : '') + (date.getUTCMonth() + 1)}-${(date.getDate() < 10 ? '0' : '') + date.getDate()}`
}

export default defineNuxtPlugin(() => {
    return {
        provide: {
            getPageName: getPageName,
            i: i,
            toDateSymfony: toDateSymfony,
            fromDateSymfony: fromDateSymfony,
        }
    }
})