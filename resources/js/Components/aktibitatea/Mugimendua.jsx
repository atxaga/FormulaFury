import { useState, useEffect } from 'react';
import '@/../css/merkatuaOrria/gidaria.css';

import { Inertia } from '@inertiajs/inertia';


function Mugimendua({ mugimendua }) {
    console.log("Mugimendua recibido:", mugimendua);
    
    return (
        <div className="mugimendua-cart">
            {mugimendua.gidaria ? (
                                        

                    <div className="gidaria-infor">
                    <h3 className='text-bold'>Merkatu mugimendua</h3><br />
                    <p>{mugimendua.bezeroa.izena} jokalariak {mugimendua.gidaria.izena} {mugimendua.mota} du {mugimendua.prezioa} €-rengatik</p>
                </div>
                
            ) : (
                <p>Ez daude mugimendurik</p> 
            )}
        </div>
    );
}


export default Mugimendua;

