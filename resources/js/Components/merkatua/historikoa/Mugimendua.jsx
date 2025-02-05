import { useState, useEffect } from 'react';
import '@/../css/merkatuaOrria/gidaria.css';
import dispo from '@/../images/tick.png';
import f1 from '@/../images/f1.png';
import f2 from '@/../images/f2.png';
import verstappen from '@/../images/verstappen.png';
import Puja from '../Puja';
import { Inertia } from '@inertiajs/inertia';


function Mugimendua({ mugimendua }) {
    console.log("Mugimendua recibido:", mugimendua);
    
    return (
        <div className="mugimendua-card">
            {mugimendua.gidaria ? (
                mugimendua.mota == 'erosi' ? (
                    <div className="gidaria-info">
                    <img 
                        src={mugimendua.gidaria.foto} 
                        alt={mugimendua.gidaria.izena} 
                        className="gidaria-img"
                        style={{
                            width: '10%'
                        }}
                    />
                    <p style={{display: 'flex', textAlign:'center'}}> <p style={{color: 'green', marginRight: '10px'}}>{mugimendua.gidaria.izena}</p> {mugimendua.mota} duzu <p style={{color: 'green', marginLeft:'16px'}}>{mugimendua.prezioa}</p>  € -rengatik</p>
                </div>
                ):(
                    <div className="gidaria-info">
                    <img 
                        src={mugimendua.gidaria.foto} 
                        alt={mugimendua.gidaria.izena} 
                        className="gidaria-img"
                        style={{
                            width: '10%'
                        }}
                    />
                    <p style={{display: 'flex', textAlign:'center'}}> <p style={{color: 'red', marginRight: '10px'}}>{mugimendua.gidaria.izena}</p> {mugimendua.mota} duzu <p style={{color: 'red', marginLeft:'16px'}}>{mugimendua.prezioa}</p>  € -rengatik</p>
                </div>
                )
                
            ) : (
                null
            )}
             {mugimendua.taldea ? (
                mugimendua.mota == 'erosi' ? (
                    <div className="gidaria-info">
                    <img 
                        src={mugimendua.taldea.foto} 
                        alt={mugimendua.taldea.izena} 
                        className="gidaria-img"
                        style={{
                            width: '10%'
                        }}
                    />
                    <p style={{display: 'flex', textAlign:'center'}}> <p style={{color: 'green', marginRight: '10px'}}>{mugimendua.taldea.izena}</p> {mugimendua.mota} duzu <p style={{color: 'green', marginLeft:'16px'}}>{mugimendua.prezioa}</p>  € -rengatik</p>
                </div>
                ):(
                    <div className="gidaria-info">
                    <img 
                        src={mugimendua.taldea.foto} 
                        alt={mugimendua.taldea.izena} 
                        className="gidaria-img"
                        style={{
                            width: '10%'
                        }}
                    />
                    <p style={{display: 'flex', textAlign:'center'}}> <p style={{color: 'red', marginRight: '10px'}}>{mugimendua.taldea.izena}</p> {mugimendua.mota} duzu <p style={{color: 'red', marginLeft:'16px'}}>{mugimendua.prezioa}</p>  € -rengatik</p>
                </div>
                )
                
            ) : (
                null
            )}
        </div>
    );
}


export default Mugimendua;

