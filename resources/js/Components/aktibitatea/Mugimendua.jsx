import { useState, useEffect } from 'react';
import '@/../css/merkatuaOrria/gidaria.css';

import { Inertia } from '@inertiajs/inertia';


function Mugimendua({ mugimendua }) {
    console.log("Mugimendua recibido:", mugimendua);
    
    return (
        <div className="mugimendua-cart">
            {mugimendua ? (
                                        

                    <div className="gidaria-infor">
                    <h3 className='text-bold'>Merkatu mugimendua</h3><br />
                    {mugimendua.gidaria ? (
                    <p>{mugimendua.bezeroa.izena} jokalariak {mugimendua.gidaria.izena} {mugimendua.mota} du {mugimendua.prezioa} €-rengatik</p>

                    ):(
                        <p>{mugimendua.bezeroa.izena} jokalariak {mugimendua.taldea.izena} {mugimendua.mota} du {mugimendua.prezioa} €-rengatik</p>

                    )}
                </div>
                
            ) : (
                null
            )}
        </div>
    );
}


export default Mugimendua;

