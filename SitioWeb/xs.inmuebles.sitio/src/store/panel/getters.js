// export const myGetter = (state)=> {
    // return state.algo
// }


 export const getInmuebles = (state)=>(term='') =>{
    if (term === '') {
        return state.inmuebles
    }
    return state.inmuebles.filter(inmueble =>inmueble.NumCredito.toLowerCase().includes(term.toLowerCase()))
 }


 export const filterCiudades = (state)=> (idestado) =>{
    console.log("Se filtran ciudades en getter por id de estado "+ idestado);
    return state.catalogos.ciudades.filter(cudad => cudad.IdEstado === idestado);
}
 