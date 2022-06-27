const setlocalValues = (key,data,ttl) =>{
    const now = new Date()
    const item = {
        data: data,
        expiry: now.getTime()+ttl,
    }
    localStorage.setItem(key,JSON.stringify(item))
}

export default setlocalValues